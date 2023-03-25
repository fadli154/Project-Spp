@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-md-7 col-sm-8">
                        <h4 class="text-dark capitalize">Manajemen Siswa</h4>
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-md-5 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/wali-kelas">Wali Kelas</a></div>
                        <div class="breadcrumb-item d-inline capitalize">Profile Wali Kelas</div>
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
                                        <a href="/wali-kelas" title="Kembali">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h4 class="text-primary capitalize">Profile Wali Kelas</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <a href="/wali-kelas/{{ $data->nip_wali_kelas }}/edit" class="text-white">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                        data-placement="top" title="Edit Data Wali Kelas"
                                        data-original-title="Edit Data Wali Kelas">
                                        <i class="bi bi-pencil btn-tambah-data"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div action="/wali-kelas" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        @if ($data->foto)
                                            <div class="justify-content-center mt-3 ml-4">
                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                    alt="foto {{ $data->nama_wali_kelas }}" class="foto-user">
                                            </div>
                                        @else
                                            @if ($data->jk == 'L')
                                                <div class="">
                                                    <div class="justify-content-center mt-3 ml-4">
                                                        <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                            alt="foto {{ $data->nama_wali_kelas }}" class="foto-user">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="">
                                                    <div class="justify-content-center mt-3 ml-4">
                                                        <img src="{{ asset('img/avatar/avatar-5.png') }}"
                                                            alt="foto {{ $data->nama_wali_kelas }}" class="foto-user">
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="capitalize" for="nama_wali_kelas">Nama Wali Kelas :
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-person-badge-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('nama_wali_kelas') is-invalid @enderror"
                                                    value="{{ $data->nama_wali_kelas }}" id="nama_wali_kelas"
                                                    name="nama_wali_kelas" readonly>
                                            </div>
                                            @error('nama_wali_kelas')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="nip_wali_kelas">NIP Wali Kelas : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-key-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('nip_wali_kelas') is-invalid @enderror"
                                                    value="{{ $data->nip_wali_kelas }}" id="nip_wali_kelas"
                                                    name="nip_wali_kelas" readonly>
                                            </div>
                                            @error('nip_wali_kelas')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="jabatan">Jabatan : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-user-plus"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control capitalize @error('jabatan') is-invalid @enderror"
                                                    @if ($data->jabatan == 'TP') value="Tenaga Pendidik" @else value="Tenaga Kependidikan" @endif"
                                                    id="jabatan" name="jabatan" readonly>
                                            </div>
                                            @error('jabatan')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="capitalize" for="jk">Jenis Kelamin : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        @if ($data->jk == 'L')
                                                            <i class="bi bi-gender-male"></i>
                                                        @else
                                                            <i class="bi bi-gender-female"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control capitalize @error('jk') is-invalid @enderror"
                                                    @if ($data->jk == 'L') value="Laki Laki" @else value="Perempuan" @endif
                                                    id="jk" name="jk" readonly>
                                            </div>
                                            @error('jk')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="status_pegawai">Status Pegawai : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="fa fa-list"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control capitalize @error('status_pegawai') is-invalid @enderror"
                                                    @if ($data->status_pegawai == '0') value="Tidak Aktif" @else value="Aktif" @endif
                                                    id="status_pegawai" name="status_pegawai" readonly>
                                            </div>
                                            @error('status_pegawai')
                                                {{ $message }}
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="capitalize" for="kelas_id">Kelas : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-cast"></i>
                                                    </div>
                                                </div>
                                                <input type="text" id="kelas_id" class="form-control uppercase"
                                                    @foreach ($kelasList as $item)
                                        @if ($item->nip_wali_kelas == $data->nip_wali_kelas)
                                            placeholder="{{ $item->kelas }}"
                                        @break
                                        @endif @endforeach
                                                    placeholder="Belum Mengisi Kelas" name="kelas_id" readonly>
                                            </div>
                                            @error('kelas_id')
                                                {{ $message }}
                                            @enderror
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
