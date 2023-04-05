@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-8 col-sm-8">
                        <h4 class="text-dark">Manajemen Siswa</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-4 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active"><a href="/wali-kelas">Pegawai</a></div>
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
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-1 mr-1">
                                        <a href="/wali-kelas">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col-">
                                        <h4 class="text-primary">Edit Data Pegawai</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="/wali-kelas/{{ $data->nip_wali_kelas }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" name="oldImage" value="{{ $data->foto }}">
                                            @if ($data->foto)
                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                    class="img-preview foto-user img-fluid mt-3 d-block ml-4">
                                            @else
                                                @if ($data->jk == 'L')
                                                    <div class="">
                                                        <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                            class="img-preview foto-user img-fluid mt-3 d-block ml-4">
                                                    </div>
                                                @else
                                                    <div class="">
                                                        <img src="{{ asset('img/avatar/avatar-5.png') }}"
                                                            class="img-preview foto-user img-fluid mt-3 d-block ml-4">
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="nama_wali_kelas">Nama Pegawai : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-person-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('nama_wali_kelas') is-invalid @enderror"
                                                            placeholder="Masukkan Nama Pegawai"
                                                            value="{{ $data->nama_wali_kelas }}" id="nama_wali_kelas"
                                                            name="nama_wali_kelas">
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('nama_wali_kelas')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nip_wali_kelas">NIP Pegawai : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-key-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('nip_wali_kelas') is-invalid @enderror"
                                                            placeholder="Masukkan NIP Pegawai"
                                                            value="{{ $data->nip_wali_kelas }}" id="nip_wali_kelas"
                                                            name="nip_wali_kelas">
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
                                                    <label for="jk">Pilih Jenis Kelamin : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text  bg-secondary">
                                                                <i class="fa fa-venus-mars"></i>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="jk" name="jk">
                                                            <option selected disabled>Pilih Jenis Kelamin</option>
                                                            @foreach ($editData as $item)
                                                                <option value="L"
                                                                    {{ $data->jk === 'L' ? 'selected' : '' }}>
                                                                    Laki-Laki</option>
                                                                <option value="P"
                                                                    {{ $data->jk === 'P' ? 'selected' : '' }}>
                                                                    Perempuan</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('jk')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jabatan">Pilih Jabatan : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text  bg-secondary">
                                                                <i class="fa fa-user-plus"></i>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="jabatan" name="jabatan">
                                                            <option selected disabled>Pilih Jabatan</option>
                                                            @foreach ($editData as $item)
                                                                <option value="TP"
                                                                    {{ $data->jabatan === 'TP' ? 'selected' : '' }}>
                                                                    Tenaga Pendidik</option>
                                                                <option value="TK"
                                                                    {{ $data->jabatan === 'TK' ? 'selected' : '' }}>
                                                                    Tenaga Kependidikan</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('jabatan')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_pegawai">Pilih Status Pegawai : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-list"></i>
                                                    </div>
                                                </div>
                                                <select class="form-control" id="status_pegawai" name="status_pegawai">
                                                    <option selected disabled>Pilih Status Pegawai</option>
                                                    @foreach ($editData as $item)
                                                        <option value="TP"
                                                            {{ $data->status_pegawai === '0' ? 'selected' : '' }}>
                                                            Tidak Aktif</option>
                                                        <option value="TK"
                                                            {{ $data->status_pegawai === '1' ? 'selected' : '' }}>
                                                            Aktif</option>
                                                    @endforeach
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
                                    <label for="foto">Ubah Foto : </label>
                                    <small class="d-block">Catatan : Masukkan Foto dengan Format(png, jpg, jpeg), maksimal
                                        1
                                        mb</small>
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
