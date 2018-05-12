@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="quote">The beautiful Laravel</p>
        </div>
    </div>
    @foreach($posts as $post)
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="post-title">{{ $post->title }}</h1>
            <p>{{ $post->content }}!</p>
            <p><a href="{{ route('blog.post', ['id' => $post->id]) }}">Read more...</a></p>
            <p><a href="{{ route('blog.like', ['id' => $post->id]) }}">Likes: </a> {{ $post->likes->first()->count }}</p>4
            @if($post->tags()->get()->count() > 0 )
                <ul class="list-group">
                @foreach($post->tags()->get() as $tag)
                    <li class="list-group-item">{{ $tag->tag }}</li>                
                @endforeach
                </ul>
            @endif
        </div>
    </div>
    <hr>
    @endforeach
@endsection