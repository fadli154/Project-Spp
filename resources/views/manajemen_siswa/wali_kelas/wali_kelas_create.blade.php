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
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/wali-kelas">Wali Kelas</a></div>
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
                                <a href="/wali-kelas">
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                            </div>
                            <div class="col-">
                                <h4 class="text-primary capitalize">Tambah Data Wali Kelas</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form action="/wali-kelas" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="capitalize" for="nama_wali_kelas">Masukkan Nama Wali Kelas : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                            </div>
                                            <input type="text"
                                                class="form-control @error('nama_wali_kelas') is-invalid @enderror"
                                                placeholder="Masukkan Nama Wali Kelas" value="{{ old('nama_wali_kelas') }}"
                                                id="nama_wali_kelas" name="nama_wali_kelas">
                                        </div>
                                        <span class="text-danger">
                                            @error('nama_wali_kelas')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label class="capitalize" for="nip_wali_kelas">Masukkan NIP Wali Kelas : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-key-fill"></i>
                                                </div>
                                            </div>
                                            <input type="number"
                                                class="form-control @error('nip_wali_kelas') is-invalid @enderror"
                                                placeholder="Masukkan NIP Wali Kelas" value="{{ old('nip_wali_kelas') }}"
                                                id="nip_wali_kelas" name="nip_wali_kelas">
                                        </div>
                                        <span class="text-danger">
                                            @error('nip_wali_kelas')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="capitalize" for="jabatan">Pilih Jabatan : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-user-plus"></i>
                                                </div>
                                            </div>
                                            <select class="form-control @error('jabatan') is-invalid @enderror"
                                                id="jabatan" name="jabatan">
                                                <option selected disabled>Pilih Jabatan</option>
                                                <option value="TP" {{ old('tahun_program') == 'TP' ? 'selected' : '' }}>
                                                    Tenaga Pendidik</option>
                                                <option value="TK" {{ old('tahun_program') == 'TK' ? 'selected' : '' }}>
                                                    Tenaga Kependidikan</option>
                                            </select>
                                        </div>
                                        <span class="text-danger">
                                            @error('jabatan')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label class="capitalize" for="status_pegawai">Pilih Status Pegawai : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-list"></i>
                                                </div>
                                            </div>
                                            <select class="form-control @error('status_pegawai') is-invalid @enderror"
                                                id="status_pegawai" name="status_pegawai">
                                                <option selected disabled>Pilih Status Pegawai</option>
                                                <option value="0" {{ old('tahun_program') == '0' ? 'selected' : '' }}>
                                                    Tidak Aktif</option>
                                                <option value="1" {{ old('tahun_program') == '1' ? 'selected' : '' }}>
                                                    Aktif</option>
                                            </select>
                                        </div>
                                        <span class="text-danger">
                                            @error('status_pegawai')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="capitalize" for="jk">Pilih Jenis Kelamin : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-venus-mars"></i>
                                        </div>
                                    </div>
                                    <select class="form-control @error('jk') is-invalid @enderror" id="jk"
                                        name="jk">
                                        <option selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('tahun_program') == 'L' ? 'selected' : '' }}>
                                            Laki-Laki</option>
                                        <option value="P" {{ old('tahun_program') == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('jk')
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
                                    <img class="img-preview img-preview-create img-fluid mt-2 col-sm-2">
                                </div>
                                <span class="text-danger">
                                    @error('foto')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <div class="mr-2">
                                    <a href="/wali-kelas" class="btn btn-warning pe-2 mb-1"><i
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
