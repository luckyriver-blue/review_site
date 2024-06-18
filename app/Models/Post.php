<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('helpful', 'DESC')->paginate($limit_count);
    }
    public function getAverageStars()
    {
        return $hospitalsWithAverageStars = Post::select('hospital_id', DB::raw('AVG(star) as average_stars'))
                ->groupBy('hospital_id')
                ->orderBy('average_stars', 'ASC')
                ->get();
    }
    protected $fillable = [
        'myself',
        'hospital_department_id',
        'desease',
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
    public function hospital_deaprtment()
    {
        return $this->belongsTo(Hospital_Department::class);
    }
}
