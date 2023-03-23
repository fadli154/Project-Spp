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
                        <div class="breadcrumb-item d-inline active"><a href="/siswa">Siswa</a></div>
                        <div class="breadcrumb-item d-inline">Profile Siswa</div>
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
                                    <div class="col-1 ">
                                        <a href="/siswa" title="Kembali">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h4 class="text-primary">Profile Siswa</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <a href="/siswa/{{ $data->nisn }}/edit" class="text-white">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                        data-placement="top" title="Edit Data Siswa" data-original-title="Edit Data Siswa">
                                        <i class="bi bi-pencil btn-tambah-data"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="/siswa" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        @if ($data->foto)
                                            <div class="justify-content-center mt-3 ml-4">
                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                    alt="foto {{ $data->nama }}" class="foto-user">
                                            </div>
                                        @else
                                            <div class="justify-content-center mt-3 ml-4">
                                                <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                    alt="foto {{ $data->nama }}" class="foto-user">
                                            </div>
                                        @endif

                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="nama">Nama Siswa : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-person-badge-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('nama') is-invalid @enderror"
                                                            value="{{ $data->nama }}" id="nama" name="nama"
                                                            readonly>
                                                    </div>
                                                    @error('nama')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="nisn">NISN Siswa : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-envelope-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('nisn') is-invalid @enderror"
                                                            value="{{ $data->nisn }}" id="nisn" name="nisn"
                                                            readonly>
                                                    </div>
                                                    @error('nisn')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nik">NIK Siswa : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-telephone-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('nik') is-invalid @enderror"
                                                            value="{{ $data->nik }}" id="nik" name="nik"
                                                            readonly>
                                                    </div>
                                                    @error('nik')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
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
