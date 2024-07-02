<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    public function scopeSortHospitals(Builder $query, $sortHospitals)
    {
        if ($sortHospitals === "star") {
        // 平均評価でソート
        $query->join('posts', function ($join) {
                    $join->on('hospitals.id', '=', 'posts.hospital_id')
                        ->whereNull('posts.deleted_at'); // `posts` テーブルの論理削除も考慮
                })
              ->select('hospitals.id', 'hospitals.name', 'hospitals.place', DB::raw('AVG(posts.star) as average_stars'))
              ->groupBy('hospitals.place', 'hospitals.name', 'hospitals.id')
              ->orderBy('average_stars', 'DESC');
        } else {
        // スムーズな診察と入院の合計でソート
        $query->join('posts', function ($join) {
                    $join->on('hospitals.id', '=', 'posts.hospital_id')
                         ->whereNull('posts.deleted_at'); // `posts` テーブルの論理削除も考慮
                })
              ->select('hospitals.id', 'hospitals.name', 'hospitals.place', DB::raw('AVG(posts.smooth_examination + posts.smooth_hospitalization) as average_smooth'))
              ->groupBy('hospitals.place', 'hospitals.name', 'hospitals.id',)
              ->orderByRaw('CASE WHEN posts.smooth_examination IS NULL AND posts.smooth_hospitalization IS NULL THEN 1 ELSE 0 END, average_smooth ASC');
        }
        return $query;
    }
    public function departments()
    {
        // postsを通じて病院が持つ診療科を取得
        return $this->hasManyThrough(
            Hospital_Department::class,
            Post::class,
            'hospital_id', // Foreign key on Post table
            'id',          // Foreign key on HospitalDepartment table
            'id',          // Local key on Hospital table
            'hospital_department_id' // Local key on Post table
        );
    }
    public function scopeFilterByPlace(Builder $query, $searchPlace) {
        //場所で検索
        if (!empty($searchPlace)) {
            $query->where('place', 'LIKE', "%{$searchPlace}%");
        }
        return $query;
    }
    public function scopeFilterByDepartment(Builder $query, $searchHospital_Department) {
        //診療科で病院検索
        if (isset($searchHospital_Department)) {
            $query->whereHas('departments', function ($query) use ($searchHospital_Department) {
                $query->where('hospital_departments.id', $searchHospital_Department);
            });
        }
        return $query;
    }
    public function scopeFilter(Builder $query, $keyword)
    {
        //フリーワード検索
        if(!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orwhere('place', 'LIKE', "%{$keyword}%")
                ->orwhereHas('departments', function ($query) use ($keyword) {
                    $query->where('hospital_departments.name', 'LIKE', "%{$keyword}%");
                });
        }
        return $query;
    }
    public static function scopeGetHospitalsPaginateByLimit(Builder $query, int $limit_count = 10)
    {
        return $query->with('departments')->paginate($limit_count);
    }
    public function getSelectHospital(int $limit_count = 20)
    {
        return $this->orderBy('place')->paginate($limit_count);
    }
    
    protected $fillable = [
        'name',
        'place',
    ];
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}