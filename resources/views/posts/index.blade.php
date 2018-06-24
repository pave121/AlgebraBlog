@extends('Centaur::layout')

@section('title')
Algebra Blog | All Posts
@endsection


@section('content')
  
    <div class="page-header">
        <div class='btn-toolbar pull-right'>
            <a class="btn btn-primary btn-lg" href="{{ route('posts.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create New Post
            </a>
        </div>
        <h1>All Posts</h1>
    </div>
@endsection