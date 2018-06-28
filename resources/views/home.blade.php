@extends('Centaur::layout')

@section('title')
Algebra Blog
@endsection


@section('content')
 
    @if($posts->count() > 0)
        <div class="row">
            @foreach($posts as $post)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                      <img src="http://via.placeholder.com/600x300" class="img-fluid" />
                          <div class="caption">
                            <h3>{{ $post->title }}</h3>
                            <p>{{ str_limit($post->content, 150) }}</p>
                            <p><a href="{{ route('home.post.show', $post->slug) }}" class="btn btn-primary" role="button">Read More</a></p>
                          </div>
                     </div>
                  </div>
            @endforeach
        </div>
        <div class="row">
            {{ $posts->links() }}
        </div>
    @else
        <h1>Trenutno nema objava!</h1>
    @endif
@endsection