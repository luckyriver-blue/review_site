<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    public function scopeFilter(Builder $query, $keyword)
    {
        //検索
        if(!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orwhere('place', 'LIKE', "%{$keyword}%");
        }
        
        return $query;
    }
    public function getStarHospitals()
    {
        $starHospitalIds->Post::getAverageStars()->pluck('hospital_id');
        $starHospitals = $filteredHospitals
                    ->whereIn('id', $starHospitalIds)
                    ->orderByRaw('FIELD(id, ' . $starHospitalIds->implode(',') . ')')
                    ->get();
        return $starHospitals;
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