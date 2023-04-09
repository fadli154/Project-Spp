@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-9 col-sm-8">
                        <h4 class="text-dark judul-halaman">Manajemen Pembayaran</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-3 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline">List Tagihan</div>
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
                            <h4 class="text-primary">List Tagihan</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NISN | Nama</th>
                                        <th>Tanggal Tagihan</th>
                                        <th>Total Tagihan</th>
                                        <th>Status</th>
                                        <th>Dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($dataList->count() > 0)
                                        @foreach ($dataList as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="capitalize"><a class="text-dark"
                                                        href="/siswa/{{ $data->nisn }}" title="klik Untuk Detailnya">
                                                        {{ $data->nisn }} | {{ $data->siswa->nama }}</a></td>
                                                <td>{{ $data->tanggal_tagihan->translatedFormat('d-F-Y') }}</td>
                                                <td class="capitalize">
                                                    {{ currency_IDR($data->tagihanDetails->sum('nominal_biaya')) }}</td>
                                                @if ($data->status == 'lunas')
                                                    <td class="text-center">
                                                        <div class="badge badge-success "><i class="bi bi-patch-check-fill">
                                                                Lunas</i>
                                                    </td>
                                                @elseif ($data->status == 'angsur')
                                                    <td class="text-center">
                                                        <div class="badge badge-warning "><i
                                                                class="bi bi-patch-exclamation-fill"> Angsur</i>
                                                        </div>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <div class="badge badge-primary "><i class="bi bi-patch-minus-fill">
                                                                Baru</i>
                                                        </div>
                                                    </td>
                                                @endif
                                                <td class="capitalize">
                                                    @if ($data->user_id == $data->user->id)
                                                        {{ $data->user->name }} | {{ $data->user->level }}
                                                    @endif
                                                <td>
                                                    {{-- Tombol Action --}}
                                                    <div class="dropdown d-inline">
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                id="dropdownMenuButton2" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                title="Tombol Aksi">
                                                                <i class="bi bi-three-dots-vertical btn-tambah-data"></i>
                                                            </button>
                                                            <div class="dropdown-menu ">
                                                                <a class="dropdown-item has-icon text-info"
                                                                    href="/siswa/{{ $data->nisn }}"><i
                                                                        class="far bi-eye"></i>
                                                                    Detail</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Tombol Action --}}
                                                </td>
                                        @endforeach
                                    @else
                                        <td colspan="7" class="text-center bg-secondary">Belum Memiliki Tagihan</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
