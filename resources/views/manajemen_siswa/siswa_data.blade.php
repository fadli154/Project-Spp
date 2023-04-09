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
                        <div class="breadcrumb-item d-inline active">List Siswa</div>
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
                    <form class="" action="/siswa" method="get">
                        <div class="row">
                            <div class="col form-group">
                                <label class="capitalize" for="jk">Filter Jenis Kelamin : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-venus-mars"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="jk" id="jk">
                                        <option {{ is_null(request()->input('jk')) ? 'selected' : '' }} value="">
                                            Semua </option>
                                        <option {{ request()->input('jk') == 1 ? 'selected' : '' }} value="L">Laki Laki
                                        </option>
                                        <option
                                            {{ !is_null(request()->input('jk')) && request()->input('jk') == 0 ? 'selected' : '' }}
                                            value="P">Perempuan</option>
                                    </select>
                                </div>
                                @error('jk')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="col form-group">
                                <label class="capitalize" for="status">Filter Status : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="bi bi-bookmark-fill"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="status" id="status">
                                        <option {{ is_null(request()->input('status')) ? 'selected' : '' }} value="">
                                            Semua </option>
                                        <option {{ request()->input('status') == 1 ? 'selected' : '' }} value="1">Aktif
                                        </option>
                                        <option
                                            {{ !is_null(request()->input('status')) && request()->input('status') == 0 ? 'selected' : '' }}
                                            value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                                @error('status')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success mr-2 mb-1 " title="Filter">
                                <i class="bi bi-funnel mr-1 "></i><span class="bi-text mr-2">Filter Data</span></button>
                            <a type="reset" href="/siswa" class="btn btn-secondary mb-1" title="Reset">
                                <i class="bi bi-arrow-clockwise mr-1"></i><span class="bi-text mr-2">Reset
                                    Filter</span></a>
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
                            <h4 class="text-primary capitalize">List Siswa</h4>
                        </div>
                        <div class="col-lg-1 col-sm d-flex justify-content-end">
                            @can('administrator')
                                {{-- Button Tambah Data --}}
                                <a href="/siswa/create" class="text-white">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                        title="Tambah Data" data-original-title="Tambah Data">
                                        <i class="fa fa-plus-circle btn-tambah-data"></i>
                                    </button>
                                </a>
                                {{-- Akhir Button Tambah Data --}}

                                {{-- export to excel --}}
                                <a href="/siswa-export" target="_blank" class="btn btn-success btn-icon ml-2" title=""
                                    data-toggle="tooltip" data-placement="top" data-original-title="Export Excel">
                                    <i class="fas fa-file-excel  px-2  "></i>
                                </a>
                                {{-- Akhir export to excel --}}
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- FORM PENCARIAN -->
                            <div class="col-12 Search-form">
                                <form class="" action="/siswa" method="get">
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

                            {{-- Data List --}}
                            @foreach ($dataList as $data)
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header" style="background-color: rgb(214, 200, 226)">
                                            <h4 class="capitalize">{{ $data->nama }} | {{ $data->kelas->kelas }}</h4>
                                            <div class="card-header-action mr-2">
                                                <a title="Lihat Detail"
                                                    data-collapse="#mycard-collapse-{{ $data->nisn }}"
                                                    class="btn btn-icon btn-info" href="#"><i
                                                        class="fas fa-arrow-down"></i></a>
                                            </div>
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton2"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    title="Tombol Aksi">
                                                    <i class="bi bi-three-dots-vertical btn-tambah-data"></i>
                                                </button>
                                                <div class="dropdown-menu ">
                                                    <a class="dropdown-item has-icon text-info"
                                                        href="/siswa/{{ $data->nisn }}"><i class="far bi-eye"></i>
                                                        Detail</a>
                                                    @can('administrator')
                                                        <a class="dropdown-item has-icon text-warning"
                                                            href="/siswa/{{ $data->nisn }}/edit"><i
                                                                class="far bi-pencil-square"></i>
                                                            Edit</a>
                                                        <form action="/siswa/{{ $data->nisn }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="confirm dropdown-item has-icon text-danger">
                                                                <input type="hidden" name="oldImage"
                                                                    value="{{ $data->foto }}"><i
                                                                    class="far bi-trash-fill mt-2"></i><small>Hapus</small></button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="mycard-collapse-{{ $data->nisn }}"
                                            style="background-color :  @if ($data->jk == 'L') rgb(189, 189, 216) @else rgb(197, 176, 197) @endif ;">
                                            <div class="card-body">
                                                <div class="row ">
                                                    {{-- fotoCard --}}
                                                    <div class="col-md-4 mr-4">
                                                        @if ($data->foto)
                                                            <div class="">
                                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                                    alt="foto {{ $data->nama }}"
                                                                    class="foto-siswa mt-1">
                                                            </div>
                                                        @else
                                                            @if ($data->jk == 'L')
                                                                <div class="">
                                                                    <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                                        alt="foto {{ $data->nama }}"
                                                                        class="foto-siswa mt-2 mr-2">
                                                                </div>
                                                            @else
                                                                <div class="">
                                                                    <img src="{{ asset('img/avatar/avatar-5.png') }}"
                                                                        alt="foto {{ $data->nama }}"
                                                                        class="foto-siswa mt-2 mr-2">
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    {{-- Akhird Foto card --}}
                                                    <div class="col-md-6 profile-data">
                                                        <p class="capitalize"><strong> Nama :</strong>
                                                            {{ $data->nama }}</p>
                                                        <p><strong> NISN : </strong>
                                                            <a class="text-dark" href="/siswa/{{ $data->nisn }}"
                                                                title="klik Untuk Detailnya">
                                                                {{ $data->nisn }}
                                                            </a>
                                                        </p>
                                                        <p><strong> NIK : </strong>
                                                            <a class="text-dark" href="/siswa/{{ $data->nisn }}"
                                                                title="klik Untuk Detailnya">
                                                                {{ $data->nik }}
                                                            </a>
                                                        </p>
                                                        @foreach ($kelasList as $item)
                                                            @if ($item->kelas_id == $data->kelas_id)
                                                                <p><strong> Kelas : </strong> {{ $item->kelas->kelas }}
                                                                    {{ $item->angkatan }}
                                                                </p>
                                                            @break

                                                        @elseif ($data->kelas_id == '')
                                                            <p>Kelas : Belum Memiliki Kelas</p>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Akhir Data List --}}

                    {{-- panigation --}}
                    {{ $dataList->links() }}
                    {{-- Akhir Pagination --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
