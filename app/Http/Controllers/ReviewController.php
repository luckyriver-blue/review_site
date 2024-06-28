<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Hospital;
use App\Models\Hospital_Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function Hospitals(Hospital $hospital)
    {
        return view('hospitals.hospitals')->with(['hospitals' => $hospitals->getHospitalsPaginateByLimit()]);
    }
    public function HospitalReview(Post $post)
    {
        return view('hospitals.posts.hospital_review')->with(['posts' => $posts->getPaginateByLimit()]);
    }
    public function ShowReview(Post $post)
    {
        return view('hospitals.posts.show_review')->with(['post' => $post]);
    }
    public function SelectCreate(Hospital $hospital)
    {
        return view('hospitals.posts.hospital_select_create')->with(['hospitals' => $hospital->getSelectHospital()]);
    }
    
    public function create(Hospital_Department $hospital_department, Hospital $hospital)
    {
        return view('hospitals.posts.create', [
            'hospital' => $hospital,
            'hospital_departments' => $hospital_department->get(),
            ]);
    }
    public function add(Request $request, Hospital $hospital)
    {
        $input = $request['hospital'];
        $hospital->fill($input)->save();
        return redirect()->back();
    }
    public function store(Request $request, Post $post)
    {
        $input = $request['post'];
        $input['user_id'] = Auth::id();
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    public function mypage(User $user, Post $post)
    {
        $user = Auth::user();
        $posts = $post->getMyPostsPaginate();
        return view('hospitals.posts.mypage', ['user' => $user, 'posts' => $posts]);
    }
    public function updateProfile(Request $request, User $user)
    {
        $user = Auth::user();
        $input = $request['user'];
        $user->update($input);
        return redirect()->back();
    }
    public function mypost(Post $post, Hospital_Department $hospital_department)
    {
        return view('hospitals.posts.edit', ['post' => $post, 'hospital_departments' => $hospital_department->get()]);
    }
    public function update(Request $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    public function delete(Post $post, User $user)
    {
        $post->delete();
        $user = Auth::user();
        return redirect('/posts/mypage/' . $user->id);
    }
}
