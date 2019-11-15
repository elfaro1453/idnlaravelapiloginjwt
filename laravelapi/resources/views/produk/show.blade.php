@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informasi Produk</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $produk->id }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->harga }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-4 mb-2"><a href="{{ route('produk.edit', $produk->id ) }}"><button type="button" class="btn-sm btn-primary">Edit</button></a></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection