@extends('layouts.app')

@section('title', 'Members')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Members</h1>
    <a href="{{ route('members.create') }}" class="btn btn-primary">Add Member</a>
    <a href="{{ route('members.export') }}" class="btn btn-secondary">Export CSV</a>
</div>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form method="GET" action="{{ route('members.index') }}" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <input type="text" name="first_name" class="form-control" placeholder="First Name"
                value="{{ request('first_name') }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="profession" class="form-control" placeholder="Profession"
                value="{{ request('profession') }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ request('email') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Profession</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
        <tr>
            <td>{{ $member->id }}</td>
            <td>{{ $member->first_name }}</td>
            <td>{{ $member->last_name }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->profession }}</td>
            <td>
                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $members->links() }}
@endsection