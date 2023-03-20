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
                        <div class="breadcrumb-item d-inline active capitalize"><a href="/kelas">Kelas</a></div>
                        <div class="breadcrumb-item d-inline capitalize">Detail Kelas</div>
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
                                        <a href="/kelas" title="Kembali">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h4 class="text-primary capitalize">Detail Kelas</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <a href="/kelas/{{ $data->kelas_id }}/edit" class="text-white">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                        data-placement="top" title="Edit Data Kelas" data-original-title="Edit Data Kelas">
                                        <i class="bi bi-pencil btn-tambah-data"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div action="/kelas" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        @if ($data->foto)
                                            <div class="mt-3 ml-4">
                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                    alt="foto {{ $data->username }}" class="img-kelas">
                                            </div>
                                        @else
                                            <div class="mt-3 ml-4">
                                                <img src="{{ asset('img/kelas.webp') }}" alt="foto {{ $data->username }}"
                                                    class="img-kelas">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="capitalize" for="kelas_id">ID Kelas : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-key-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('kelas_id') is-invalid @enderror"
                                                    value="{{ $data->kelas_id }}" id="kelas_id" name="kelas_id" readonly>
                                            </div>
                                            @error('kelas_id')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="angkatan">Angkatan : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-calendar-event-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('angkatan') is-invalid @enderror"
                                                    value="{{ $data->angkatan }}" id="angkatan" name="angkatan" readonly>
                                            </div>
                                            @error('angkatan')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="capitalize" for="kelas">Nama Kelas : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-cast"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('kelas') is-invalid @enderror"
                                                    value="{{ $data->kelas }}" id="kelas" name="kelas" readonly>
                                            </div>
                                            @error('kelas')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="capitalize" for="id_kk">Konsentrasi Keahlian : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-telephone-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('id_kk') is-invalid @enderror"
                                                    value="{{ $data->id_kk }}" id="id_kk" name="id_kk" readonly>
                                            </div>
                                            @error('id_kk')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="capitalize" for="nip_wali_kelas">Wali Kelas : </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-secondary">
                                                <i class="fa-solid fa-user-tie"></i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="form-control @error('nip_wali_kelas') is-invalid @enderror"
                                            @foreach ($waliKelasList as $item)
                                                        @if ($item->nip_wali_kelas == $data->nip_wali_kelas)
                                                        value="{{ $item->nama_wali_kelas }}" placeholder="{{ $item->nama_wali_kelas }}"
                                                        @elseif($data->nip_wali_kelas == '')
                                                        value="" placeholder="Belum Mengisi Wali Kelas"
                                                        @endif @endforeach
                                            id="nip_wali_kelas" name="nip_wali_kelas" readonly>
                                    </div>
                                    @error('nip_wali_kelas')
                                        {{ $message }}
                                    @enderror
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
