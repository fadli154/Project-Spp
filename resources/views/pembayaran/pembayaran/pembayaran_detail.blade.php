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
                        <div class="breadcrumb-item d-inline capitalize">Detail Pembayaran</div>
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
                                        <a href="/pembayaran" title="Kembali">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h4 class="text-primary capitalize">Detail Pembayaran</h4>
                                    </div>

                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <a href="/biaya/{{ $data->id }}/edit" class="text-white">
                                    @if ($data->tagihan->status == 'lunas')
                                        <div class="badge badge-success "><i class="bi bi-patch-check-fill">
                                                Lunas</i>
                                        </div>
                                    @elseif ($data->tagihan->status == 'angsur')
                                        <div class="badge badge-warning "><i class="bi bi-patch-exclamation-fill">
                                                Angsur</i>
                                        </div>
                                    @else
                                        <div class="badge badge-primary "><i class="bi bi-patch-minus-fill">
                                                Baru</i>
                                        </div>
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div action="/pembayaran" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <strong class="d-block text-center">Bukti Bayar</strong>
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-center">
                                        @if ($data->bukti_bayar)
                                            <div class="mt-3">
                                                <img src="{{ asset('storage/' . $data->bukti_bayar) }}" alt="bukti bayar"
                                                    class="img-bukti-pembayaran">
                                            </div>
                                        @else
                                            <div class="mt-3">
                                                <img src="{{ asset('img/bukti-kosong.webp') }}" alt="bukti bayar"
                                                    class="img-bukti-pembayaran">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="capitalize" for="jumlah_dibayar">Jumlah Dibayar : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-credit-card"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('jumlah_dibayar') is-invalid @enderror"
                                                    value="{{ currency_IDR($data->jumlah_dibayar) }}" id="jumlah_dibayar"
                                                    name="jumlah_dibayar" readonly>
                                            </div>
                                            @error('jumlah_dibayar')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="user_id">Dibuat Oleh : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-user-tie"></i>
                                                    </div>
                                                </div>
                                                @foreach ($userList as $item)
                                                    @if ($item->id == $data->user_id)
                                                        <input type="text"
                                                            class="form-control capitalize @error('user_id') is-invalid @enderror"
                                                            value="{{ $item->name }}" id="user_id" name="user_id"
                                                            readonly>
                                                    @endif
                                                @endforeach
                                            </div>
                                            @error('user_id')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="capitalize" for="tanggal_bayar">Tanggal Dibayar : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('tanggal_bayar') is-invalid @enderror"
                                                    value="{{ $data->updated_at }}" id="tanggal_bayar" name="tanggal_bayar"
                                                    readonly>
                                            </div>
                                            @error('tanggal_bayar')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="status_konfirmasi">Status Konfirmasi : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control capitalize @error('status_konfirmasi') is-invalid @enderror"
                                                    value="{{ $data->status_konfirmasi }} Dikonfirmasi"
                                                    id="status_konfirmasi" name="status_konfirmasi" readonly>
                                            </div>
                                            @error('status_konfirmasi')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="capitalize" for="sisa_tagihan">Sisa Tagihan : </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-secondary">
                                                <i class="bi bi-cash"></i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="form-control capitalize @error('sisa_tagihan') is-invalid @enderror"
                                            value="{{ currency_IDR($data->tagihan->sisa_tagihan) }}" id="sisa_tagihan"
                                            name="sisa_tagihan" readonly>
                                    </div>
                                    @error('sisa_tagihan')
                                        {{ $message }}
                                    @enderror
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
