@extends('layouts.template')

@section('title', 'Profile')

@section('content')
<!-- Display success message if available -->
@if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-5">
    <div class="row justify-content-center"> <!-- Use Bootstrap's row for layout -->
        <!-- Main Profile Card -->
        <div class="col-md-6 col-lg-4"> <!-- Adjust column sizes for responsiveness -->
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header text-center">
                    <h4 class="card-title">Your Profile Information</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if ($user->profile_picture)
                            <img class="profile-user-img img-fluid img-circle" 
                                 src="{{ asset('storage/' . $user->profile_picture) }}" 
                                 alt="User profile picture"
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <i class="fas fa-user-circle" style="font-size: 100px; color: #ccc;"></i>
                        @endif
                    </div>
                    <h5 class="profile-username text-center" style="color: #333;">{{ $user->name }}</h5>
                    <p class="text-muted text-center">{{ $user->level->level_nama }}</p>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>Nama:</b> <span class="float-right">{{ $user->nama }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Username:</b> <span class="float-right">{{ $user->username }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Level:</b> <span class="float-right">{{ $user->level->level_nama }}</span>
                        </li>
                    </ul>

                    <!-- Form for Profile Picture Upload -->
                    <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <label for="profile_picture">Upload New Profile Picture:</label>
                        <input type="file" name="profile_picture" class="form-control" accept="image/*" required>
                        <button type="submit" class="btn btn-primary mt-2 w-100">Upload</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update Profile Information Card -->
        <div class="col-md-6 col-lg-4 mt-4 mt-md-0">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header text-center">
                    <h4 class="card-title">Update Profile</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Change Password Card -->
        <div class="col-md-6 col-lg-4 mt-4 mt-md-0">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header text-center">
                    <h4 class="card-title">Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.changePassword') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="password">New Password:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password:</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
