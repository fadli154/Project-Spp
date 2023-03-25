@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-7 col-sm-8">
                        <h4 class="text-dark capitalize">Manajemen Pembayaran</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-5 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/tagihan">List Tagihan</a></div>
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
                                <a href="/tagihan">
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                            </div>
                            <div class="col-">
                                <h4 class="text-primary capitalize">Tambah Data Tagihan</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form action="/tagihan" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="capitalize" for="biaya_id">Tagihan Untuk Biaya : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-credit-card"></i>
                                                </div>
                                            </div>
                                            <select class="form-control select2 @error('biaya_id') is-invalid @enderror"
                                                id="biaya_id select2" name="biaya_id[]" multiple="multiple"
                                                placeholder="halo">
                                                @foreach ($biayaData as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama_biaya }}
                                                        {{ $data->angkatan }} | {{ currency_IDR($data->nominal) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('biaya_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="capitalize" for="kelas_id">Tagihan Untuk Kelas : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bi bi-cast"></i>
                                                </div>
                                            </div>
                                            <select class="form-control select2 @error('kelas_id') is-invalid @enderror"
                                                id="kelas_id select2" name="kelas_id">
                                                <option disabled selected>Pilih Kelas</option>
                                                @foreach ($kelasData as $data)
                                                    <option value="{{ $data->kelas_id }}">{{ $data->kelas }}
                                                        {{ $data->angkatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('kelas_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="capitalize" for="tanggal_tagihan">Masukkan Tanggal tagihan :
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="date"
                                                class="form-control @error('tanggal_tagihan') is-invalid @enderror"
                                                value="{{ old('tanggal_tagihan') ?? date('Y-m-d') }}" id="tanggal_tagihan"
                                                name="tanggal_tagihan">
                                        </div>
                                        @error('tanggal_tagihan')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="capitalize" for="tanggal_jatuh_tempo">Masukkan Tanggal Jatuh Tempo :
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="date"
                                                class="form-control @error('tanggal_jatuh_tempo') is-invalid @enderror"
                                                value="{{ old('tanggal_jatuh_tempo') ?? date('Y-m-d') }}"
                                                id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo">
                                        </div>
                                        @error('tanggal_jatuh_tempo')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan : </label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan tentang Tagihan"></textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <div class="mr-2">
                            <a href="/tagihan" class="btn btn-warning pe-2 mb-1"><i
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
