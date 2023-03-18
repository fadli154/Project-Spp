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
                        <div class="breadcrumb-item d-inline">Edit Data</div>
                    </div>
                    {{-- Akhir Breadcrumb --}}
                </div>
            </div>
        </div>

        @foreach ($editData as $data)
            <div class="section-body">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-1 mr-3">
                                    <a href="/petugas">
                                        <i class="bi bi-arrow-left"></i>
                                    </a>
                                </div>
                                <div class="col-">
                                    <h4 class="text-primary">Edit Data Petugas</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="/petugas/{{ $data->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" name="oldImage" value="{{ $data->foto }}">
                                            @if ($data->foto)
                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                    class="img-preview foto-user img-fluid mt-2 d-block ml-4">
                                            @else
                                                <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                    class="img-preview foto-user img-fluid mt-2 d-block ml-4">
                                            @endif
                                        </div>

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
                                                    value="{{ $data->name }}" id="name" name="name">
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
                                                    value="{{ $data->username }}" id="username" name="username">
                                            </div>
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="level">Pilih Level : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text  bg-secondary">
                                                        <i class="bi bi-layers-fill"></i>
                                                    </div>
                                                </div>
                                                <select class="form-control" id="level" name="level">
                                                    <option selected disabled>Pilih Level</option>
                                                    <option value="administrator">Administrator</option>
                                                    <option value="petugas" selected>Petugas</option>
                                                    <option value="wali">wali</option>
                                                </select>
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
                                                    value="{{ $data->email }}" id="email" name="email">
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
                                                    value="{{ $data->no_telp }}" id="no_telp" name="no_telp">
                                            </div>
                                            @error('no_telp')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Ubah Foto : </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-secondary">
                                                <i class="bi bi-file-earmark-image"></i>
                                            </div>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('foto') is-invalid @enderror"
                                                id="foto" name="foto" onchange="previewImage()">
                                            <label class="custom-file-label" for="foto">Pilih Foto Baru</label>
                                            <input type="hidden" name="oldImage" value="{{ $data->foto }}">
                                        </div>
                                        <input type="file" class="custom-file-input ">
                                        <img class="img-preview img-fluid mt-2 col-sm-2">
                                    </div>
                                    @error('foto')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <div class="mr-2">
                                        <a href="/petugas" class="btn btn-warning pe-2 mb-1"><i
                                                class="bi bi-arrow-90deg-left fs-6 mr-1"></i> <span
                                                class="bi-text">Kembali</span>
                                        </a>
                                    </div>
                                    <div class="mr-2">
                                        <button type="submit" class="btn btn-primary mb-1 "><i
                                                class="bi bi-clipboard-plus-fill fs-6 mr-1"></i>
                                            <span class="bi-text">Edit Data</span></button>
                                    </div>
                                    <div class="">
                                        <button type="reset" class="btn btn-secondary"><i
                                                class="bi bi-arrow-counterclockwise fs-6 mr-1"></i> <span
                                                class="bi-text">Reset</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
