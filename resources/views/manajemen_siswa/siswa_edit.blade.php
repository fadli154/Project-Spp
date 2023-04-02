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
                        <div class="breadcrumb-item d-inline active"><a href="/siswa">List Siswa</a></div>
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
                                        <a href="/siswa">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col-">
                                        <h4 class="text-primary">Edit Data List Siswa</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="/siswa/{{ $data->nisn }}" method="post" enctype="multipart/form-data">
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
                                                    <label for="nama">Nama Siswa : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-person-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('nama') is-invalid @enderror"
                                                            placeholder="Masukkan Nama List Siswa"
                                                            value="{{ $data->nama }}" id="nama" name="nama">
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('nama')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kelas_id">Kelas Siswa : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-cast"></i>
                                                            </div>
                                                        </div>
                                                        <select class="form-control select2 " id="kelas_id"
                                                            name="kelas_id">
                                                            <option selected disabled>Pilih Kelas</option>
                                                            @foreach ($kelasList as $item)
                                                                <option value="{{ $item->kelas_id }}"
                                                                    {{ $data->kelas_id === $item->kelas_id ? 'selected' : '' }}>
                                                                    {{ $item->kelas }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('kelas_id')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Pilih Status Siswa : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text  bg-secondary">
                                                                <i class="bi bi-bookmark-fill"></i>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="status" name="status">
                                                            <option selected disabled>Pilih Status</option>
                                                            @foreach ($editData as $item)
                                                                <option value="0"
                                                                    {{ $data->status === '0' ? 'selected' : '' }}>
                                                                    Tidak Aktif</option>
                                                                <option value="1"
                                                                    {{ $data->status === '1' ? 'selected' : '' }}>
                                                                    Aktif</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('status')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="nisn">NISN Siswa : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-key-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('nisn') is-invalid @enderror"
                                                            placeholder="Masukkan NISN" value="{{ $data->nisn }}"
                                                            id="nisn" name="nisn">
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('nisn')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nik">NIK Siswa : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-key-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('nik') is-invalid @enderror"
                                                            placeholder="Masukkan NIK" value="{{ $data->nik }}"
                                                            id="nik" name="nik">
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('nik')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir Siswa : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-key-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                    placeholder="Masukkan Tempat Lahir" value="{{ $data->tempat_lahir }}"
                                                    id="tempat_lahir" name="tempat_lahir">
                                            </div>
                                            <span class="text-danger">
                                                @error('tempat_lahir')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="foto">Ubah Foto : </label>
                                            <small class="d-block">Catatan : Masukkan Foto dengan Format(png, jpg, jpeg),
                                                maksimal
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
                                                    <label class="custom-file-label" for="foto">Pilih Foto
                                                        Baru</label>
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
                                    </div>
                                </div>
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
