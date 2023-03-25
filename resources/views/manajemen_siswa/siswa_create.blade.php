@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-8 col-sm-8">
                        <h4 class="text-dark capitalize">Manajemen Siswa</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-4 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/siswa">List Siswa</a></div>
                        <div class="breadcrumb-item d-inline capitalize">Tambah Data</div>
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
                                <a href="/siswa">
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                            </div>
                            <div class="col-">
                                <h4 class="text-primary capitalize">Tambah Data Siswa</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form action="/siswa" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="capitalize" for="nama">Masukkan Nama Siswa : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                placeholder="Masukkan Nama Siswa" value="{{ old('nama') }}" id="nama"
                                                name="nama">
                                        </div>
                                        @error('nama')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="capitalize" for="nisn">Masukkan NISN Siswa : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-key-fill"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control @error('nisn') is-invalid @enderror"
                                                placeholder="Masukkan NIP Siswa" value="{{ old('nisn') }}" id="nisn"
                                                name="nisn">
                                        </div>
                                        @error('nisn')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="capitalize" for="nik">Masukkan NIK Siswa : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-key"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                                placeholder="Masukkan NIP Siswa" value="{{ old('nik') }}" id="nik"
                                                name="nik">
                                        </div>
                                        @error('nik')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="capitalize" for="wali_id">Pilih Wali Murid : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            <select class="form-control @error('wali_id') is-invalid @enderror select2"
                                                id="select2" name="wali_id" placeholder="pilih">
                                                <option value="" selected>Pilih Wali Murid</option>
                                                @foreach ($waliList as $data)
                                                    <option value="{{ $data->id }}"
                                                        {{ old('wali_id') == $data->id ? 'selected' : '' }}>
                                                        {{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('wali_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="capitalize" for="kelas_id">Pilih Kelas : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-cast"></i>
                                                </div>
                                            </div>
                                            <select class="form-control @error('kelas_id') is-invalid @enderror select2"
                                                id="kelas_id select-state" name="kelas_id" placeholder="pilih">
                                                <option value="" selected disabled>Pilih Kelas</option>
                                                @foreach ($kelasList as $data)
                                                    <option value="{{ $data->kelas_id }}"
                                                        {{ old('kelas_id') == $data->kelas_id ? 'selected' : '' }}>
                                                        {{ $data->kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('kelas_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="capitalize" for="jk">Pilih Jenis Kelamin : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-venus-mars"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" id="jk" name="jk">
                                                <option selected>Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>
                                                    Laki Laki</option>
                                                <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                        @error('jk')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="capitalize" for="tempat_lahir">Masukkan Tempat Lahir Siswa : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        placeholder="Masukkan Tempat Lahir Siswa" value="{{ old('tempat_lahir') }}"
                                        id="tempat_lahir" name="tempat_lahir">
                                </div>
                                @error('tempat_lahir')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="capitalize" for="foto">Masukkan Foto : </label>
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
                                        <label class="custom-file-label" class="capitalize" for="foto">Pilih
                                            Foto</label>
                                    </div>
                                    <input type="file" class="custom-file-input ">
                                    <img class="img-preview img-preview-create img-fluid mt-2 col-sm-2">
                                </div>
                                @error('foto')
                                    {{ $message }}
                                @enderror
                            </div>
                            <input type="hidden" name="status" value="1">
                            <div class="col-12 d-flex justify-content-end">
                                <div class="mr-2">
                                    <a href="/siswa" class="btn btn-warning pe-2 mb-1"><i
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
