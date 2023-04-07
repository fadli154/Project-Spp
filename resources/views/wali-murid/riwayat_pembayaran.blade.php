@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-8 col-sm-8">
                        <h4 class="text-dark judul-halaman">Manajemen Pembayaran</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-4 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline">Riwayat Pembayaran</div>
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
                            <h4 class="text-primary">Riwayat Pembayaran</h4>
                        </div>
                    </div>

                    <div class="card-body">
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataList as $data)
                                        @foreach ($tagihanList as $item)
                                            @if ($item->id == $data->tagihan_id)
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
                                                    {{-- Tombol Action --}}
                                                    <td>
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                id="dropdownMenuButton2" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                title="Tombol Aksi">
                                                                <i class="bi bi-three-dots-vertical btn-tambah-data"></i>
                                                            </button>
                                                            <div class="dropdown-menu ">
                                                                <a class="dropdown-item has-icon text-info"
                                                                    href="/pembayaran/{{ $data->id }}"><i
                                                                        class="far bi-eye"></i>
                                                                    Detail</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- Tombol Action --}}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
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
    </section>
@endsection
