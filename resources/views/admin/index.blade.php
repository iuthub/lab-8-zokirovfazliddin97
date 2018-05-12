@extends('layouts.admin')

@section('content')
    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.create') }}" class="btn btn-success">New Post</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.tag.create') }}" class="btn btn-info">New Tag</a>
        </div>
    </div>
    <hr>
    <div class="col-md-4">
        @foreach($posts as $post)
            <div class="row">
                <div class="col-md-12">
                    <p><strong>{{ $post->title }}</strong> 
                        <a href="{{ route('admin.edit', ['id' => $post->id]) }}">Edit</a>
                        <a href="{{ route('admin.delete', ['id' => $post->id]) }}">Delete</a>
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="col-md-4">
        @foreach($tags as $tag)
            <div class="row">
                <div class="col-md-12">
                    <p><strong>{{ $tag->tag }}</strong> 
                    <a href="{{ route('admin.tag.edit', ['id' => $tag->id]) }}">Edit</a>
                    <a href="{{ route('admin.tag.delete', ['id' => $tag->id]) }}">Delete</a>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection