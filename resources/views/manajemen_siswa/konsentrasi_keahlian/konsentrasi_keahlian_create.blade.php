@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-7 col-sm-8">
                        <h4 class="text-dark capitalize">Manajemen Siswa</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-5 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/konsentrasi-keahlian">Konsentrasi
                                Keahlian</a></div>
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
                                <a href="/konsentrasi-keahlian">
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                            </div>
                            <div class="col-">
                                <h4 class="text-primary capitalize">Tambah Data Konsentrasi Keahlian</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form action="/konsentrasi-keahlian" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col">
                                <div class="form-group">
                                    <label class="capitalize" for="id_kk">Masukkan ID Konsentrasi Keahlian : </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="bi bi-key-fill"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control @error('id_kk') is-invalid @enderror"
                                            placeholder="Contoh : KK0666" value="{{ old('id_kk') }}" id="id_kk"
                                            name="id_kk">
                                    </div>
                                    <span class="text-danger">
                                        @error('id_kk')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="capitalize" for="konsentrasi_keahlian">Masukkan Konsentrasi Keahlian :
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="form-control @error('konsentrasi_keahlian') is-invalid @enderror"
                                            placeholder="Contoh : Rekayasa Perangkat Lunak"
                                            value="{{ old('konsentrasi_keahlian') }}" id="konsentrasi_keahlian"
                                            name="konsentrasi_keahlian">
                                    </div>
                                    <span class="text-danger">
                                        @error('konsentrasi_keahlian')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="capitalize" for="tahun_program">Pilih Tahun Program : </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <select class="form-control @error('tahun_program') is-invalid @enderror"
                                            id="tahun_program" name="tahun_program">
                                            <option selected disabled>Pilih Tahun Program</option>
                                            <option value="3" {{ old('tahun_program') == '3' ? 'selected' : '' }}>
                                                3 Tahun</option>
                                            <option value="4" {{ old('tahun_program') == '4' ? 'selected' : '' }}>
                                                4 Tahun</option>
                                        </select>
                                    </div>
                                    <span class="text-danger">
                                        @error('tahun_program')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <div class="mr-2">
                            <a href="/konsentrasi-keahlian" class="btn btn-warning pe-2 mb-1"><i
                                    class="bi bi-arrow-90deg-left fs-6 mr-1"></i> <span class="bi-text">Kembali</span>
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
