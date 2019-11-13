@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id ) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="inputNama" class="col-sm-2 col-form-label">Nama : </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputNama" name="name" placeholder="Masukkan Nama Anda." value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email : </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Masukkan Email Anda." value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password : </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Kosongi Jika Tidak Ingin Merubah Password." value="">
                            </div>
                        </div>
                        <input type="hidden" id="inputEmail" name="role" value="{{ $user->role }}">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection