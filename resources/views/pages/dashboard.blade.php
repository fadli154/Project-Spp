@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="shadow-md">
            <div class="card card-body">
                <div class="row d-flex">
                    <div class="col-md-10 col-sm-8">
                        @if (auth()->user()->level == 'wali')
                            <h4 class="text-dark capitalize judul-halaman">Dashboard Wali Murid</h4>
                        @else
                            <h4 class="text-dark capitalize judul-halaman">Dashboard {{ auth()->user()->level }}</h4>
                        @endif
                    </div>
                    <div class="col-md-2 col-sm-4  text-center items-center align-content-center mt-2 ">
                        <div class="breadcrumb-item d-inline"><a href="/dashboard">Dashboard</a></div>
                        {{-- <div class="breadcrumb-item d-inline"><a href="#">Layout</a></div> --}}
                    </div>
                </div>
            </div>
            {{-- Greeting --}}
            <div class="card card-body text-center mb-3">
                @if (auth()->user()->level == 'wali')
                    <strong>Hallo {{ $greeting }} , Wali Murid</strong>
                @else
                    <strong class="capitalize">Hallo {{ $greeting }} , {{ auth()->user()->level }}</strong>
                @endif
            </div>
            {{-- Akhir greeting --}}

            @can('wali')
                {{-- Card jumlah --}}
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Anak</h4>
                                </div>
                                <div class="card-body">
                                    {{ count($dataAnak) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Tagihan</h4>
                                </div>
                                <div class="card-body">
                                    @if ($totalTagihan != null)
                                        {{ currency_IDR($totalTagihan) }}
                                    @else
                                        Rp. 0
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Pembayaran</h4>
                                </div>
                                <div class="card-body">
                                    @if ($totalPembayaran != null)
                                        {{ currency_IDR($totalPembayaran) }}
                                    @else
                                        Rp. 0
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Akhir card Jumlah --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card ">
                            <div class="card-header">
                                <h4 class="text-primary">Tagihan Anak</h4>
                                <div class="card-header-action dropdown">
                                    <a href="/tagihan-wali" class="btn btn-info " aria-expanded="false">Selengkapnya....</a>
                                </div>
                            </div>
                            <div class="card-body" id="top-5-scroll" style="height: 315px; overflow: hidden; outline: none;"
                                tabindex="2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <thead>
                                            <tr>
                                                <th>NISN | Nama</th>
                                                <th>Kelas</th>
                                                <th>Tanggal Tagihan</th>
                                                <th>Total Tagihan</th>
                                                <th>Status</th>
                                                <th>Dibuat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($tagihanList != null)
                                                @foreach ($tagihanList as $data)
                                                    @foreach ($dataAnak as $item)
                                                        @if ($data->nisn == $item->nisn)
                                                            <tr>
                                                                <td class="capitalize"><a class="text-dark"
                                                                        href="/siswa/{{ $data->nisn }}"
                                                                        title="klik Untuk Detailnya">
                                                                        {{ $data->nisn }} | {{ $data->siswa->nama }}</a></td>
                                                                @foreach ($kelasList as $itemKelas)
                                                                    @if ($data->kelas_id == $itemKelas->kelas_id)
                                                                        <td>{{ $itemKelas->kelas }}</td>
                                                                    @endif
                                                                @endforeach
                                                                <td>{{ $data->tanggal_tagihan->translatedFormat('d-F-Y') }}
                                                                </td>
                                                                <td class="capitalize">
                                                                    {{ currency_IDR($data->tagihanDetails->sum('nominal_biaya')) }}
                                                                </td>
                                                                @if ($data->status == 'lunas')
                                                                    <td class="text-center">
                                                                        <div class="badge badge-success "><i
                                                                                class="bi bi-patch-check-fill">
                                                                                Lunas</i>
                                                                    </td>
                                                                @elseif ($data->status == 'angsur')
                                                                    <td class="text-center">
                                                                        <div class="badge badge-warning "><i
                                                                                class="bi bi-patch-exclamation-fill">
                                                                                Angsur</i>
                                                                        </div>
                                                                    </td>
                                                                @else
                                                                    <td class="text-center">
                                                                        <div class="badge badge-primary "><i
                                                                                class="bi bi-patch-minus-fill">
                                                                                Baru</i>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                                <td class="capitalize">
                                                                    @if ($data->user_id == $data->user->id)
                                                                        {{ $data->user->name }} | {{ $data->user->level }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @else
                                                <td colspan="7" class="text-center bg-secondary">Belum ada
                                                    Tagihan
                                                </td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('entri-pembayaran')
                {{-- Card jumlah --}}
                <div class="row">
                    @can('administrator')
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Admin</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $totalAdmin }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Pegawai</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $totalWaliKelas }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Siswa/i</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalSiswa }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Wali Murid</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalWaliMurid }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @can('petugas')
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Data Tagihan</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ count($tagihanData) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Data Pembayaran</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ count($dataList) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
                {{-- Akhir card Jumlah --}}
                {{-- Transaksi Pembayaran --}}
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card ">
                            <div class="card-header">
                                <h4 class="text-primary">Transaksi Pembayaran</h4>
                                <div class="card-header-action dropdown">
                                    <a href="/pembayaran" class="btn btn-info " aria-expanded="false">Selengkapnya....</a>
                                </div>
                            </div>
                            <div class="card-body" id="top-5-scroll" style="height: 315px; overflow: hidden; outline: none;"
                                tabindex="2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-md">
                                        <thead>
                                            <tr>
                                                <th>Nama Siswa & NISN</th>
                                                <th>Kelas Siswa</th>
                                                <th>Jumlah Dibayar</th>
                                                <th>Tanggal Dibayar</th>
                                                <th>Status Konfirmasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($dataList->count() > 0)
                                                @foreach ($dataList as $data)
                                                    <tr>
                                                        @foreach ($tagihanList as $item)
                                                            @if ($data->tagihan->nisn == $item->siswa->nisn)
                                                                <td class="capitalize"><a class="text-dark"
                                                                        href="/siswa/{{ $data->tagihan->nisn }}"
                                                                        title="klik Untuk Detailnya">{{ $item->siswa->nama }}
                                                                        |
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
                                                                    </i>
                                                                </div>
                                                            </td>
                                                        @else
                                                            <td class="text-center">
                                                                <div class="badge badge-danger "><i
                                                                        class="bi bi-hand-thumbs-down-fill"></i>
                                                                </div>
                                                            </td>
                                                        @endif
                                                        </td>
                                                @endforeach
                                            @else
                                                <td colspan="7" class="text-center bg-secondary">Belum ada Yang Melakukan
                                                    Pembayaran
                                                </td>
                                            @endif
                                        </tbody>
                                    </table>
                                    {{-- panigation --}}
                                    {{ $dataList->links() }}
                                    {{-- Akhir Pagination --}}
                                </div>
                            </div>
                            <div class="card-footer pt-5 d-flex justify-content-center">
                                <div class="row">
                                    <div class="budget-price justify-content-center col-sm-6 mb-3">
                                        <div class="badge badge-success "><i class="bi bi-hand-thumbs-up-fill mr-1">
                                                Sudah Dikonfirmasi</i>
                                        </div>
                                    </div>
                                    <div class="budget-price justify-content-center col-sm-6 mb-3">
                                        <div class="badge badge-danger "><i class="bi bi-hand-thumbs-down-fill mr-1">Belum
                                                Dikonfirmasi</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card gradient-bottom">
                            <div class="card-header">
                                <h4 class="text-primary"><i class="fa fa-venus-mars mr-2"></i> Jenis Kelamin Siswa/i</h4>
                            </div>
                            <div class="card-body" id="top-5-scroll" style="height: 315px; overflow: hidden; outline: none;"
                                tabindex="2">
                                <ul class="list-unstyled list-unstyled-border">
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="card card-statistic-1">
                                                <div class="card-icon bg-success">
                                                    <i class="fas fa-female"></i>
                                                </div>
                                                <div class="card-wrap">
                                                    <div class="card-header">
                                                        <h4>Perempuan</h4>
                                                    </div>
                                                    <div class="progress" role="progressbar" aria-label="Success example"
                                                        aria-valuenow="{{ $totalPerempuan }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <div class="progress-bar bg-success"
                                                            style="width: {{ $totalPerempuan }}% "> {{ $totalPerempuan }}%
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        {{ $totalPerempuan }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="card card-statistic-1">
                                                <div class="card-icon bg-warning">
                                                    <i class="fas fa-male"></i>
                                                </div>
                                                <div class="card-wrap">
                                                    <div class="card-header">
                                                        <h4>Laki - laki</h4>
                                                    </div>
                                                    <div class="progress" role="progressbar" aria-label="Success example"
                                                        aria-valuenow="{{ $totalLaki }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <div class="progress-bar bg-success"
                                                            style="width: {{ $totalLaki }}%"> {{ $totalLaki }}%
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        {{ $totalLaki }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- Akhir Transaksi Pembayaran --}}

                    <div class="col-lg-12">
                        <div class="card ">
                            <div class="card-header">
                                <h4 class="text-primary">Tagihan Siswa</h4>
                                <div class="card-header-action dropdown">
                                    <a href="/tagihan" class="btn btn-info " aria-expanded="false">Selengkapnya....</a>
                                </div>
                            </div>
                            <div class="card-body" id="top-5-scroll" style="height: 315px; overflow: hidden; outline: none;"
                                tabindex="2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <thead>
                                            <tr>
                                                <th>NISN | Nama</th>
                                                <th>Kelas</th>
                                                <th>Tanggal Tagihan</th>
                                                <th>Total Tagihan</th>
                                                <th>Status</th>
                                                <th>Dibuat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($tagihanData->count() > 0)
                                                @foreach ($tagihanData as $data)
                                                    <tr>
                                                        <td class="capitalize"><a class="text-dark"
                                                                href="/siswa/{{ $data->nisn }}"
                                                                title="klik Untuk Detailnya">
                                                                {{ $data->nisn }} | {{ $data->siswa->nama }}</a></td>
                                                        @foreach ($kelasList as $itemKelas)
                                                            @if ($data->kelas_id == $itemKelas->kelas_id)
                                                                <td>{{ $itemKelas->kelas }}</td>
                                                            @endif
                                                        @endforeach
                                                        <td>{{ $data->tanggal_tagihan->translatedFormat('d-F-Y') }}</td>
                                                        <td class="capitalize">
                                                            {{ currency_IDR($data->tagihanDetails->sum('nominal_biaya')) }}
                                                        </td>
                                                        @if ($data->status == 'lunas')
                                                            <td class="text-center">
                                                                <div class="badge badge-success "><i
                                                                        class="bi bi-patch-check-fill">
                                                                        Lunas</i>
                                                            </td>
                                                        @elseif ($data->status == 'angsur')
                                                            <td class="text-center">
                                                                <div class="badge badge-warning "><i
                                                                        class="bi bi-patch-exclamation-fill">
                                                                        Angsur</i>
                                                                </div>
                                                            </td>
                                                        @else
                                                            <td class="text-center">
                                                                <div class="badge badge-primary "><i
                                                                        class="bi bi-patch-minus-fill">
                                                                        Baru</i>
                                                                </div>
                                                            </td>
                                                        @endif
                                                        <td class="capitalize">
                                                            @if ($data->user_id == $data->user->id)
                                                                {{ $data->user->name }} | {{ $data->user->level }}
                                                            @endif
                                                @endforeach
                                            @else
                                                <td colspan="7" class="text-center bg-secondary">Belum ada
                                                    Tagihan
                                                </td>
                                            @endif
                                        </tbody>
                                    </table>
                                    {{-- panigation --}}
                                    {{ $dataList->links() }}
                                    {{-- Akhir Pagination --}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endcan
    </section>
@endsection
