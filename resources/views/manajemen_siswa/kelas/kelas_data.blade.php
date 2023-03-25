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
                        <div class="breadcrumb-item d-inline active">List Kelas</div>
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
                    <form class="" action="/kelas" method="get">
                        <div class="row">
                            <div class="col form-group">
                                <label class="capitalize" for="angkatan">Filter Angkatan : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="bi bi-calendar-event-fill"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="angkatan" id="angkatan">
                                        <option value="" selected>Semua Angkatan</option>
                                        @foreach ($filter as $data)
                                            <option value="{{ $data->angkatan }}">
                                                {{ $data->angkatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('angkatan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success mr-2 mb-1 " title="Filter">
                                <i class="bi bi-funnel mr-1 "></i><span class="bi-text mr-2">Filter Data</span></button>
                            <a type="reset" href="/kelas" class="btn btn-secondary mb-1" title="Reset">
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
                            <h4 class="text-primary capitalize">List Kelas</h4>
                        </div>
                        <div class="col-lg-1 col-sm d-flex justify-content-end">
                            {{-- Button Tambah Data --}}
                            <a href="/kelas/create" class="text-white">
                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                    title="Tambah Data" data-original-title="Tambah Data">
                                    <i class="fa fa-plus-circle btn-tambah-data"></i>
                                </button>
                            </a>
                            {{-- Akhir Button Tambah Data --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- FORM PENCARIAN -->
                            <div class="col-lg-12 Search-form">
                                <form class="" action="/kelas" method="get">
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
                                <div class="col-lg-4 ">
                                    <div class="card">
                                        <div class="card-header" style="background-color: rgb(212, 232, 250) ">
                                            <h4 class="uppercase">{{ $data->kelas }} {{ $data->angkatan }}</h4>
                                            <div class="card-header-action mr-2">
                                                <a title="Lihat Detail"
                                                    data-collapse="#mycard-collapse-{{ $data->nip_wali_kelas }}"
                                                    class="btn btn-icon btn-info" href="#"><i
                                                        class="fas fa-plus"></i></a>
                                            </div>
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton2"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    title="Tombol Aksi">
                                                    <i class="bi bi-three-dots-vertical btn-tambah-data"></i>
                                                </button>
                                                <div class="dropdown-menu ">
                                                    <a class="dropdown-item has-icon text-info"
                                                        href="/kelas/{{ $data->kelas_id }}"><i class="far bi-eye"></i>
                                                        Detail</a>
                                                    <a class="dropdown-item has-icon text-warning"
                                                        href="/kelas/{{ $data->kelas_id }}/edit"><i
                                                            class="far bi-pencil-square"></i>
                                                        Edit</a>
                                                    <form action="/kelas/{{ $data->kelas_id }}" method="post">
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
                                        </div>
                                        <div class="collapse" id="mycard-collapse-{{ $data->nip_wali_kelas }}"
                                            style="background-color : aliceblue ;">
                                            @if ($data->foto)
                                                <a href="/kelas/{{ $data->kelas_id }}" title="klik melihat Detail Kelas">
                                                    <img src="{{ asset('storage/' . $data->foto) }}"
                                                        alt="foto {{ $data->nama_wali_kelas }}"
                                                        class="img-preview-kelas card-img-top">
                                                </a>
                                            @else
                                                <a href="/kelas/{{ $data->kelas_id }}" title="klik melihat Detail Kelas">
                                                    <img src="{{ asset('img/kelas.webp') }}"
                                                        alt="foto {{ $data->nama_wali_kelas }}"
                                                        class="img-preview-kelas card-img-top">
                                                </a>
                                            @endif
                                            <div class="card-body">
                                                <h5 class="card-title uppercase text-center">{{ $data->kelas }}
                                                    {{ $data->angkatan }}</h5>
                                                <strong>Kompetensi Keahlian (Jurusan) :</strong>
                                                <span class="uppercase d-block mb-1">
                                                    @foreach ($konsentrasiList as $item)
                                                        @if ($item->id_kk === $data->id_kk)
                                                            <span><a href="/konsentrasi-keahlian/{{ $item->id_kk }}"
                                                                    title="Klik untuk detail"
                                                                    class="text-dark">{{ $item->konsentrasi_keahlian }}</a></span>
                                                        @break

                                                    @elseif ($data->id_kk == '')
                                                        Belum Mengisi Kompetensi Keahlian
                                                    @endif
                                                @endforeach
                                            </span>
                                            @foreach ($waliKelasList as $item)
                                                @if ($item->nip_wali_kelas == $data->nip_wali_kelas)
                                                    <strong>Wali Kelas :</strong>
                                                    <span><a href="/wali-kelas/{{ $item->nip_wali_kelas }}"
                                                            title="Klik untuk detail"
                                                            class="text-dark">{{ $item->nama_wali_kelas }}</a></span>
                                                @elseif ($data->nip_wali_kelas == '')
                                                    <strong>Wali Kelas :</strong>
                                                    <span> Belum Memiliki Wali Kelas</span>
                                                @break
                                            @endif
                                        @endforeach
                                        <a href="" class="stretched-link"></a>
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
