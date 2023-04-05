@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-8 col-sm-8">
                        <h4 class="text-dark">Manajemen Pembayaran</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-4 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/pembayaran">Pembayaran</a></div>
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
                                        <a href="/pembayaran">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col-">
                                        <h4 class="text-primary capitalize">Edit Data pembayaran</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="/pembayaran/{{ $data->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="hidden" name="oldImage" value="{{ $data->bukti_bayar }}">
                                            @if ($data->bukti_bayar)
                                                <img src="{{ asset('storage/' . $data->bukti_bayar) }}"
                                                    class="img-kelas img-preview img-fluid mt-3 d-block ml-4">
                                            @else
                                                <img src="{{ asset('img/bukti-kosong.webp') }}"
                                                    class="img-kelas img-preview img-fluid mt-3 d-block ml-4">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="capitalize" for="jumlah_dibayar">Jumlah Dibayar : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-calendar-event-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('jumlah_dibayar') is-invalid @enderror"
                                                            placeholder="Masukkan jumlah_dibayar"
                                                            value="{{ currency_IDR($data->jumlah_dibayar) }}"
                                                            id="jumlah_dibayar" name="jumlah_dibayar">
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('jumlah_dibayar')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status_konfirmasi">Status Konfirmasi : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text  bg-secondary">
                                                                <i class="bi bi-hand-index-thumb-fill"></i>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="status_konfirmasi"
                                                            name="status_konfirmasi">
                                                            <option selected disabled>Pilih Status Konfirmasi</option>
                                                            @foreach ($editData as $item)
                                                                <option value="belum"
                                                                    {{ $data->status_konfirmasi === 'belum' ? 'selected' : '' }}>
                                                                    Belum Dikonfirmasi</option>
                                                                <option value="sudah"
                                                                    {{ $data->status_konfirmasi === 'sudah' ? 'selected' : '' }}>
                                                                    Sudah Dikonfirmasi</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('status_konfirmasi')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="capitalize" for="tanggal_bayar">Tanggal Dibayar :
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <input type="date"
                                                            class="form-control @error('tanggal_bayar') is-invalid @enderror"
                                                            value="{{ $data->tanggal_bayar->format('Y-m-d') }}"
                                                            id="tanggal_bayar" name="tanggal_bayar">
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('tanggal_bayar')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="capitalize" for="user_id">Dikonfirmasi Oleh :
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-user-tie"></i>
                                                            </div>
                                                        </div>
                                                        @foreach ($userData as $item)
                                                            @if ($item->id == $data->user_id)
                                                                <input type="text"
                                                                    class="form-control @error('user_id') is-invalid @enderror"
                                                                    value="{{ $item->name }}" id="user_id"
                                                                    name="user_id" readonly>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('user_id')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
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
                                                        id="foto" name="bukti_bayar" onchange="previewImage()">
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
                                        <input type="hidden" name="tagihan_id" value="{{ $data->tagihan_id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <div class="mr-2">
                                        <a href="/pembayaran" class="btn btn-warning pe-2 mb-1"><i
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
