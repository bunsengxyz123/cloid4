@extends('layout.master')

@section('title', 'File')

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Each row represents a file -->
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->image_url }}
                </td>
                <td>
                    @if ($user->storage_type === 'space')
                    Space Object Storage
                    @elseif ($user->storage_type === 'block')
                    Block Storage
                    @else
                    {{ $user->storage_type }}
                    @endif
                </td>
                <td>
                    <a href="https://phalkun.sgp1.digitaloceanspaces.com/{{ $user->image_url }}" target="_blank"><i class="fas fa-eye mx-2"></i></a> <!-- View icon -->
                    <a href="{{ route('file.delete', $user) }}" class="text-danger"><i class="fas fa-trash mx-2"></i></a> <!-- Delete icon -->
                </td>
            </tr>
            @endforeach
            <!-- Repeat for each file -->
        </tbody>
    </table>
    <button onclick="window.location.href=window.location.origin + '/'" class="btn btn-secondary mt-3">
        <i class="fa fa-home mx-1"></i> Home
    </button>
</div>
@endsection