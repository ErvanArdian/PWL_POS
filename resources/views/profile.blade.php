@extends('layouts.template')
@section('content')
<style>
    .profile-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        padding: 20px;
    }
    .profile-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 800px;
        display: flex;
        padding: 20px;
        margin-top: 20px;
    }
    .profile-image-container {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 20px;
    }
    .profile-user-img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 2px solid #dad6d6;  /* Changed border to green */
        transition: transform 0.3s ease;
    }
    .profile-user-img:hover {
        transform: scale(1.05);
    }
    .profile-details {
        flex: 2;
    }
    .profile-username {
        font-size: 1.75rem;
        color: #5a5a5a;
        margin-bottom: 10px;
    }
    .profile-level {
        color: #6c757d;
        margin-bottom: 20px;
    }
    .list-group-item {
        border: none;
        padding: 5px 0;
    }
    .btn-success {
        background-color: #284dc5;
        border-color: #28a745;
        font-size: 0.875rem;
        padding: 6px 12px;
    }
    .custom-file-label {
        margin-top: 10px;
        font-size: 0.9rem;
    }
    .upload-form {
        margin-top: 20px;
        text-align: center;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-success card-outline"> <!-- Changed the card class to success for green -->
                <div class="card-body box-profile">
                  <div class="profile-image-container">
                    <img class="profile-user-img img-fluid img-circle" 
                        @if (file_exists(public_path('storage/uploads/profile_pictures/'.auth()->user()->username.'/'.auth()->user()->username.'_profile.png')))
                            src="{{ asset('storage/uploads/profile_pictures/'. auth()->user()->username .'/'.auth()->user()->username.'_profile.png') }}"
                        @endif
                        @if (file_exists(public_path('storage/uploads/profile_pictures/'.auth()->user()->username.'/'.auth()->user()->username.'_profile.jpg')))
                            src="{{ asset('storage/uploads/profile_pictures/'. auth()->user()->username .'/'.auth()->user()->username.'_profile.jpg') }}"
                        @endif
                        @if (file_exists(public_path('storage/uploads/profile_pictures/'.auth()->user()->username.'/'.auth()->user()->username.'_profile.jpeg')))
                            src="{{ asset('storage/uploads/profile_pictures/'. auth()->user()->username .'/'.auth()->user()->username.'_profile.jpeg') }}"
                        @endif
                    alt="User profile picture">
                    <form action="{{ route('upload.foto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="upload_foto" name="foto" accept="image/*">
                        <button type="submit" class="btn btn-success btn-sm mt-2 ubah-foto-btn">Ubah Foto</button> <!-- Changed to btn-success for green -->
                        <br>
                    </form>
                  </div>
                  
                  <h3 class="profile-username text-center">{{ auth()->user()->nama}}</h3>
                  <p class="text-muted text-center"> {{auth()->user()->level->level_nama}} </p>
                  <div class=" mt-2">
                    <form action="{{ route('update.profile') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama" class="text-left">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="{{ auth()->user()->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-left">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="{{ auth()->user()->username }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-left">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Kosongi bila tidak diganti">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi password">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Perbarui Data Diri</button>
                        <br>
                    </form>
                    </div>
            
                  <a href="{{ url('/')}}" class="btn btn-success btn-block"><b>Kembali</b></a> <!-- Changed to btn-success for green -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
