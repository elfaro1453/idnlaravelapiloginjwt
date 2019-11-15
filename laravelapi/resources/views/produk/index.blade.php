@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            Daftar Produk
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('produk.create') }}">
                                <button class="btn-sm btn-primary float-right">Tambah</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $produksatuan)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $produksatuan->nama }}</td>
                                <td>{{ $produksatuan->harga }}</td>
                                <td>
                                    <form method="POST" action="{{ route('produk.destroy', $produksatuan->id ) }}" class="row">
                                        <div class="col-md-4 mb-2"><a href="{{ route('produk.show', $produksatuan->id ) }}"><button type="button" class="btn-sm btn-success">Lihat</button></a></div>
                                        <div class="col-md-4 mb-2"><a href="{{ route('produk.edit', $produksatuan->id ) }}"><button type="button" class="btn-sm btn-primary">Edit</button></a></div>
                                        @if ( $user->role == 1)
                                        <div class="col-md-4 mb-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-danger">Hapus</button>
                                        </div>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection