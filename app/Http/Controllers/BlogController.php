<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts;

class BlogController extends Controller
{

    public function home() {

        $posts = Posts::latest()->paginate(5);

        return view("blog.home", [
            "posts" => $posts
        ]);
    }

    public function post($slug) {

        $post = Posts::where("slug", $slug)->first();

        if (!$post) {
            redirect("/");
        }

        return view("blog.post", [
            "post" => $post
        ]);

    }

}
