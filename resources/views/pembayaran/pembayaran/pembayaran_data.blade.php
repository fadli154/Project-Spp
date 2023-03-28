@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-9 col-sm-8">
                        <h4 class="text-dark">Manajemen Pembayaran</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-3 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline">List Pembayaran</div>
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
                            <h4 class="text-primary">List Pembayaran</h4>
                        </div>
                        <div class="col-lg-1 col-sm d-flex justify-content-end">
                            {{-- Button Tambah Data --}}
                            <a href="/pembayaran/create" class="text-white">
                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                    title="Tambah Data" data-original-title="Tambah Data">
                                    <i class="fa fa-plus-circle btn-tambah-data"></i>
                                </button>
                            </a>
                            {{-- Akhir Button Tambah Data --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- FORM PENCARIAN -->
                        <div class="">
                            <form class="" action="/pembayaran" method="get">
                                <div class="input-group input-group mb-3 float-right" style="width: 350px;">
                                    <input type="search" name="katakunci" class="form-control float-right"
                                        placeholder="Masukkan Kata Kunci" value="{{ Request::get('katakunci') }}"
                                        aria-label="Search">
                                    <div class="input-group-append mr-1">
                                        <button type="submit" title="Cari" class="btn btn-light"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                    <div class="input-group-append ">
                                        <a href="" title="Refresh" class="btn btn-light"><i
                                                class="fas fa-circle-notch"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- Akhir Form Pencarian --}}
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
                                                    <div class="badge badge-success "><i class="bi bi-hand-thumbs-up-fill">
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
                                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" title="Tombol Aksi">
                                                        <i class="bi bi-three-dots-vertical btn-tambah-data"></i>
                                                    </button>
                                                    <div class="dropdown-menu ">
                                                        <a class="dropdown-item has-icon text-info"
                                                            href="/pembayaran/{{ $data->id }}"><i
                                                                class="far bi-eye"></i>
                                                            Detail</a>
                                                        <a class="dropdown-item has-icon text-warning"
                                                            href="/pembayaran/{{ $data->id }}/edit"><i
                                                                class="far bi-pencil-square"></i>
                                                            Edit</a>
                                                        <form action="/pembayaran/{{ $data->id }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="confirm dropdown-item has-icon text-danger">
                                                                <input type="hidden" name="oldImage"
                                                                    value="{{ $data->foto }}"><i
                                                                    class="far bi-trash-fill mt-2"></i><small>Hapus</small></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- Tombol Action --}}
                                            </td>
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
