@extends('layouts.app')

@section('title', 'Success Stories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Success Stories</h1>
</div>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Story</th>
            <th>Member ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($successStories as $successStory)
        <tr>
            <td>{{ $successStory->id }}</td>
            <td>{{ $successStory->title }}</td>
            <td>{{ $successStory->story }}</td>
            <td>{{ $successStory->member_id }}</td>
            <td>
                <a href="{{ route('success_stories.edit', $successStory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('success_stories.destroy', $successStory->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $successStories->links() }}
@endsection