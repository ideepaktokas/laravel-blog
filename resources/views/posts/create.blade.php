@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    {{-- @error('title') <div>{{ $message }}</div>    @enderror --}}
    {{-- @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>    
                @endforeach
            </ul>
        </div>
    @endif --}}
    {{-- <div><input type="text" name="title" value="{{ old('title') }}"></div>
    <div><textarea name="content" id="" cols="30" rows="10">{{ old('content') }}</textarea></div> --}}
    @include('posts.partials.form')
    <div><input type="submit" value="Create" class="btn btn-primary btn-block"></div>
</form>
@endsection