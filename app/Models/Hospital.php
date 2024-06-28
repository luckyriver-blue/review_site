<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    
    public function getHospitalsPaginateByLimit(int $limit_count = 10)
    {
        return $this->paginate($limit_count);
    }
    public function getStarHospitals()
    {
        $starHospitalIds->Post::getAverageStars()->pluck('hospital_id');
        $starHospitals = Hospital::whereIn('id', $starHospitalIds)
                    ->orderByRaw('FIELD(id, ' . $starHospitalIds->implode(',') . ')')
                    ->get();
        return $starHospitals;
    }
    public function getHospitalDepartments()
    {
        $hospital = Hospital::with(['post' => function($query) {
            $query->with('hospital_department');
        }])->get();
        $posts = $hospital->post;
        $hospitalDepartments = $posts->map(function ($post) {
            return $post->hospital_department->name;
        })->unique();
        return $hospitalDepartments;
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