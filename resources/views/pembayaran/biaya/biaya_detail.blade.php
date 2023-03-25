@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-6 col-sm-8">
                        <h4 class="text-dark capitalize">Manajemen Pembayaran</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-6 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/biaya">List Biaya</a></div>
                        <div class="breadcrumb-item d-inline capitalize">Detail Biaya</div>
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
                                        <a href="/biaya" title="Kembali">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h4 class="text-primary capitalize">Detail Biaya</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <a href="/biaya/{{ $data->id }}/edit" class="text-white">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                        data-placement="top" title="Edit Data Biaya" data-original-title="Edit Data Biaya">
                                        <i class="bi bi-pencil btn-tambah-data"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div action="/biaya" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="capitalize" for="nama_biaya">Nama Biaya :
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-credit-card"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('nama_biaya') is-invalid @enderror"
                                                    value="{{ $data->nama_biaya }}" id="nama_biaya" name="nama_biaya"
                                                    readonly>
                                            </div>
                                            @error('nama_biaya')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="nominal">Nama Biaya :
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-cash"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('nominal') is-invalid @enderror"
                                                    value="{{ currency_IDR($data->nominal) }}" id="nominal" name="nominal"
                                                    readonly>
                                            </div>
                                            @error('nominal')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="capitalize" for="created_at">Dibuat Pada :
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('created_at') is-invalid @enderror"
                                                    value="{{ $data->created_at->format('d-M-Y g:i:s') }}" id="created_at"
                                                    name="created_at" readonly>
                                            </div>
                                            @error('created_at')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="updated_at">Diubah Pada :
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('updated_at') is-invalid @enderror"
                                                    value="{{ $data->updated_at->format('d-M-Y g:i:s') }}" id="updated_at"
                                                    name="updated_at" readonly>
                                            </div>
                                            @error('updated_at')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="capitalize" for="user_id">Dibuat Oleh :
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-user-tie"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('user_id') is-invalid @enderror"
                                                    value="{{ $data->user_id == $data->user->id ? $data->user->name : '' }}"
                                                    id="user_id" name="user_id" readonly>
                                            </div>
                                            @error('user_id')
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
