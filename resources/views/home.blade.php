@extends('layout.master')

@section('title', 'Home')

@section('content')
<!-- Page content here -->
<div class="container w-50">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="/submit" enctype="multipart/form-data">
        <h3 class="mt-3 mb-3">Registration Form</h3>
        @csrf
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Your first name">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Your last name">
        </div>
        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label>Storage Type</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="storageType" id="spaceStorage" value="space">
                <label class="form-check-label" for="spaceStorage">
                    Space Storage
                </label>
            </div>
            <!-- <div class="form-check">
                <input class="form-check-input" type="radio" name="storageType" id="blockStorage" value="block">
                <label class="form-check-label" for="blockStorage">
                    Block Storage
                </label>
            </div> -->
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
    <button onclick="window.location.href=window.location.origin + '/files'" class="btn btn-secondary mt-3">
        <i class="fas fa-folder"></i> See All Files
    </button>
</div>
@endsection