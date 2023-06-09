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
                        @can('administrator')
                            <div class="breadcrumb-item d-inline active"><a href="/siswa">Siswa</a></div>
                        @endcan
                        @can('wali')
                            <div class="breadcrumb-item d-inline active"><a href="/anak">Siswa</a></div>
                        @endcan
                        <div class="breadcrumb-item d-inline">Detail Siswa</div>
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
                                        @can('administrator')
                                            <a href="/siswa" title="Kembali">
                                                <i class="bi bi-arrow-left"></i>
                                            </a>
                                        @endcan
                                        @can('wali')
                                            <a href="/anak" title="Kembali">
                                                <i class="bi bi-arrow-left"></i>
                                            </a>
                                        @endcan
                                    </div>
                                    <div class="col">
                                        <h4 class="text-primary">Detail Data Siswa</h4>
                                    </div>
                                </div>
                            </div>
                            @can('administrator')
                                <div class="col-4 d-flex justify-content-end">
                                    <a href="/siswa/{{ $data->nisn }}/edit" class="text-white">
                                        <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                            data-placement="top" title="Edit Data Siswa" data-original-title="Edit Data Siswa">
                                            <i class="bi bi-pencil btn-tambah-data"></i>
                                        </button>
                                    </a>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body ">
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
                                    <li class="nav-item {{ $showTab === 'riwayat-pembayaran' ? 'active show' : '' }}">
                                        <a class="nav-link" id="riwayat-pembayaran-tab2" data-toggle="tab"
                                            href="#riwayat-pembayaran2" role="tab"
                                            aria-controls="riwayat-pembayaran">Riwayat Pembayaran</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    <div class="tab-pane fade {{ $showTab === 'profile' ? 'active show' : '' }}"
                                        id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12">
                                                @if ($data->foto)
                                                    <div class="d-flex justify-content-center mt-3 ml-4">
                                                        <img src="{{ asset('storage/' . $data->foto) }}"
                                                            alt="foto {{ $data->nama }}"
                                                            class="foto-user foto-user-detail">
                                                    </div>
                                                @else
                                                    @if ($data->jk == 'L')
                                                        <div class="d-flex justify-content-center mt-3 ml-4">
                                                            <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                                alt="foto {{ $data->nama }}"
                                                                class="foto-user foto-user-detail">
                                                        </div>
                                                    @else
                                                        <div class="d-flex justify-content-center mt-3 ml-4">
                                                            <img src="{{ asset('img/avatar/avatar-5.png') }}"
                                                                alt="foto {{ $data->nama }}"
                                                                class="foto-user foto-user-detail">
                                                        </div>
                                                    @endif
                                                @endif
                                                @if ($data->status == '1')
                                                    <div class="d-flex justify-content-center ml-3">
                                                        <button type="button" class="btn btn-success btn-icon mt-3">
                                                            <i class="bi bi-bookmark-check-fill fa-6 mr-2"
                                                                style="font-size: 13px;"></i> <strong
                                                                class="uppercase">Aktif</strong>
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-center ml-3">
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
                                                    <div class="col-sm-12 col-md-12 col-lg-6">
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
                                                                <input type="text" placeholder="Belum Mengisi kelas"
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
                                                    <div class="col-sm-12 col-md-12 col-lg-6">
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
                                                <div class="row">
                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
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
                                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                                        <label for="jk">Jenis Kelamin Siswa : </label>
                                                        @if ($data->jk == 'L')
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-secondary">
                                                                        <i class="bi bi-gender-male"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="text"
                                                                    class="form-control capitalize @error('jk') is-invalid @enderror"
                                                                    value="Laki - Laki" id="jk" name="jk"
                                                                    readonly>
                                                            </div>
                                                        @else
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-secondary">
                                                                        <i class="bi bi-gender-female"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="text"
                                                                    class="form-control capitalize @error('jk') is-invalid @enderror"
                                                                    value="Perempuan" id="jk" name="jk"
                                                                    readonly>
                                                            </div>
                                                        @endif

                                                        @error('jk')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
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
                                        <div class="row">
                                            <div class="{{ auth()->user()->level == 'wali' ? 'col-12' : 'col-lg-7 ' }}">
                                                <h4 class="capitalize">Detail Tagihan Siswa | ({{ $data->nama }})</h4>
                                                <div class="table-responsive">
                                                    <table
                                                        class="table table-bordered table-success table-striped table-md">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Biaya/Tagihan</th>
                                                                <th>Nominal</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        @if ($tagihanList->count() > 0)
                                                            @foreach ($tagihanList as $item)
                                                                @foreach ($tagihanDetailList as $data)
                                                                    @if ($item->id == $data->tagihan_id)
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td class="capitalize">
                                                                                    {{ $data->nama_biaya }}</td>
                                                                                <td class="text-center">
                                                                                    {{ currency_IDR($data->nominal_biaya) }}
                                                                                </td>
                                                                                <td>
                                                                                    <form
                                                                                        action="/tagihan/{{ $item->nisn }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <input type="hidden"
                                                                                            name="id_details"
                                                                                            value="{{ $data->id }}">
                                                                                        <button type="submit"
                                                                                            class="confirm btn btn-danger has-icon ">
                                                                                            <i
                                                                                                class="far bi-trash-fill mt-2 mr-2"></i>Hapus</button>
                                                                                    </form>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    @endif
                                                                @endforeach
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="2"
                                                                            class="uppercase text-dark font-weight-bold text-center">
                                                                            Total
                                                                            Tagihan
                                                                        </td>
                                                                        <td colspan="2"
                                                                            class="uppercase text-dark font-weight-bold text-center">
                                                                            {{ currency_IDR($item->tagihanDetails->sum('nominal_biaya')) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2"
                                                                            class="uppercase text-dark font-weight-bold text-center">
                                                                            Sisa
                                                                            Tagihan
                                                                        </td>
                                                                        <td colspan="2"
                                                                            class="uppercase text-dark font-weight-bold text-center">
                                                                            {{ currency_IDR($item->sisa_tagihan) }}
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            @endforeach
                                                        @else
                                                            <td colspan="7" class="text-center bg-success">Belum ada
                                                                Tagihan
                                                            </td>
                                                        @endif
                                                    </table>
                                                    @if ($data->keterangan == null)
                                                        <strong>
                                                            Keterangan Tagihan : Tidak Ada Keterangan
                                                        </strong>
                                                    @else
                                                        <strong>
                                                            Keterangan Tagihan : {{ $data->keterangan }}
                                                        </strong>
                                                    @endif
                                                </div>
                                            </div>
                                            @can('entri-pembayaran')
                                                <div class="col-5">
                                                    <div class="card" style="border: 2px solid rgb(240, 240, 240)">
                                                        <div class="card-header">
                                                            <h6 class="text-center">Form Pembayaran</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form" method="post" action="/pembayaran"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label class="capitalize" for="jumlah_dibayar">Masukkan
                                                                        Jumlah/Nominal Yang Dibayar :
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <i class="bi bi-cash"></i>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" type-currency="IDR"
                                                                            class="form-control @error('jumlah_dibayar') is-invalid @enderror"
                                                                            placeholder="Contoh : Rp. 100.000"
                                                                            value="{{ old('jumlah_dibayar') }}"
                                                                            id="jumlah_dibayar" name="jumlah_dibayar">
                                                                    </div>
                                                                    @error('jumlah_dibayar')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="capitalize" for="tanggal_bayar">Masukkan
                                                                        Tanggal Pembayaran :
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </div>
                                                                        </div>
                                                                        <input type="date"
                                                                            class="form-control @error('tanggal_bayar') is-invalid @enderror"
                                                                            value="{{ old('tanggal_bayar') ?? date('Y-m-d') }}"
                                                                            id="tanggal_bayar" name="tanggal_bayar">
                                                                    </div>
                                                                    @error('tanggal_bayar')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="capitalize" for="bukti_bayar">Masukkan
                                                                        Foto/Bukti Pembayaran :
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <i class="bi bi-file-earmark-image"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="custom-file">
                                                                            <input type="file"
                                                                                class="custom-file-input @error('bukti_bayar') is-invalid @enderror"
                                                                                id="foto" name="bukti_bayar"
                                                                                onchange="previewImage()">
                                                                            <label class="custom-file-label"
                                                                                class="capitalize" for="bukti_bayar">Pilih
                                                                                Foto</label>
                                                                        </div>
                                                                        <input type="file" class="custom-file-input ">
                                                                        <img
                                                                            class="img-preview img-preview-create img-fluid mt-2 col-sm-2">
                                                                    </div>
                                                                    @error('bukti_bayar')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                                @foreach ($tagihanList as $item)
                                                                    <input type="hidden" name="tagihan_id"
                                                                        value="{{ $item->id }}">
                                                                @endforeach
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ auth()->user()->id }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary justify-content-end"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Konfirmasi Bayar"
                                                                    data-original-title="Konfirmasi Bayar">
                                                                    <i class="fa fa-check"></i> Simpan
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="tab-pane fade {{ $showTab === 'riwayat-pembayaran' ? 'active show' : '' }}"
                                        id="riwayat-pembayaran2" role="tabpanel" aria-labelledby="profile-tab2">
                                        <div class="row">
                                            <div class="{{ auth()->user()->level == 'wali' ? 'col-12' : 'col-lg-7 ' }}">
                                                <h4>Riwayat Pembayaran Siswa </h4>
                                                <div class="table-responsive">
                                                    <table
                                                        class="table table-bordered table-success table-striped table-md">
                                                        <thead>
                                                            <tr>
                                                                @can('entri-pembayaran')
                                                                    <th class="text-center">Kwitansi</th>
                                                                @endcan
                                                                <th class="text-center">Tanggal Pembayaran</th>
                                                                <th class="text-center">Jumlah Dibayar</th>
                                                            </tr>
                                                        </thead>
                                                        @if ($tagihanList->count() > 0)
                                                            @foreach ($tagihanList as $item)
                                                                @foreach ($pembayaranList as $data)
                                                                    @if ($item->id == $data->tagihan_id)
                                                                        <tbody>
                                                                            <tr>
                                                                                @can('entri-pembayaran')
                                                                                    <td class="text-center">
                                                                                        <a href="/kwitansi-pembayaran/{{ $data->id }}"
                                                                                            target="blank" class="text-white">
                                                                                            <button type="button"
                                                                                                class="btn btn-primary"
                                                                                                data-toggle="tooltip"
                                                                                                data-placement="top"
                                                                                                title="Kwitansi Pembayaran"
                                                                                                data-original-title="Kwitansi Pembayaran">
                                                                                                <i
                                                                                                    class="bi bi-printer-fill btn-tambah-data"></i>
                                                                                            </button>
                                                                                        </a>
                                                                                    </td>
                                                                                @endcan
                                                                                <td class="capitalize text-center">
                                                                                    {{ $data->created_at->format('d-M-Y | g:i:s') }}
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    {{ currency_IDR($data->jumlah_dibayar) }}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    @endif
                                                                @endforeach
                                                                <tfoot>
                                                                    <tr>
                                                                        @can('entri-pembayaran')
                                                                            <td colspan="2"
                                                                                class="uppercase text-dark font-weight-bold text-center">
                                                                                Sisa
                                                                                Tagihan
                                                                            </td>
                                                                        @endcan
                                                                        @can('wali')
                                                                            <td
                                                                                class="uppercase text-dark font-weight-bold text-center">
                                                                                Sisa
                                                                                Tagihan
                                                                            </td>
                                                                        @endcan
                                                                        @if ($data->jumlah_dibayar != null)
                                                                            <td
                                                                                class="uppercase text-dark font-weight-bold d-flex justify-content-center">
                                                                                {{ currency_IDR($item->sisa_tagihan) }}
                                                                            </td>
                                                                        @else
                                                                            <td
                                                                                class="uppercase text-dark font-weight-bold d-flex justify-content-center">
                                                                                {{ currency_IDR($item->tagihanDetails->sum('nominal_biaya')) }}
                                                                            </td>
                                                                        @endif
                                                                    </tr>

                                                                    <tr>
                                                                        @can('entri-pembayaran')
                                                                            <td colspan="2"
                                                                                class="uppercase text-dark font-weight-bold text-center">
                                                                                Status
                                                                                Tagihan
                                                                            </td>
                                                                        @endcan
                                                                        @can('wali')
                                                                            <td
                                                                                class="uppercase text-dark font-weight-bold text-center">
                                                                                Status
                                                                                Tagihan
                                                                            </td>
                                                                        @endcan
                                                                        @if ($item->status == 'lunas')
                                                                            <td colspan="2"
                                                                                class="d-flex justify-content-center">
                                                                                <button type="submit"
                                                                                    class="btn btn-success capitalize justify-content-end"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Status Tagihan"
                                                                                    data-original-title="Status Tagihan">
                                                                                    <i class="bi bi-patch-check-fill">
                                                                                        {{ $item->status }}</i>
                                                                                </button>
                                                                            </td>
                                                                        @elseif ($item->status == 'angsur')
                                                                            <td colspan="2"
                                                                                class="d-flex justify-content-center">
                                                                                <button type="submit"
                                                                                    class="btn btn-warning capitalize justify-content-end"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Status Tagihan"
                                                                                    data-original-title="Status Tagihan"><i
                                                                                        class="bi bi-patch-exclamation-fill">
                                                                                        {{ $item->status }}</i>
                                                                                </button>
                                                                            </td>
                                                                        @else
                                                                            <td colspan="2"
                                                                                class="d-flex justify-content-center">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary capitalize justify-content-end"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Status Tagihan"
                                                                                    data-original-title="Status Tagihan">
                                                                                    <i class="bi bi-patch-minus-fill">
                                                                                        Baru</i>
                                                                                </button>
                                                                            </td>
                                                                        @endif
                                                                    </tr>
                                                                </tfoot>
                                                            @endforeach
                                                        @else
                                                            <td colspan="7" class="text-center bg-success">Belum ada
                                                                Pembayaran
                                                            </td>
                                                        @endif
                                                    </table>
                                                </div>
                                            </div>
                                            @can('entri-pembayaran')
                                                <div class="col-5">
                                                    <div class="card" style="border: 2px solid rgb(240, 240, 240)">
                                                        <div class="card-header">
                                                            <h6 class="text-center">Form Pembayaran</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form" method="post" action="/pembayaran"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label class="capitalize" for="jumlah_dibayar">Masukkan
                                                                        Jumlah/Nominal Yang Dibayar :
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <i class="bi bi-cash"></i>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" type-currency="IDR"
                                                                            class="form-control @error('jumlah_dibayar') is-invalid @enderror"
                                                                            placeholder="Contoh : Rp. 100.000"
                                                                            value="{{ old('jumlah_dibayar') }}"
                                                                            id="jumlah_dibayar" name="jumlah_dibayar">
                                                                    </div>
                                                                    @error('jumlah_dibayar')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="capitalize" for="tanggal_bayar">Masukkan
                                                                        Tanggal Pembayaran :
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </div>
                                                                        </div>
                                                                        <input type="date"
                                                                            class="form-control @error('tanggal_bayar') is-invalid @enderror"
                                                                            value="{{ old('tanggal_bayar') ?? date('Y-m-d') }}"
                                                                            id="tanggal_bayar" name="tanggal_bayar">
                                                                    </div>
                                                                    @error('tanggal_bayar')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="capitalize" for="bukti_bayar">Masukkan
                                                                        Foto/Bukti Pembayaran :
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <i class="bi bi-file-earmark-image"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="custom-file">
                                                                            <input type="file"
                                                                                class="custom-file-input @error('bukti_bayar') is-invalid @enderror"
                                                                                id="foto" name="bukti_bayar"
                                                                                onchange="previewImage()">
                                                                            <label class="custom-file-label"
                                                                                class="capitalize" for="bukti_bayar">Pilih
                                                                                Foto</label>
                                                                        </div>
                                                                        <input type="file" class="custom-file-input ">
                                                                        <img
                                                                            class="img-preview img-preview-create img-fluid mt-2 col-sm-2">
                                                                    </div>
                                                                    @error('bukti_bayar')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                                @foreach ($tagihanList as $item)
                                                                    <input type="hidden" name="tagihan_id"
                                                                        value="{{ $item->id }}">
                                                                @endforeach
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ auth()->user()->id }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary justify-content-end"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Konfirmasi Bayar"
                                                                    data-original-title="Konfirmasi Bayar">
                                                                    <i class="fa fa-check"></i> Simpan
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    @endforeach
@endsection
