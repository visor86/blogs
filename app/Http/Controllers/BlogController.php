<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;

class BlogController extends Controller {

    public function index()
    {
        $posts = Post::where('enabled', '=', 1)
            ->where('date_from', '<', Carbon::now())
            ->orderBy('date_from', 'desc')
            ->paginate(config('blog.posts_per_page'));

        return view('blog.index', ['posts' => $posts]);
    }


    public function showPost($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();

        return view('blog.post', ['post' => $post]);
    }
}