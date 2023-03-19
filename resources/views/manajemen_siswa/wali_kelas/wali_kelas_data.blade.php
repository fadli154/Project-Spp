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
                        <div class="breadcrumb-item d-inline active">List Wali Kelas</div>
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
                    <form class="" action="/wali-kelas" method="get">
                        <div class="row">
                            <div class="col form-group">
                                <label class="capitalize" for="jk">Filter Jenis Kelamin : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-venus-mars"></i>
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
                                <label class="capitalize" for="jabatan">Filter Jabatan : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="jabatan" id="jabatan">
                                        <option {{ is_null(request()->input('jabatan')) ? 'selected' : '' }} value="">
                                            Semua </option>
                                        <option {{ request()->input('jabatan') == 1 ? 'selected' : '' }} value="TP">
                                            Tenaga Pendidik
                                        </option>
                                        <option
                                            {{ !is_null(request()->input('jabatan')) && request()->input('jabatan') == 0 ? 'selected' : '' }}
                                            value="TK">Tenaga Kependidikan</option>
                                    </select>
                                </div>
                                @error('jabatan')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="col form-group">
                                <label class="capitalize" for="status_pegawai">Filter Status Pegawai : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-list"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="status_pegawai" id="status_pegawai">
                                        <option {{ is_null(request()->input('status_pegawai')) ? 'selected' : '' }}
                                            value="">
                                            Semua </option>
                                        <option {{ request()->input('status_pegawai') == 1 ? 'selected' : '' }}
                                            value="0">
                                            Tidak Aktif
                                        </option>
                                        <option
                                            {{ !is_null(request()->input('status_pegawai')) && request()->input('status_pegawai') == 0 ? 'selected' : '' }}
                                            value="1">Aktif</option>
                                    </select>
                                </div>
                                @error('status_pegawai')
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
                            <h4 class="text-primary capitalize">List Wali Kelas</h4>
                        </div>
                        <div class="col-lg-1 col-sm d-flex justify-content-end">
                            {{-- Button Tambah Data --}}
                            <a href="/wali-kelas/create" class="text-white">
                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                    title="Tambah Data" data-original-title="Tambah Data">
                                    <i class="bi bi-patch-plus btn-tambah-data"></i>
                                </button>
                            </a>
                            {{-- Akhir Button Tambah Data --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- FORM PENCARIAN -->
                            <div class="col-12 Search-form">
                                <form class="" action="/wali-kelas" method="get">
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
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header"
                                            style="background-color: @if ($data->jk == 'L') rgb(212, 232, 250) @else rgb(250, 211, 247) @endif">
                                            <h4>{{ $data->nama_wali_kelas }} | ({{ $data->nip_wali_kelas }})</h4>
                                            <div class="card-header-action mr-2">
                                                <a title="Lihat Detail"
                                                    data-collapse="#mycard-collapse-{{ $data->nip_wali_kelas }}"
                                                    class="btn btn-icon btn-info" href="#"><i
                                                        class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                        <div class="collapse" id="mycard-collapse-{{ $data->nip_wali_kelas }}"
                                            style="background-color : @if ($data->jk == 'L') aliceblue @else rgb(252, 239, 252) @endif ;">
                                            <div class="card-body">
                                                <div class="dropdown d-flex justify-content-start">
                                                    <a class="btn btn-secondary rounded-pill" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false" title="Tombol Aksi">
                                                        <i class="bi bi-three-dots-vertical btn-tambah-data"></i>
                                                    </a>
                                                    <div class="dropdown-menu ">
                                                        <a class="dropdown-item has-icon text-info"
                                                            href="/wali-kelas/{{ $data->nip_wali_kelas }}"><i
                                                                class="far bi-eye"></i>
                                                            Detail</a>
                                                        <a class="dropdown-item has-icon text-warning"
                                                            href="/wali-kelas/{{ $data->nip_wali_kelas }}/edit"><i
                                                                class="far bi-pencil-square"></i>
                                                            Edit</a>
                                                        <form action="/wali-kelas/{{ $data->nip_wali_kelas }}"
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
                                                <div class="row d-flex justify-content-center">
                                                    {{-- fotoCard --}}
                                                    <div class="col-md-4 mr-4">
                                                        @if ($data->foto)
                                                            <div class="">
                                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                                    alt="foto {{ $data->nama_wali_kelas }}"
                                                                    class="foto-siswa mt-1">
                                                            </div>
                                                        @else
                                                            @if ($data->jk == 'L')
                                                                <div class="">
                                                                    <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                                        alt="foto {{ $data->nama_wali_kelas }}"
                                                                        class="foto-siswa mt-2 mr-2">
                                                                </div>
                                                            @else
                                                                <div class="">
                                                                    <img src="{{ asset('img/avatar/avatar-5.png') }}"
                                                                        alt="foto {{ $data->nama_wali_kelas }}"
                                                                        class="foto-siswa mt-2 mr-2">
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    {{-- Akhird Foto card --}}
                                                    <div class="col-md-6 profile-data">
                                                        <p class="capitalize"><strong> Nama :</strong>
                                                            {{ $data->nama_wali_kelas }}</p>
                                                        <p><strong> NIP : </strong><a class="text-dark"
                                                                href="/wali-kelas/{{ $data->nip_wali_kelas }}"
                                                                title="klik Untuk Detailnya">
                                                                {{ $data->nip_wali_kelas }}</a></p>
                                                        @if ($data->jabatan == 'TP')
                                                            <p><strong> Jabatan :</strong> Tenaga Pendidik </p>
                                                        @else
                                                            <p><strong> Jabatan :</strong> Tenaga Kependidikan</p>
                                                        @endif
                                                        @foreach ($kelasList as $item)
                                                            @if ($item->nip_wali_kelas != $data->nip_wali_kelas)
                                                                <p></p>
                                                            @elseif ($item->nip_wali_kelas == $data->nip_wali_kelas)
                                                                <p><strong> Kelas :</strong>
                                                                    <span class="uppercase">{{ $item->kelas }}</span>
                                                                </p>
                                                            @break
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
