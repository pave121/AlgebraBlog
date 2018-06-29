<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * 
     */
    public function __invoke()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        //KLJUČ, ne var 'posts' postaje var u view
        return view('home', ['posts' => $posts]);
    }
      /**
     * Show the single post page.
     *
     * @return Response
     */
    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $comments = Comment::where('post_id', $post['id'])->paginate(20);
        return view('post', ['post' => $post, 'comments' => $comments]);
    }
   
}
