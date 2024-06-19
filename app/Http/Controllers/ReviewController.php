<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Hospital_Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function Hospitals()
    {
        return view('hospitals.hospitals')->with(['hospitals' => $hospital->getHospitalsPaginateByLimit]);
    }
    public function HospitalReview(Post $post)
    {
        return view('hospitals.posts.hospital_review')->with(['posts' => $post->getPaginateByLimit()]);
    }
    public function ShowReview(Post $post)
    {
        return view('hospitals.posts.show_review')->with(['post' => $post]);
    }
    public function create(Request $request)
    {
        return view('hospitals.posts.create');
    }
    public function OptionDepartment(Hospital_Department $hospital_department)
    {
        return view('hospitals.posts.create')->with(['hospital_departments' => $hospital_department->get()]);
    }
    public function store(Request $request, Post $post)
    {
        $input = $request['post'];
        $input['user_id'] = Auth::id();
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
}
