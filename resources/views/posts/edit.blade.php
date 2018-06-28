@extends('Centaur::layout')

@section('title')
Algebra Blog | Create New Post
@endsection


@section('content')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>Edit Post</h1>
                   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form method="post" action="{{ route('posts.update', $post->id)}}">
                   <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
                       <label for="title" class="control-label">Post Title</label>
                       <input type="text" class="form-control" id="title" name="title" placeholder="Enter Post Title" value="{{ $post->title }}">
                       {!! ($errors->has('title')) ? $errors->first('title', '<p class="text-danger">:message</p>') : '' !!}
                    </div>
                    <div class="form-group {{ ($errors->has('content')) ? 'has-error' : '' }}">
                      
                       <label for="content" class="control-label">Post Content</label>
                        <textarea class="form-control" id="content" name="content" rows="15">{{ $post->content }}</textarea>
                        {!! ($errors->has('title')) ? $errors->first('content', '<p class="text-danger">:message</p>') : '' !!}
                    </div>
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                       <button type="submit" class="btn btn-primary">Update</button>
                    
                </form>
            </div>
        </div>
@endsection