@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-7 col-sm-8">
                        <h4 class="text-dark capitalize">Manajemen Users</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-5 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/wali-murid">Wali Murid</a></div>
                        <div class="breadcrumb-item d-inline capitalize">Profile Wali Murid</div>
                    </div>
                    {{-- Akhir Breadcrumb --}}
                </div>
            </div>
        </div>

        @foreach ($detailData as $data)
            <div class="section-body">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-1">
                                        <a href="/wali-murid" title="Kembali">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h4 class="text-primary capitalize">Profile Wali Murid</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <a href="/wali-murid/{{ $data->id }}/edit" class="text-white">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                        data-placement="top" title="Edit Data Wali Murid"
                                        data-original-title="Edit Data Wali Murid">
                                        <i class="bi bi-pencil btn-tambah-data"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div action="/wali-murid" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        @if ($data->foto)
                                            <div class="justify-content-center mt-3 ml-4">
                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                    alt="foto {{ $data->username }}" class="foto-user">
                                            </div>
                                        @else
                                            <div class="justify-content-center mt-3 ml-4">
                                                <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                    alt="foto {{ $data->username }}" class="foto-user">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name" class="capitalize">Nama : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-person-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control capitalize @error('name') is-invalid @enderror"
                                                    value="{{ $data->name }}" id="name" name="name" readonly>
                                            </div>
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="username">Username : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-person-badge-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    value="{{ $data->username }}" id="username" name="username" readonly>
                                            </div>
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="id">ID Wali Murid : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-key-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control @error('id') is-invalid @enderror"
                                                    value="{{ $data->id }}" id="id" name="id" readonly>
                                            </div>
                                            @error('id')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="capitalize" for="level">Akses : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-layers-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control capitalize @error('level') is-invalid @enderror"
                                                    @if ($data->level == 'wali') value="Wali Murid" @else value="{{ $data->level }}" @endif
                                                    id="level" name="level" readonly>
                                            </div>
                                            @error('level')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="email">Email : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-envelope-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ $data->email }}" id="email" name="email" readonly>
                                            </div>
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="no_telp">Nomor Telepon : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-telephone-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control phone @error('no_telp') is-invalid @enderror"
                                                    value="{{ $data->no_telp }}" id="no_telp" name="no_telp" readonly>
                                            </div>
                                            @error('no_telp')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <h4 class="mt-3 col-12">Data Anak</h4>
                                    <div class="table-responsive col-6">
                                        <table class="table table-bordered table-success table-striped table-md">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Siswa</th>
                                                    <th>NISN</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($siswaData as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="capitalize"><a href="/siswa/{{ $item->nisn }}"
                                                                class="text-dark" title="Klik Untuk Detail">
                                                                {{ $item->nama }}</a>
                                                        </td>
                                                        <td>{{ $item->nisn }}</td>
                                                        <td>
                                                            <form action="/wali-siswa/{{ $item->nisn }}"
                                                                method="post">
                                                                @csrf
                                                                @method('put')
                                                                <button type="submit"
                                                                    class="confirm btn btn-danger has-icon ">
                                                                    <i
                                                                        class="far bi-trash-fill mt-2 mr-2"></i>Hapus</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <div class="card" style="border: 2px solid rgb(240, 240, 240)">
                                            <div class="card-header">
                                                <h6 class="text-center">Tambah Data Anak</h6>
                                            </div>
                                            <div class="card-body">
                                                <form class="form" method="post" action="/wali-siswa">
                                                    @csrf
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <select
                                                                class="form-control @error('nisn') is-invalid @enderror select2"
                                                                id="select2" name="nisn" placeholder="pilih">
                                                                <option value="" selected disabled>Pilih Siswa
                                                                </option>
                                                                @foreach ($allSiswa as $item)
                                                                    <option value="{{ $item->nisn }}">
                                                                        {{ $item->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('nisn')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="wali_id" value="{{ $data->id }}">
                                                    <button type="submit" class="btn btn-primary justify-content-end"
                                                        data-toggle="tooltip" data-placement="top" title="Tambah Data"
                                                        data-original-title="Tambah Data">
                                                        <i class="bi bi-patch-plus btn-tambah-data"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
    @endforeach
@endsection
