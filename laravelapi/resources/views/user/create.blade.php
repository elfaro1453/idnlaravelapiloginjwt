@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah User</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <label for="inputNama" class="col-sm-2 col-form-label">Nama : </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputNama" name="name" placeholder="Masukkan Nama" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email : </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Masukkan Email" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password : </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Masukkan Password minimal 8 huruf" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputRole" class="col-sm-2 col-form-label">Role: </label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputRole" name="role" placeholder="Masukkan 1 untuk Admin dan 2 untuk Member" value="" required min="1" max="2">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection