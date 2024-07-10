<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\HospitalRequest;
use App\Models\Post;
use App\Models\Hospital;
use App\Models\Hospital_Department;
use App\Models\User;
use App\Models\Helpful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function Top(Hospital $hospital, Request $request)
    {
        $keyword = $request->input('keyword');
        $hospitals = Hospital::SortHospitals(null, 'star')
                    ->limit(3)
                    ->get();
                    
        return view('hospitals.top', ['hospitals' => $hospitals, 'keyword' => $keyword]);
    }
    public function Hospitals(Post $post, Hospital $hospital, Hospital_Department $hospital_department, Request $request)
    {
        $bodyPart = Post::getBodyPart();
        
        $keyword = $request->input('keyword');
        $searchHospital_Department = $request->input('search_hospital_department');
        $searchPlace = $request->input('search_place');
        $sortHospitals = $request->input('sort_hospitals', 'star');
        
        $hospitals = Hospital::sortHospitals($searchHospital_Department, $sortHospitals)
                    ->filter($keyword)
                    ->filterByPlace($searchPlace)
                    ->getHospitalsPaginateByLimit(); 
        
        
        $hospital_departments = $hospital_department->get();
        
        
        
        return view('hospitals.hospitals')->with(compact(
            'hospitals', 
            'hospital_departments',
            'keyword', 
            'searchPlace',
            'searchHospital_Department',
            'sortHospitals',
            'bodyPart', 
        ));
    }
    
    public function HospitalReview(Hospital $hospital, Post $post, Hospital_Department $hospital_department, Request $request)
    {
        $sortPosts = $request->input('sort_posts');
        $searchHospital_Department = $request->input('search_hospital_department');
        $keyword = $request->input('keyword');
        
        $posts = Post::getSortPosts($sortPosts, $hospital->id)
                ->filterByDepartment($searchHospital_Department)
                ->filter($keyword)
                ->getPostsPaginateByLimit();
                
        $hospital_departments = $hospital_department->get();
                
        return view('hospitals.posts.hospital_review', [
            'hospital' => $hospital,
            'posts' => $posts,
            'sortPosts' => $sortPosts,
            'searchHospital_Department' => $searchHospital_Department,
            'keyword' => $keyword,
            'hospital_departments' => $hospital_departments,
        ]);
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
    public function add(HospitalRequest $request, Hospital $hospital)
    {
        $input = $request['hospital'];
        $hospital->fill($input)->save();
        return redirect()->back();
    }
    public function store(PostRequest $request, Post $post)
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
    public function update(PostRequest $request, Post $post)
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
    public function __construct()
    {
        $this->middleware(['auth','verified'])->only(['helpful', 'unHelpful']);
    }
    public function helpful(Request $requet, Post $post)
    {
        Helpful::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
        ]);
        return redirect()->back();
    }
    public function unHelpful(Post $post)
    {
        $helpful = Helpful::where('post_id', $post->id)->where('user_id', Auth::id())->first();
        $helpful->delete();
        return redirect()->back();
    }
}
