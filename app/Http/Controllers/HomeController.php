<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * 
     */
    public function __invoke()
    {
        $posts = Post::all();
        //KLJUČ, ne var 'posts' postaje var u view
        return view('home', ['posts' => $posts]);
    }
}
