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
        <h1>All Posts
        @if(!Sentinel::getUser()->inRole('administrator'))
        from
         {{ Sentinel::getUser()->email }}
        
        @endif
        </h1>
        
      <div class="row">
            @foreach($posts as $post)
              
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                      <img src="http://via.placeholder.com/600x300" class="img-fluid" />
                          <div class="caption">
                           <h4>Author: {{ $post->user->email }}</h4>
                            <h3>{{ $post->title }}</h3>
                            <p>{{ str_limit($post->content, 150) }}</p>
                            <p><a href="{{ route('home.post.show', $post->slug) }}" class="btn btn-primary" role="button">Read More</a>
                            <a href="{{ route('home.post.show', $post->slug) }}" class="btn btn-danger pull-right" role="button">Delete</a>
                            <a href="{{ route('home.post.show', $post->slug) }}" class="btn btn-warning pull-right" style="margin-right:5px" role="button">Edit</a>
                              </p>
                          </div>
                     </div>
                  </div>
                  
            @endforeach
            
        </div>
   
@endsection
    </div>
