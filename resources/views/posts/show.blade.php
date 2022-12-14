@extends('layouts.app')

@section('title', $post['title'])

@section('content')
{{-- @if($post['is_new'])
<div>A new blog post</div>
@else
<div>old post</div>
@endif 

@unless($post['is_new'])
<div>It is an old post using unless</div>
@endunless 
<h1>{{ $post['title']}}</h1>
<p>{{$post['content']}}</p> --}}
<h1>{{ $post->title }}</h1>
<p>{{$post->content }}</p>
<p>Added {{$post->created_at->diffForHumans() }}</p>

@if (now()->diffInMinutes($post->created_at) < 5)
<div class="alert alert-info">New!</div>  
@endif
@endsection