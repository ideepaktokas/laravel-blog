@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    {{-- @foreach($posts as $key => $post)
        <div>{{ $key }}.{{ $post['title'] }}</div>
    @endforeach --}}

    {{-- @break($key = 2) --}}
    {{-- @continue($key = 1) --}}
    
    {{-- @each('posts.partials.post', $posts, 'post', 'No post found!') --}}
    @forelse ($posts as $key => $post)
        @include('posts.partials.post')
    @empty
        No posts found!
    @endforelse
@endsection