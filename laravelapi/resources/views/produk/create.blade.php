@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Produk</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('produk.store') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <label for="inputNama" class="col-sm-2 col-form-label">Nama : </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputNama" name="nama" placeholder="Masukkan Nama Produk" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputHarga" class="col-sm-2 col-form-label">Harga : </label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputHarga" name="harga" placeholder="Masukkan Harga" value="" required min="0">
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