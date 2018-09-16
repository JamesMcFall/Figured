<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Posts;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     * All actions are only available to logged in users.
     *
     * @return <void>
     */
    public function __construct() {

        $this->middleware('auth');

    }

    public function index() {
        return redirect("/admin/posts");
    }

    /**
     * Admin manage post list page.
     *
     * @return <\Illuminate\View\View>
     */
    public function list() {

        $posts = Posts::all();

        return view("admin.posts.list", [
            "posts" => $posts
        ]);

    }

    /**
     * Render new post form
     *
     * @return <\Illuminate\View\View>
     */
    public function create() {
        return view("admin.posts.form");
    }

    /**
     * Render edit post form as long as post id exists.
     *
     * @param <string> $postId - MongoDB ID string
     * @return <\Illuminate\View\View>
     */
    public function edit($postId) {

        $post = \App\Posts::find($postId);

        if (is_null($post)) {
            return redirect('admin/posts/');
        }

        return view("admin.posts.form", [
            "post" => $post
        ]);

    }

    /**
     * Deletes a blog post, sets a flash message and redirects back to admin
     * blog listing.
     *
     * @param <\Illuminate\Http\Request> $request
     * @param <string> $postId - MongoDB ID string
     * @return <\Illuminate\Http\RedirectResponse>
     */
    public function delete(Request $request, $postId) {

        $post = \App\Posts::find($postId);

        if ($post) {

            $post->delete();

            $request->session()->flash('message',
                "Post '$post->title' deleted"
            );

        }

        return redirect('admin/posts/');
    }

    /**
     * Posted to by create/edit forms. Handles the creating or updating of a
     * new blog post.
     *
     * @param <\Illuminate\Http\Request> $request
     * @return <\Illuminate\Http\RedirectResponse>
     */
    public function process(Request $request) {

        # Note - this automatically stops the request if it fails
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255', # Unique keyword (unique:posts) does not work with Mongo Eloquent lib
            'body' => 'required',
            #'publish_at' => 'nullable|date',
        ]);


        $postId = $request->input('postId');

        # Either create a new post, or look up an existing post to edit.
        if (is_null($postId)) {
            $post = new \App\Posts();
        } else {
            $post = \App\Posts::find($postId);
        }

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->intro = $request->input('intro');
        $post->body = $request->input('body');

        # If the intro isn't supplied, we want to take a small chunk of the body
        # stripped of all markup (as it's a wysiwyg).
        if (!$post->intro) {
            $introCharLen = 300;
            $intro = strip_tags($post->body);
            $post->intro = substr($intro, 0, $introCharLen);

            # If we're over the request char limit, we're probably cutting the
            # middle of a word off. Suffix with ...
            if (strlen($intro) > $introCharLen) {
                $post->intro .= "...";
            }
        }

        # @todo
        $now = new \DateTime("now");
        $post->postDate = $now->format("Y-m-d H:i:s");

        $result = $post->save();

        $request->session()->flash('message',
            "Post '$post->title' " . (is_null($postId) ? "created" : "updated")
        );

        return redirect("admin/posts/");

    }

}
