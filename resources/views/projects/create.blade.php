@extends('layouts.app')

@section('content')

    <h1>Create a Project</h1>

    <form action="/projects" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary">Create</button>
        <a href="/projects" class="btn btn-danger">Cancel</a>
    </form>

@endsection