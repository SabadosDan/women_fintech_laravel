@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')
<h1>Edit Member</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('members.update', $member->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $member->first_name }}"
            required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $member->last_name }}"
            required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $member->email }}" required>
    </div>
    <div class="mb-3">
        <label for="profession" class="form-label">Profession</label>
        <input type="text" class="form-control" id="profession" name="profession" value="{{ $member->profession }}"
            required>
    </div>
    <div class="mb-3">
        <label for="linkedin_profile" class="form-label">LinkedIn Profile</label>
        <input type="url" class="form-control" id="linkedin_profile" name="linkedin_profile"
            value="{{ $member->linkedin_profile }}">
    </div>
    <button type="submit" class="btn btn-primary">Update Member</button>
</form>
@endsection