<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    
    public function getStarHospitals()
    {
        $starHospitalIds->Post::getAverageStars()->pluck('hospital_id');
        $starHospitals = Hospital::whereIn('id', $starHospitalIds)
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
    public static function getHospitalsPaginateByLimit(int $limit_count = 10)
    {
        return self::with('departments')->paginate($limit_count);
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