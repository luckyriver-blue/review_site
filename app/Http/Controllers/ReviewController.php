<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function HospitalReview(Post $post)
    {
        return view('posts.hospital_review')->with(['posts' => $post->getPaginateByLimit()]);
    }
}
