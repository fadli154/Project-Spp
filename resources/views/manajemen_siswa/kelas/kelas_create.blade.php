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
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/kelas">Kelas</a></div>
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
                                <a href="/kelas">
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                            </div>
                            <div class="col-">
                                <h4 class="text-primary capitalize">Tambah Data Kelas</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form action="/kelas" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="capitalize" for="kelas_id">Masukkan ID Kelas : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-key-fill"></i>
                                                </div>
                                            </div>
                                            <input type="text"
                                                class="form-control @error('kelas_id') is-invalid @enderror"
                                                placeholder="Contoh : XIRPL2022" value="{{ old('kelas_id') }}"
                                                id="kelas_id" name="kelas_id">
                                        </div>
                                        <span class="text-danger">
                                            @error('kelas_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label class="capitalize" for="kelas">Masukkan Nama Kelas : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-cast"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control @error('kelas') is-invalid @enderror"
                                                placeholder="Contoh : Rekayasa Perangkat Lunak" value="{{ old('kelas') }}"
                                                id="kelas" name="kelas">
                                        </div>
                                        <span class="text-danger">
                                            @error('kelas')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="capitalize" for="angkatan">Masukkan angkatan : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-calendar-event-fill"></i>
                                                </div>
                                            </div>
                                            <input type="number"
                                                class="form-control @error('angkatan') is-invalid @enderror"
                                                placeholder="Contoh : 2022" value="{{ old('angkatan') }}" id="angkatan"
                                                name="angkatan">
                                        </div>
                                        <span class="text-danger">
                                            @error('angkatan')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label class="capitalize" for="id_kk">Pilih Konsentrasi Keahlian : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-briefcase"></i>
                                                </div>
                                            </div>
                                            <select class="form-control select2 @error('id_kk') is-invalid @enderror"
                                                id="id_kk" name="id_kk">
                                                <option disabled selected>Pilih Konsentrasi Keahlian</option>
                                                @foreach ($konsentrasiList as $data)
                                                    <option value="{{ $data->id_kk }}"
                                                        {{ old('id_kk') == $data->id_kk ? 'selected' : '' }}>
                                                        {{ $data->konsentrasi_keahlian }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">
                                            @error('id_kk')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="capitalize" for="nip_wali_kelas">Pilih Wali Kelas : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-user-tie"></i>
                                        </div>
                                    </div>
                                    <select class="form-control select2 @error('nip_wali_kelas') is-invalid @enderror"
                                        id="nip_wali_kelas select2" name="nip_wali_kelas">
                                        <option disabled selected>Pilih Wali Kelas</option>
                                        @foreach ($waliKelasList as $data)
                                            <option value="{{ $data->nip_wali_kelas }}"
                                                {{ old('nip_wali_kelas') == $data->nip_wali_kelas ? 'selected' : '' }}>
                                                {{ $data->nama_wali_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('nip_wali_kelas')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="capitalize" for="foto">Masukkan Foto : </label>
                                <small class="d-block">Catatan : Masukkan Foto dengan Format(png, jpg, jpeg), maksimal 1
                                    mb</small>
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
                                    <img class="img-preview img-preview-kelas img-fluid mt-2 col-sm-2">
                                </div>
                                <span class="text-danger">
                                    @error('foto')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <div class="mr-2">
                                    <a href="/kelas" class="btn btn-warning pe-2 mb-1"><i
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
