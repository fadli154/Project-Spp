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
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/kelas">Kelas</a></div>
                        <div class="breadcrumb-item d-inline capitalize">Edit Data</div>
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
                                        <a href="/kelas">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col-">
                                        <h4 class="text-primary capitalize">Edit Data Kelas</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="/kelas/{{ $data->kelas_id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="hidden" name="oldImage" value="{{ $data->foto }}">
                                            @if ($data->foto)
                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                    class="img-kelas img-fluid mt-3 d-block ml-4">
                                            @else
                                                <img src="{{ asset('img/kelas.webp') }}"
                                                    class="img-kelas img-fluid mt-3 d-block ml-4">
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="capitalize" for="kelas_id">ID Kelas : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-key-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('kelas_id') is-invalid @enderror"
                                                            placeholder="Masukkan kelas_id" value="{{ $data->kelas_id }}"
                                                            id="kelas_id" name="kelas_id">
                                                    </div>
                                                    @error('kelas_id')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="capitalize" for="angkatan">Angkatan : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-calendar-event-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('angkatan') is-invalid @enderror"
                                                            placeholder="Masukkan angkatan" value="{{ $data->angkatan }}"
                                                            id="angkatan" name="angkatan">
                                                    </div>
                                                    @error('angkatan')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="capitalize" for="kelas">Kelas : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-cast"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('kelas') is-invalid @enderror"
                                                            placeholder="Masukkan kelas" value="{{ $data->kelas }}"
                                                            id="kelas" name="kelas">
                                                    </div>
                                                    @error('kelas')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="capitalize" for="id_kk">Konsentrasi Keahlian : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text  bg-secondary">
                                                                <i class="fa-solid fa-briefcase"></i>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="id_kk" name="id_kk">
                                                            <option selected disabled>Pilih Wali Kelas</option>
                                                            @foreach ($konsentrasiList as $item)
                                                                <option value="{{ $item->id_kk }}"
                                                                    {{ $data->id_kk === $item->id_kk ? 'selected' : '' }}>
                                                                    {{ $item->konsentrasi_keahlian }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('id_kk')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="nip_wali_kelas">Wali kelas : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text  bg-secondary">
                                                        <i class="fa-solid fa-user-tie"></i>
                                                    </div>
                                                </div>
                                                <select class="form-control" id="nip_wali_kelas" name="nip_wali_kelas">
                                                    <option selected disabled>Pilih Wali Kelas</option>
                                                    @foreach ($waliKelasList as $item)
                                                        <option value="{{ $item->nip_wali_kelas }}"
                                                            {{ $data->nip_wali_kelas === $item->nip_wali_kelas ? 'selected' : '' }}>
                                                            {{ $item->nama_wali_kelas }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('nip_wali_kelas')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="capitalize" for="foto">Ubah Foto : </label>
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
                                            <label class="custom-file-label" class="capitalize" for="foto">Pilih Foto
                                                Baru</label>
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
                                        <a href="/kelas" class="btn btn-warning pe-2 mb-1"><i
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
