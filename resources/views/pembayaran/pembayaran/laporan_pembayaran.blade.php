@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-8 col-sm-8">
                        <h4 class="text-dark judul-halaman">Manajemen Laporan</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-4 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline">Laporan Pembayaran</div>
                    </div>
                    {{-- Akhir Breadcrumb --}}
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-11 col-sm">
                            <h4 class="text-primary">Laporan Pembayaran</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="/laporan-pembayaran" method="get" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="capitalize" for="start_date">Dari Tanggal :
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date') ?? date('Y-m-d') }}" id="start_date" name="start_date">
                                </div>
                                @error('start_date')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="capitalize" for="end_date">Sampai Tanggal :
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date') ?? date('Y-m-d') }}" id="end_date" name="end_date">
                                </div>
                                @error('end_date')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <div class="mr-2">
                                    <button type="submit" class="btn btn-primary mb-1 "><i class="bi bi-eye fs-6 mr-1"></i>
                                        <span class="bi-text">Tampilkan Data</span></button>
                                </div>
                                <div class="">
                                    <button type="reset" class="btn btn-secondary"><i
                                            class="bi bi-arrow-counterclockwise fs-6 mr-1"></i>
                                        <span class="bi-text">Reset</span></button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        @if ($dataList->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-md">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Siswa & NISN</th>
                                            <th>Kelas Siswa</th>
                                            <th>Jumlah Dibayar</th>
                                            <th>Tanggal Dibayar</th>
                                            <th>Status Konfirmasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- export to excel --}}
                                        <div class="mb-2">
                                            <form action="{{ route('pembayaran-export') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="start_date" value="{{ $startDate }}">
                                                <input type="hidden" name="end_date" value="{{ $endDate }}">
                                                <button type="submit" target="_blank" class="btn btn-success btn-icon ml-2"
                                                    title="" data-toggle="tooltip" data-placement="top"
                                                    data-original-title="Cetak Laporan">
                                                    <i class="fas fa-file-excel  px-2  "></i>
                                                </button>
                                            </form>
                                        </div>
                                        {{-- Akhir export to excel --}}
                                        @foreach ($dataList as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                @foreach ($tagihanList as $item)
                                                    @if ($data->tagihan->nisn == $item->siswa->nisn)
                                                        <td class="capitalize"><a class="text-dark"
                                                                href="/siswa/{{ $data->tagihan->nisn }}"
                                                                title="klik Untuk Detailnya">{{ $item->siswa->nama }} |
                                                                {{ $data->tagihan->nisn }}</a></td>
                                                    @endif
                                                @endforeach
                                                @foreach ($kelasList as $itemKelas)
                                                    @if ($data->tagihan->kelas_id == $itemKelas->kelas_id)
                                                        <td>{{ $itemKelas->kelas }}</td>
                                                    @endif
                                                @endforeach
                                                <td>{{ currency_IDR($data->jumlah_dibayar) }}</td>
                                                <td>{{ $data->updated_at->translatedFormat('d-F-Y | g:i:s') }}</td>
                                                @if ($data->status_konfirmasi == 'sudah')
                                                    <td class="text-center">
                                                        <div class="badge badge-success "><i
                                                                class="bi bi-hand-thumbs-up-fill">
                                                                Sudah</i>
                                                        </div>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <div class="badge badge-danger "><i
                                                                class="bi bi-hand-thumbs-down">Belum</i>
                                                        </div>
                                                    </td>
                                                @endif
                                                </td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
