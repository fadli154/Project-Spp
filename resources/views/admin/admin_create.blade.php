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
                        <div class="breadcrumb-item d-inline active"><a href="/administrator">Administrator</a></div>
                        <div class="breadcrumb-item d-inline">Tambah Data</div>
                    </div>
                    {{-- Akhir Breadcrumb --}}
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-1 mr-3">
                                <a href="/administrator">
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                            </div>
                            <div class="col-">
                                <h4 class="text-primary">Tambah Data Administrator</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form action="/administrator" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Masukkan Nama : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}"
                                                id="name" name="name">
                                        </div>
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Masukkan Username : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-person-badge-fill"></i>
                                                </div>
                                            </div>
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                placeholder="Masukkan Username" value="{{ old('username') }}" id="username"
                                                name="username">
                                        </div>
                                        @error('username')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="level">Pilih Level : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-layers-fill"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" id="level" name="level">
                                                <option selected disabled>Pilih Level</option>
                                                <option value="administrator" selected>Administrator</option>
                                                <option value="petugas" disabled>Petugas</option>
                                                <option value="wali" disabled>wali</option>
                                            </select>
                                        </div>
                                        @error('level')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">

                                    <div class="form-group">
                                        <label for="email">Masukkan Email : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-envelope-fill"></i>
                                                </div>
                                            </div>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                placeholder="contoh154@gmail.com" value="{{ old('email') }}" id="email"
                                                name="email">
                                        </div>
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp">Masukkan Nomor Telepon : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-telephone-fill"></i>
                                                </div>
                                            </div>
                                            <input type="number"
                                                class="form-control @error('no_telp') is-invalid @enderror"
                                                placeholder="Masukkan Nomor Telepon" value="{{ old('no_telp') }}"
                                                id="no_telp" name="no_telp">
                                        </div>
                                        @error('no_telp')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Masukkan Password : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-lock-fill"></i>
                                                </div>
                                            </div>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Masukkan Password" value="{{ old('password') }}" id="password"
                                                name="password">
                                        </div>
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto">Masukkan Foto : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="bi bi-file-earmark-image"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input @error('foto') is-invalid @enderror" id="foto"
                                            name="foto" onchange="previewImage()">
                                        <label class="custom-file-label" for="foto">Pilih Foto</label>
                                    </div>
                                    <input type="file" class="custom-file-input ">
                                    <img class="img-preview img-preview-create img-fluid mt-2 col-sm-2">
                                </div>
                                @error('foto')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <div class="mr-2">
                                    <a href="/administrator" class="btn btn-warning pe-2 mb-1"><i
                                            class="bi bi-arrow-90deg-left fs-6 mr-1"></i> <span
                                            class="bi-text">Kembali</span>
                                    </a>
                                </div>
                                <div class="mr-2">
                                    <button type="submit" class="btn btn-primary mb-1 "><i
                                            class="bi bi-clipboard-plus-fill fs-6 mr-1"></i>
                                        <span class="bi-text">Tambah Data</span></button>
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
    </section>
@endsection
