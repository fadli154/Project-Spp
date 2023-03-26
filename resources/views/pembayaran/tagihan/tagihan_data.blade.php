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
                        <div class="col-lg-1 col-sm d-flex justify-content-end">
                            {{-- Button Tambah Data --}}
                            <a href="/tagihan/create" class="text-white">
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
                            <form class="" action="/tagihan" method="get">
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
                                    @foreach ($dataList as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="capitalize"><a class="text-dark" href="/siswa/{{ $data->nisn }}"
                                                    title="klik Untuk Detailnya">
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
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" title="Tombol Aksi">
                                                        <i class="bi bi-three-dots-vertical btn-tambah-data"></i>
                                                    </button>
                                                    <div class="dropdown-menu ">
                                                        <a class="dropdown-item has-icon text-info"
                                                            href="/tagihan/{{ $data->nisn }}">
                                                            <i class="far bi-eye"></i>
                                                            Detail</a>
                                                        <a class="dropdown-item has-icon text-warning"
                                                            href="/tagihan/{{ $data->id }}/edit"><i
                                                                class="far bi-pencil-square"></i>
                                                            Edit</a>
                                                        <form action="/tagihan/{{ $data->id }}" method="post">
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
