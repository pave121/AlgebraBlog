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
        
      <div class="row" style="margin-top:20px">
           <div class="col-sm-12">
             @if($posts->count() > 0)
              <div class="table-responsive">
                   <table class="table table-hover">
                       <thead>
                           <tr>
                               <th>#</th>
                               <th>Title</th>
                               <th>Author</th>
                               <th>Published</th>
                               <th>Actions</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($posts as $post)
                               <tr style="background-color: aliceblue">
                               <td>{{ $post->id }}</td>
                               <td>
                                   <a href="{{ route('home.post.show', $post->slug) }}" target="_blank">
                                       {{ $post->title }}
                                   </a>
                               </td>
                               <td>{{ $post->user->email }}</td>
                               <td>{{ date('d.m.Y H:i', strtotime($post->created_at)) }}</td>
                               <td>
                                   <a href="{{ route('posts.edit', $post->id) }}" " class="btn btn-primary">Edit</a>
                                   <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-danger action_confirm" data-method="delete" data-token="{{ csrf_token() }}">Delete</a>
                               </td>
                           </tr>
                           <tr>
                               <td colspan="5"><h4>Komentari:</h4></td>
                           </tr>
                           @foreach ($post->comment as $comment)
                               <tr style="padding-left:10%; border:none;">
                                   <td></td>
                                   <td><b>{{ $comment->title }}</b></td>
                                   <td colspan="2">{{ $comment->user->email }}</td>
                                   <td><a href="{{ route('comments.destroy', $comment->id) }}" class="btn btn-danger action_confirm" data-method="delete" data-token="{{ csrf_token() }}">Delete Comment</a></td>
                               </tr>
                               <tr style="padding-left:10%">
                                  <td></td>
                                   <td colspan="5">{{ $comment->content }}</td>
                               </tr>
                               @endforeach
                           @endforeach
                       </tbody>
                   </table>
              </div>
              {{ $posts->links() }}
              @else
                  <h1>Trenutno nema objava!</h1>
           </div>
            @endif
        </div>
   
@endsection
    </div>
    