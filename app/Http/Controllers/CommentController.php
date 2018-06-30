<?php

namespace App\Http\Controllers;


use Sentinel;
use Exception;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Sentinel::check()){
            $comments = Comment::orderBy('created_at', 'desc')->paginate(20);
        }
        
        return view('post', ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'commentTitle' => 'required|max:255',
            'commentContent' => 'required',
        ]);
        $user_id = Sentinel::getUser()->id;  
        $post_id = $request['postId'];
        $data = array(
            'title' =>trim($request->get('commentTitle')),
            'content' =>trim($request->get('commentContent')),
            'user_id' => $user_id,
            'post_id' => $post_id
        );
        
        $comment = new Comment;
        try{
            $comment_id = $comment->SaveComment($data)->id;
            } catch (Exception $e) {
                session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
        session()->flash('success', 'You have successfully added a new comment!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        
        try{
            $comment->delete();
        }catch (Exception $e) {
                session()->flash('error', $e->getMessage());
            return redirect()->back();
    }
        session()->flash('success', 'You have successfully deleted a comment!');
        return redirect()->back();
    }
    
}
