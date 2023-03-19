@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-9 col-sm-8">
                        <h4 class="text-dark">Manajemen Siswa</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-3 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active">Konsentrasi Keahlian</div>
                    </div>
                    {{-- Akhir Breadcrumb --}}
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <div class="card">
            <div class="card-header">
                <div class="col-lg-11 col-sm">
                    <h5 class="text-info">Filter</h5>
                </div>
                <div class="col-lg-1 col-sm d-flex justify-content-end">
                    {{-- Button Triger Filter --}}
                    <button class="btn btn-info collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                        title="Tombol Filter">
                        <i class="bi bi-funnel-fill btn-tambah-data"></i>
                    </button>
                    {{-- Akhir Button Triger Filter --}}
                </div>
            </div>
            <div class="collapse" id="collapseExample" style="">
                <div class="p-4">
                    <form class="" action="/konsentrasi-keahlian" method="get">
                        <div class="row">
                            <div class="col form-group">
                                <label class="capitalize" for="tahun_program">Filter Tahun Program : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" id="tahun_program" name="tahun_program">
                                        <option selected disabled>Semua</option>
                                        <option value="3">3 Tahun</option>
                                        <option value="4">4 Tahun</option>
                                    </select>
                                </div>
                                @error('tahun_program')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success mr-2 mb-1 " title="Filter">
                                <i class="bi bi-funnel mr-1 "></i><span class="bi-text mr-2">Filter Data</span></button>
                            <button type="reset" class="btn btn-secondary mb-1" title="Reset">
                                <i class="bi bi-arrow-clockwise mr-1"></i><span class="bi-text mr-2">Reset</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Filter --}}

        <div class="section-body">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-11 col-sm">
                            <h4 class="text-primary capitalize">List Konsentrasi Keahlian</h4>
                        </div>
                        <div class="col-lg-1 col-sm d-flex justify-content-end">
                            {{-- Button Tambah Data --}}
                            <a href="/konsentrasi-keahlian/create" class="text-white">
                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                    title="Tambah Data" data-original-title="Tambah Data">
                                    <i class="bi bi-patch-plus btn-tambah-data"></i>
                                </button>
                            </a>
                            {{-- Akhir Button Tambah Data --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- FORM PENCARIAN -->
                        <div class="Search-form">
                            <form class="" action="/konsentrasi-keahlian" method="get">
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
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>ID Konsentrasi Keahlian</th>
                                        <th>Konsentrasi Keahlian</th>
                                        <th>Tahun Program</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($dataList as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="capitalize"><a class="text-dark"
                                                    href="/konsentrasi-keahlian/{{ $data->id_kk }}"
                                                    title="klik Untuk Detailnya">
                                                    {{ $data->id_kk }}</a></td>
                                            <td>{{ $data->konsentrasi_keahlian }}</td>
                                            <td class="capitalize">{{ $data->tahun_program }}</td>
                                            <td>
                                                {{-- Tombol Action --}}
                                                <div class="dropdown d-inline">
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false" title="Tombol Aksi">
                                                        <i class="bi bi-three-dots-vertical btn-tambah-data"></i>
                                                    </button>
                                                    <div class="dropdown-menu ">
                                                        <a class="dropdown-item has-icon text-info"
                                                            href="/konsentrasi-keahlian/{{ $data->id_kk }}"><i
                                                                class="far bi-eye"></i>
                                                            Detail</a>
                                                        <a class="dropdown-item has-icon text-warning"
                                                            href="/konsentrasi-keahlian/{{ $data->id_kk }}/edit"><i
                                                                class="far bi-pencil-square"></i>
                                                            Edit</a>
                                                        <form action="/konsentrasi-keahlian/{{ $data->id_kk }}"
                                                            method="post">
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
