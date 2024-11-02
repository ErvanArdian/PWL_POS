@extends('layouts.template')
@section('content')
<style>
    .profile-user-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 3px solid #adb5bd;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" 
                            @if (file_exists(public_path('storage/uploads/profile_pictures/'.auth()->user()->username.'/'.auth()->user()->username.'_profile.png')))
                                src="{{ asset('storage/uploads/profile_pictures/'. auth()->user()->username .'/'.auth()->user()->username.'_profile.png') }}"
                            @elseif (file_exists(public_path('storage/uploads/profile_pictures/'.auth()->user()->username.'/'.auth()->user()->username.'_profile.jpg')))
                                src="{{ asset('storage/uploads/profile_pictures/'. auth()->user()->username .'/'.auth()->user()->username.'_profile.jpg') }}"
                            @elseif (file_exists(public_path('storage/uploads/profile_pictures/'.auth()->user()->username.'/'.auth()->user()->username.'_profile.jpeg')))
                                src="{{ asset('storage/uploads/profile_pictures/'. auth()->user()->username .'/'.auth()->user()->username.'_profile.jpeg') }}"
                            @endif
                            alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ auth()->user()->nama }}</h3>
                    <p class="text-muted text-center">{{ auth()->user()->level->level_nama }}</p>

                    <!-- Form untuk upload foto profil -->
                    <form action="{{ route('upload.foto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group text-center">
                            <input type="file" id="upload_foto" name="foto" accept="image/*">
                            <button type="submit" class="btn btn-success btn-sm mt-2">Ubah Foto</button>
                        </div>
                    </form>

                    <!-- Form untuk update profil -->
                    <form action="{{ route('update.profile') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="{{ auth()->user()->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="{{ auth()->user()->username }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Kosongi jika tidak ingin mengganti">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi password">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Perbarui Data Diri</button>
                    </form>
                    
                    <a href="{{ url('/') }}" class="btn btn-primary btn-block mt-3"><b>Kembali</b></a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop