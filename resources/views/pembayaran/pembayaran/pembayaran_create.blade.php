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
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/pembayaran">List Pembayaran</a>
                        </div>
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
                                <a href="/pembayaran">
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                            </div>
                            <div class="col-">
                                <h4 class="text-primary capitalize">Tambah Data Pembayaran</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form action="/pembayaran" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="capitalize" for="nisn">Pilih Siswa : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-user-graduate"></i>
                                        </div>
                                    </div>
                                    <select class="form-control capitalize select2 @error('nisn') is-invalid @enderror"
                                        id="nisn" name="nisn">
                                        <option disabled selected>Pilih Siswa</option>
                                        @foreach ($siswaList as $data)
                                            <option value="{{ $data->nisn }}" class="capitalize"
                                                {{ old('nisn') == $data->nisn ? 'selected' : '' }}>
                                                {{ $data->nama }} | {{ $data->nisn }} | Tagihan :
                                                @if ($data->tagihan == null)
                                                    Rp. 0
                                                @else
                                                    @if ($data->tagihan->sisa_tagihan < 0)
                                                        Rp. 0
                                                    @else
                                                        {{ currency_IDR($data->tagihan->sisa_tagihan) }}
                                                    @endif
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('nisn')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="capitalize" for="jumlah_dibayar">Masukkan
                                    Jumlah/Nominal Yang Dibayar :
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="bi bi-cash"></i>
                                        </div>
                                    </div>
                                    <input type="text" type-currency="IDR"
                                        class="form-control @error('jumlah_dibayar') is-invalid @enderror"
                                        placeholder="Contoh : Rp. 100.000" value="{{ old('jumlah_dibayar') }}"
                                        id="jumlah_dibayar" name="jumlah_dibayar">
                                </div>
                                @error('jumlah_dibayar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="capitalize" for="tanggal_bayar">Masukkan
                                    Tanggal Pembayaran :
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror"
                                        value="{{ old('tanggal_bayar') ?? date('Y-m-d') }}" id="tanggal_bayar"
                                        name="tanggal_bayar">
                                </div>
                                @error('tanggal_bayar')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="capitalize" for="bukti_bayar">Masukkan
                                    Foto/Bukti Pembayaran :
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="bi bi-file-earmark-image"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input @error('bukti_bayar') is-invalid @enderror"
                                            id="foto" name="bukti_bayar" onchange="previewImage()">
                                        <label class="custom-file-label" class="capitalize" for="bukti_bayar">Pilih
                                            Foto</label>
                                    </div>
                                    <input type="file" class="custom-file-input ">
                                    <img class="img-preview img-preview-create img-fluid mt-2 col-sm-2">
                                </div>
                                @error('bukti_bayar')
                                    {{ $message }}
                                @enderror
                            </div>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="col-12 d-flex justify-content-end">
                                <div class="mr-2">
                                    <a href="/pembayaran" class="btn btn-warning pe-2 mb-1"><i
                                            class="bi bi-arrow-90deg-left fs-6 mr-1"></i>
                                        <span class="bi-text">Kembali</span>
                                    </a>
                                </div>
                                <div class="mr-2">
                                    <button type="submit" class="btn btn-primary mb-1 "><i
                                            class="bi bi-clipboard-plus-fill fs-6 mr-1"></i>
                                        <span class="bi-text">Tambah Data</span></button>
                                </div>
                                <div class="">
                                    <button type="reset" class="btn btn-secondary"><i
                                            class="bi bi-arrow-counterclockwise fs-6 mr-1"></i>
                                        <span class="bi-text">Reset</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
