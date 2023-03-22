@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-6 col-sm-8">
                        <h4 class="text-dark">Manajemen Pembayaran</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-6 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/biaya">List Biaya</a></div>
                        <div class="breadcrumb-item d-inline capitalize">Edit Data Biaya</div>
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
                                        <a href="/biaya">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col-">
                                        <h4 class="text-primary capitalize">Edit Data Biaya</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="/biaya/{{ $data->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="capitalize" for="nama_biaya">Nama Biaya :
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa-solid fa-money-check-dollar"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('nama_biaya') is-invalid @enderror"
                                                    placeholder="Contoh : SPP 2022" value="{{ $data->nama_biaya }}"
                                                    id="nama_biaya" name="nama_biaya">
                                            </div>
                                            @error('nama_biaya')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="nominal">Nominal/Jumlah :
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-cash"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('nominal') is-invalid @enderror"
                                                    placeholder="Contoh : Rp. 100.000"
                                                    value="{{ currency_IDR($data->nominal) }}" id="nominal"
                                                    name="nominal">
                                            </div>
                                            @error('nominal')
                                                {{ $message }}
                                            @enderror
                                        </div>

                                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <div class="mr-2">
                                        <a href="/biaya" class="btn btn-warning pe-2 mb-1"><i
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
