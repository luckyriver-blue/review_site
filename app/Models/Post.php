<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Hospital;
use App\Models\Helpful;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;

    public static function getAverageStars()
    {
        return $hospitalsWithAverageStars = Post::select('hospital_id', DB::raw('AVG(star) as average_stars'))
                ->groupBy('hospital_id')
                ->orderBy('average_stars', 'DESC')
                ->get();
    }
    public static function getAverageSmooth_Examination()
    {
        return $hospitalsWithAverageSmooth_Examination = Post::select('hospital_id', DB::raw('AVG(smooth_examination) as average_smooth_examination'))
                ->groupBy('hospital_id')
                ->orderBy('average_smooth_examination')
                ->get();
    }
    public static function getAverageSmooth_Hospitalization()
    {
        return $hospitalsWithAverageSmooth_Hospitalization = Post::select('hospital_id', DB::raw('AVG(smooth_hospitalization) as average_smooth_hospitalization'))
                ->groupBy('hospital_id')
                ->orderBy('average_smooth_hospitalization')
                ->get();
    }
    public static function getBodyPart()
    {
        //病院ごとにmax_helpful_postのbodyを取得
        $bodyPart = [];
        $hospitalIds = Self::select('hospital_id')->groupBy('hospital_id')->get();
        $hospitalIds->each(function ($hospitalId) use (&$bodyPart) {
            $maxHelpfulPost = Self::where('hospital_id', $hospitalId->hospital_id)
                            ->whereNotNull('body')
                            ->withCount('helpfuls')
                            ->orderBy('helpfuls_count', 'DESC')
                            ->first();
            if($maxHelpfulPost === NULL) {
                $bodyPart[$hospitalId->hospital_id] = "なし";
            }
            else {
                $bodyPart[$maxHelpfulPost->hospital_id] = $maxHelpfulPost->body;
            }
        });
        return $bodyPart;
    }
    public function scopeGetSortPosts(Builder $query, $sortPosts, $hospitalId)
    {
        $query->where('hospital_id', $hospitalId);
        if ($sortPosts === "helpful") {
            $query->withCount('helpfuls')
                  ->orderBy('helpfuls_count', 'DESC');
        } else {
            $query->orderBy('updated_at', 'DESC');
        }
        
        return $query;
    }
    public function scopeFilterByDepartment(Builder $query, $searchHospital_Department) {
        //診療科で口コミ検索
        if (isset($searchHospital_Department)) {
            $query->where('hospital_department_id', $searchHospital_Department);
        }
        return $query;
    }
    public function scopeFilter(Builder $query, $keyword)
    {
        //フリーワード検索
        if(!empty($keyword)) {
            $query->where('disease', 'LIKE', "%{$keyword}%")
                ->orwhere('body', 'LIKE', "%{$keyword}%")
                ->orwhereHas('hospital_department', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
             });
        }
        return $query;
    }
    public static function scopeGetPostsPaginateByLimit(Builder $query, int $limit_count = 10)
    {
        return $query->paginate($limit_count);
    }
    public function getMyPostsPaginate(int $limit_count = 10)
    {
        $user_id = Auth::id();
        return $this->where('user_id', $user_id)
            ->orderBy('updated_at', 'DESC')
            ->paginate($limit_count);
    }
    public function is_liked()
    {
        $id = Auth::id();
        
        $likers = array();
        foreach($this->helpfuls as $helpful) {
            array_push($likers, $helpful->user_id);
        }
        return in_array($id, $likers);
    }
    
    protected $fillable = [
        'user_id',
        'hospital_id',
        'myself',
        'hospital_department_id',
        'disease',
        'smooth_examination',
        'smooth_hospitalization',
        'star',
        'body',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
    public function hospital_department()
    {
        return $this->belongsTo(Hospital_Department::class);
    }
    public function helpfuls()
    {
        return $this->hasMany(Helpful::class, 'post_id');
    }
}
