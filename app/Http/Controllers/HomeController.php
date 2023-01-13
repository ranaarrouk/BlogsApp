<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function getBlogs()
    {
        $blogs = BlogResource::collection(Blog::query()->where("status", "published")->get());
        return view('home_blogs')->with('blogs',$blogs);
    }
}
