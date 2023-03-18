@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-8 col-sm-8">
                        <h4 class="text-dark">Manajemen Users</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-4 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active"><a href="/petugas">Petugas</a></div>
                        <div class="breadcrumb-item d-inline">Profile Petugas</div>
                    </div>
                    {{-- Akhir Breadcrumb --}}
                </div>
            </div>
        </div>

        @foreach ($detailData as $data)
            <div class="section-body">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-1 mr-3">
                                        <a href="/petugas" title="Kembali">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col-">
                                        <h4 class="text-primary">Profile Petugas</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <a href="/petugas/{{ $data->id }}/edit" class="text-white">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                        data-placement="top" title="Edit Data Petugas"
                                        data-original-title="Edit Data Petugas">
                                        <i class="bi bi-pencil btn-tambah-data"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="/petugas" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        @if ($data->foto)
                                            <div class="justify-content-center mt-4 ml-4">
                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                    alt="foto {{ $data->username }}" class="foto-user">
                                            </div>
                                        @else
                                            <div class="justify-content-center mt-4 ml-4">
                                                <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                    alt="foto {{ $data->username }}" class="foto-user">
                                            </div>
                                        @endif

                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">Nama : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-person-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control capitalize @error('name') is-invalid @enderror"
                                                    value="{{ $data->name }}" id="name" name="name" readonly>
                                            </div>
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-person-badge-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control capitalize @error('username') is-invalid @enderror"
                                                    value="{{ $data->username }}" id="username" name="username" readonly>
                                            </div>
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="level">Akses : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-layers-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control capitalize @error('level') is-invalid @enderror"
                                                    value="{{ $data->level }}" id="level" name="level" readonly>
                                            </div>
                                            @error('level')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email">Email : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-envelope-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ $data->email }}" id="email" name="email" readonly>
                                            </div>
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telp">Nomor Telepon : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-telephone-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('no_telp') is-invalid @enderror"
                                                    value="{{ $data->no_telp }}" id="no_telp" name="no_telp" readonly>
                                            </div>
                                            @error('no_telp')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
    </section>
    @endforeach
@endsection
