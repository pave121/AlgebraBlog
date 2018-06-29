@extends('Centaur::layout')

@section('title')
Algebra Blog | {{ $post->title }}
@endsection


@section('content')
  
    <div class="page-header">
        <h1>{{ $post->title }}</h1>
        <small>Author: {{ $post->user->email }}</small><br />
        <small>Published: {{ \Carbon\Carbon::createFromTimestamp(strtotime($post->created_at))->diffForHumans() }}</small>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{ $post->content }}
        </div>
    </div>
    
    <h3 style="margin-top:50px">Comments:</h3> 
    
    <div class="row" style="margin-top:50px">
        <div class="col-sm-8">
            @if(Sentinel::check())
                
            <div class="col-sm-12">
                <form method="post" action="{{ route('comments.store')}}">
                   <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
                       <label for="title" class="control-label">Comment Title</label>
                       <input type="text" class="form-control" id="title" name="title" placeholder="Enter Comment Title">
                       {!! ($errors->has('title')) ? $errors->first('title', '<p class="text-danger">:message</p>') : '' !!}
                    </div>
                    <div class="form-group {{ ($errors->has('content')) ? 'has-error' : '' }}">
                      
                       <label for="content" class="control-label">Comment Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                        {!! ($errors->has('title')) ? $errors->first('content', '<p class="text-danger">:message</p>') : '' !!}
                    </div>
                      {{ csrf_field() }}
                       <button type="submit" class="btn btn-primary">Add Comment</button>
                    
                </form>
            </div>
        </div>
            @else
                <h4 style="margin-bottom:40px">Please log in to post a comment</h4>
            @endif
        </div>
   
    <div class="row" style="margin-top:50px">
        <div class="col-sm-12" style="margin-bottom:50px">
            <div class="media">
                
                  <div style="margin-top:30px" class="media-body">
                   @foreach($comments as $comment)
                    <h4 class="media-heading">{{ $comment->title }}</h4>
                      <p><small>Author: {{ $comment->user->email }}</small></p>
                    {{ $comment->content }}<br><br>
                  </div>
                  @endforeach
                </div>
        </div>
    </div>
@endsection