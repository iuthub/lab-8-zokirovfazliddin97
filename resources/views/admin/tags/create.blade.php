@extends('layouts.admin')

@section('content')
    @include('partials.errors')
    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.tag.store') }}" method="post">
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" class="form-control" id="tag" name="tag">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection