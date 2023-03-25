@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-6 col-sm-8">
                        <h4 class="text-dark capitalize">Manajemen Siswa</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-6 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/konsentrasi-keahlian">Konsentrasi
                                Keahlian</a></div>
                        <div class="breadcrumb-item d-inline capitalize">Detail Konsentrasi Keahlian</div>
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
                                    <div class="col-1">
                                        <a href="/konsentrasi-keahlian" title="Kembali">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h4 class="text-primary capitalize">Detail Konsentrasi Keahlian</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <a href="/konsentrasi-keahlian/{{ $data->id_kk }}/edit" class="text-white">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                        data-placement="top" title="Edit Data Konsentrasi Keahlian"
                                        data-original-title="Edit Data Konsentrasi Keahlian">
                                        <i class="bi bi-pencil btn-tambah-data"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div action="/konsentrasi-keahlian" method="post" enctype="multipart/form-data">
                                @csrf
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
                                                    value="{{ $data->id_kk }}" id="id_kk" name="id_kk" readonly>
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
                                                    value="{{ $data->konsentrasi_keahlian }}" id="konsentrasi_keahlian"
                                                    name="konsentrasi_keahlian" readonly>
                                            </div>
                                            @error('konsentrasi_keahlian')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="tahun_program">Tahun Program :
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('tahun_program') is-invalid @enderror"
                                                    value="{{ $data->tahun_program }} Tahun" id="tahun_program"
                                                    name="tahun_program" readonly>
                                            </div>
                                            @error('tahun_program')
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
