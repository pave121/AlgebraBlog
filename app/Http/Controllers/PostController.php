<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Models\Post;
use Exception;

class PostController extends Controller
{
    
    public function __construct()
    {
        // Middleware
        $this->middleware('sentinel.auth');
     
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Sentinel::getUser()->id;
        if(Sentinel::getUser()->inRole('administrator')){
            $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        }
        else{
            $posts = Post::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(20);
        }
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        $user_id = Sentinel::getUser()->id;  
        $data = array(
            'title' =>trim($request->get('title')),
            'content' =>trim($request->get('content')),
            'user_id' => $user_id
        );
        
        $post = new Post;
        try{
            $post_id = $post->SavePost($data)->id;
            } catch (Exception $e) {
                session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
        session()->flash('success', 'You have successfully added a new post!');
        return redirect()->back();
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData=$request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        
         $post = Post::findOrFail($id);
        
         $data = array(
            'title' =>trim($request->get('title')),
            'content' =>trim($request->get('content'))
        );
        
        try{
            $post_id = $post->updatePost($data);
            } catch (Exception $e) {
                session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
        session()->flash('success', 'You have successfully updated a post!');
        return redirect()->route('posts.index');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        try{
            $post->delete();
        }catch (Exception $e) {
                session()->flash('error', $e->getMessage());
            return redirect()->back();
    }
        session()->flash('success', 'You have successfully deleted a post!');
        return redirect()->back();
    }
}
