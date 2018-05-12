@extends('layouts.admin')

@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.update') }}" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input
                            type="text"
                            class="form-control"
                            id="content"
                            name="content"
                            value="{{ $post->content }}">
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select class="form-control" name="tag[]" multiple="multiple">
                        @foreach($tags as $tag)
                            <option value='{{ $tag->id }}'

                                @if($post->tags()->get()->contains($tag->id))
                                    selected="selected"
                                @endif
                                >{{ $tag->tag }}</option>
                        @endforeach
                    </select>
                </div>
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $post->id }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection