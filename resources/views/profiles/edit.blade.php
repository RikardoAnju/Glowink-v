<!-- resources/views/profiles/edit.blade.php -->

@extends('layout.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="container">
        <h1 class="my-4">Edit Profile</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_member">Name</label>
                <input type="text" name="nama_member" id="nama_member" class="form-control" value="{{ $profile->nama_member }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Date of Birth</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $profile->tanggal_lahir }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $profile->email }}" required>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Gender</label>
                <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control" value="{{ $profile->jenis_kelamin }}" required>
            </div>

            <div class="form-group">
                <label for="pekerjaan">Work</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="{{ $profile->pekerjaan }}" required>
            </div>

            <div class="form-group">
                <label for="alamat">Address</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $profile->alamat }}" required>
            </div>

            <div class="form-group">
                <label for="foto_profile">Profile Picture</label>
                <input type="file" name="foto_profile" id="foto_profile" class="form-control">
                @if($profile->foto_profile)
                    <img src="{{ Storage::url($profile->foto_profile) }}" alt="Profile Picture" class="img-thumbnail mt-2" style="width: 150px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
