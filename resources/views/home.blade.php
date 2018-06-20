@extends('Centaur::layout')

@section('title')
Algebra Blog
@endsection


@section('content')
    @if($posts->count() > 0)
    
    @else
        <h1>Trenutno nema objava!</h1>
    @endif
@endsection