@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-8 col-sm-8">
                        <h4 class="text-dark">Manajemen Siswa</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-4 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active"><a href="/siswa">Siswa</a></div>
                        <div class="breadcrumb-item d-inline">Profile Siswa</div>
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
                                    <div class="col-1 ">
                                        <a href="/siswa" title="Kembali">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h4 class="text-primary">Profile Siswa</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <a href="/siswa/{{ $data->nisn }}/edit" class="text-white">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                        data-placement="top" title="Edit Data Siswa" data-original-title="Edit Data Siswa">
                                        <i class="bi bi-pencil btn-tambah-data"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="/siswa" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link {{ $showTab === 'profile' ? 'active show' : '' }}"
                                                id="profile-tab2" data-toggle="tab" href="#profile2" role="tab"
                                                aria-controls="profile">Profile</a>
                                        </li>
                                        <li class="nav-item {{ $showTab === 'tagihan' ? 'active show' : '' }}">
                                            <a class="nav-link" id="tagihan-tab2" data-toggle="tab" href="#tagihan2"
                                                role="tab" aria-controls="tagihan">Tagihan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#contact2"
                                                role="tab" aria-controls="contact">Contact</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-bordered" id="myTab3Content">
                                        <div class="tab-pane fade {{ $showTab === 'profile' ? 'active show' : '' }}"
                                            id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @if ($data->foto)
                                                        <div class="justify-content-center mt-3 ml-4">
                                                            <img src="{{ asset('storage/' . $data->foto) }}"
                                                                alt="foto {{ $data->nama }}" class="foto-user">
                                                        </div>
                                                    @else
                                                        <div class="justify-content-center mt-3 ml-4">
                                                            <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                                alt="foto {{ $data->nama }}" class="foto-user">
                                                        </div>
                                                    @endif
                                                    @if ($data->status == '1')
                                                        <div class="d-flex justify-content-center">
                                                            <button type="button" class="btn btn-success btn-icon mt-3">
                                                                <i class="bi bi-bookmark-check-fill fa-6 mr-2"
                                                                    style="font-size: 13px;"></i> <strong
                                                                    class="uppercase">Aktif</strong>
                                                            </button>
                                                        </div>
                                                    @else
                                                        <div class="d-flex justify-content-center">
                                                            <button type="button" class="btn btn-danger btn-icon mt-3">
                                                                <i class="bi bi-bookmark-x-fill fa-6 mr-2"
                                                                    style="font-size: 13px;"></i> <strong
                                                                    class="uppercase">TidaK Aktif</strong>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="nama">Nama Siswa : </label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text bg-secondary">
                                                                            <i class="fa fa-user-graduate"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        class="form-control capitalize @error('nama') is-invalid @enderror"
                                                                        value="{{ $data->nama }}" id="nama"
                                                                        name="nama" readonly>
                                                                </div>
                                                                @error('nama')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kelas_id">Kelas Siswa : </label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text bg-secondary">
                                                                            <i class="bi bi-cast"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        placeholder="Belum Mengisi kelas"
                                                                        class="form-control capitalize @error('kelas_id') is-invalid @enderror"
                                                                        @foreach ($kelasList as $item)
                                                                            @if ($item->kelas_id === $data->kelas_id)
                                                                                value="{{ $item->kelas }}"
                                                                                @break
                                                                            @endif @endforeach
                                                                        id="kelas_id" name="kelas_id" readonly>
                                                                </div>
                                                                @error('kelas_id')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="wali_id">Wali Murid Siswa : </label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text bg-secondary">
                                                                            <i class="fa fa-user-plus"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        placeholder="Belum Mengisi Wali Murid"
                                                                        class="form-control capitalize @error('wali_id') is-invalid @enderror"
                                                                        @foreach ($waliList as $item)
                                                                            @if ($item->id === $data->wali_id)
                                                                                value="{{ $item->name }}"
                                                                                @break
                                                                            @endif @endforeach
                                                                        id="wali_id" name="wali_id" readonly>
                                                                </div>
                                                                @error('wali_id')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="nisn">NISN Siswa : </label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text bg-secondary">
                                                                            <i class="bi bi-key-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        class="form-control @error('nisn') is-invalid @enderror"
                                                                        value="{{ $data->nisn }}" id="nisn"
                                                                        name="nisn" readonly>
                                                                </div>
                                                                @error('nisn')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nik">NIK Siswa : </label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text bg-secondary">
                                                                            <i class="bi bi-key"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        class="form-control @error('nik') is-invalid @enderror"
                                                                        value="{{ $data->nik }}" id="nik"
                                                                        name="nik" readonly>
                                                                </div>
                                                                @error('nik')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                            <div class="form-group ">
                                                                <label for="no_telp">Nomor Telepon Wali Murid Siswa :
                                                                </label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text bg-secondary">
                                                                            <i class="bi bi-telephone-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        placeholder="Belum Mengisi Nomor Telepon"
                                                                        class="form-control phone capitalize @error('no_telp') is-invalid @enderror"
                                                                        @foreach ($waliList as $item)
                                                                            @if ($item->id === $data->wali_id)
                                                                                value="{{ $item->no_telp }}"
                                                                                @break
                                                                            @endif @endforeach
                                                                        id="no_telp" name="no_telp" readonly>
                                                                </div>
                                                                @error('no_telp')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kelas_id">Wali Kelas Siswa : </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-secondary">
                                                                    <i class="bi bi-cast"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" placeholder="Belum Memiliki Wali Kelas"
                                                                class="form-control capitalize @error('kelas_id') is-invalid @enderror"
                                                                @foreach ($kelasList as $item)
                                                                            @if ($item->kelas_id === $data->kelas_id)
                                                                                value="{{ $item->WaliKelas->nama_wali_kelas }}"
                                                                                @break
                                                                            @endif @endforeach
                                                                id="kelas_id" name="kelas_id" readonly>
                                                        </div>
                                                        @error('kelas_id')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="tempat_lahir">Tempat Lahir Siswa : </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-secondary">
                                                                    <i class="bi bi-geo-alt-fill"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text"
                                                                class="form-control capitalize @error('tempat_lahir') is-invalid @enderror"
                                                                value="{{ $data->tempat_lahir }}" id="tempat_lahir"
                                                                name="tempat_lahir" readonly>
                                                        </div>
                                                        @error('tempat_lahir')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade {{ $showTab === 'tagihan' ? 'active show' : '' }}"
                                            id="tagihan2" role="tabpanel" aria-labelledby="profile-tab2">
                                            <h4 class="mt-3 col-12">Data Tagihan</h4>
                                            <div class="table-responsive col-6">
                                                <table class="table table-bordered table-success table-striped table-md">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Biaya/Tagihan</th>
                                                            <th>Nominal</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($waliList as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td class="capitalize"><a
                                                                        href="/siswa/{{ $item->nisn }}"
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
                                        </div>
                                        <div class="tab-pane fade" id="contact2" role="tabpanel"
                                            aria-labelledby="contact-tab2">
                                            Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus.
                                            Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris.
                                            Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius
                                            leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare
                                            vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum
                                            venenatis ultrices. Proin bibendum bibendum augue ut luctus.
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
