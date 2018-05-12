@extends('layouts.admin')

@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.tag.update', ['id'=>$tag->id]) }}" method="post">
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" class="form-control" id="tag" name="tag" value="{{ $tag->tag }}">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection