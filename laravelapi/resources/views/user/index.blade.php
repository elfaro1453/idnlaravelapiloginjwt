@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Daftar User</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ( $user->role == 1)
                                    Admin
                                    @else
                                    Member
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('user.destroy', $user->id ) }}" class="row">

                                        <div class="col-md-4 mb-2"><a href="{{ route('user.show', $user->id ) }}"><button type="button" class="btn-sm btn-success">Lihat</button></a></div>
                                        <div class="col-md-4 mb-2"><a href="{{ route('user.edit', $user->id ) }}"><button type="button" class="btn-sm btn-primary">Edit</button></a></div>
                                        @if ( $user->role != 1)
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