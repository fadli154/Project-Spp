@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-6 col-sm-8">
                        <h4 class="text-dark">Manajemen Users</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-6 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/konsentrasi-keahlian">Konsentrasi
                                Keahlian</a></div>
                        <div class="breadcrumb-item d-inline capitalize">Edit Data Konsentrasi Keahlian</div>
                    </div>
                    {{-- Akhir Breadcrumb --}}
                </div>
            </div>
        </div>

        @foreach ($dataList as $data)
            <div class="section-body">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-1 mr-1">
                                        <a href="/konsentrasi-keahlian">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col-">
                                        <h4 class="text-primary capitalize">Edit Data Konsentrasi Keahlian</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="/konsentrasi-keahlian/{{ $data->id_kk }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="capitalize" for="id_kk">ID Konsentrasi Keahlian : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-key-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('id_kk') is-invalid @enderror"
                                                    placeholder="Contoh : KK0666" value="{{ $data->id_kk }}" id="id_kk"
                                                    name="id_kk">
                                            </div>
                                            @error('id_kk')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="konsentrasi_keahlian">Konsentrasi Keahlian :
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('konsentrasi_keahlian') is-invalid @enderror"
                                                    placeholder="Contoh : Rekayasa Perangkat Lunak"
                                                    value="{{ $data->konsentrasi_keahlian }}" id="konsentrasi_keahlian"
                                                    name="konsentrasi_keahlian">
                                            </div>
                                            @error('konsentrasi_keahlian')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="tahun_program">Pilih Tahun Program : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <select class="form-control" id="tahun_program" name="tahun_program">
                                                    <option selected disabled>Pilih Tahun Program</option>
                                                    <option value="3"
                                                        {{ $data->tahun_program === '3' ? 'selected' : '' }}>
                                                        3 Tahun</option>
                                                    <option value="4"
                                                        {{ $data->tahun_program === '4' ? 'selected' : '' }}>
                                                        4 Tahun</option>
                                                </select>
                                            </div>
                                            @error('tahun_program')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <div class="mr-2">
                                        <a href="/konsentrasi-keahlian" class="btn btn-warning pe-2 mb-1"><i
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
