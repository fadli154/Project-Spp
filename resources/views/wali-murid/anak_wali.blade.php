@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-9 col-sm-8">
                        <h4 class="text-dark judul-halaman">Manajemen Siswa</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-3 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active"><a href="/wali-dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active">List Siswa</div>
                    </div>
                    {{-- Akhir Breadcrumb --}}
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-1 mr-3">
                                <a href="/wali-dashboard">
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                            </div>
                            <div class="col-">
                                <h4 class="text-primary">List Data Anak</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- FORM PENCARIAN -->
                            <div class="col-12 Search-form">
                                <form class="" action="/siswa" method="get">
                                    <div class="input-group input-group mb-3 float-right">
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
                                        <div class="card-header" style="background-color: rgb(220, 211, 228)">
                                            <h4 class="capitalize">{{ $data->nama }} | ({{ $data->nisn }})</h4>
                                            <div class="card-header-action mr-2">
                                                <a title="Lihat Detail" data-collapse="#mycard-collapse-{{ $data->nisn }}"
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
                                                        href="/siswa/{{ $data->nisn }}"><i class="far bi-eye"></i>
                                                        Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="mycard-collapse-{{ $data->nisn }}"
                                            style="background-color : @if ($data->jk == 'L') rgb(189, 189, 216) @else rgb(252, 239, 252) @endif ;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-center">
                                                    {{-- fotoCard --}}
                                                    <div class="col-lg-4 col-md-12 mr-4">
                                                        @if ($data->foto)
                                                            <div class="d-fle justify-content-center">
                                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                                    alt="foto {{ $data->nama }}" class="foto-siswa mt-1">
                                                            </div>
                                                        @else
                                                            @if ($data->jk == 'L')
                                                                <div class="d-fle justify-content-center">
                                                                    <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                                        alt="foto {{ $data->nama }}"
                                                                        class="foto-siswa mt-2 mr-2">
                                                                </div>
                                                            @else
                                                                <div class="d-fle justify-content-center">
                                                                    <img src="{{ asset('img/avatar/avatar-5.png') }}"
                                                                        alt="foto {{ $data->nama }}"
                                                                        class="foto-siswa mt-2 mr-2">
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    {{-- Akhird Foto card --}}
                                                    <div class="col-lg-6 col-sm-6 profile-data">
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
                                                                <p>Kelas : {{ $item->kelas }} {{ $item->angkatan }}</p>
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
                    {{-- {{ $dataList->links() }} --}}
                    {{-- Akhir Pagination --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
