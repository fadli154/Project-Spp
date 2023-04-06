@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    {{-- judul Page --}}
                    <div class="col-lg-7 col-md-9 col-sm-8">
                        @if (auth()->user()->level == 'wali')
                            <h4 class="text-dark judul-halaman capitalize">Profile Wali Murid</h4>
                        @else
                            <h4 class="text-dark judul-halaman capitalize">Profile
                                {{ auth()->user()->level }}</h4>
                        @endif
                    </div>
                    {{-- Akhir judul Page --}}
                    {{-- Breadcrumb --}}
                    <div class="col-lg-5 col-md-3 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active"><a href="/dashboard">Dashboard</a></div>
                        @if (auth()->user()->level == 'wali')
                            <div class="breadcrumb-item d-inline active">Profile Wali Murid</div>
                            <div class="breadcrumb-item d-inline active">Edit Profile</div>
                        @else
                            <div class="breadcrumb-item d-inline active">Profile {{ auth()->user()->level }}</div>
                            <div class="breadcrumb-item d-inline active">Edit Profile</div>
                        @endif
                    </div>
                    {{-- Akhir Breadcrumb --}}
                </div>
            </div>
        </div>

        @foreach ($editData as $data)
            <div class="section-body">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-1">
                                        <a href="/profile" title="Kembali">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        @if (auth()->user()->level == 'wali')
                                            <h4 class="text-primary capitalize">Profile Wali Murid</h4>
                                        @else
                                            <h4 class="text-primary capitalize">Profile {{ auth()->user()->level }}</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form action="/process-change-password" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        @if ($data->foto)
                                            <div class="d-flex justify-content-center mt-2 ">
                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                    alt="foto {{ $data->name }}"
                                                    class="img-preview foto-user img-fluid mt-2 d-block ">
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-center mt-2 ">
                                                <img src="{{ asset('img/avatar/avatar-1.png') }}"
                                                    alt="foto {{ $data->name }}"
                                                    class="img-preview foto-user img-fluid mt-2 d-block ">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                                <label for="name">Nama : </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-secondary">
                                                            <i class="fa fa-user-graduate"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control capitalize @error('name') is-invalid @enderror"
                                                        value="{{ $data->name }}" id="name" name="name"
                                                        placeholder="Masukkan nama">
                                                </div>
                                                <span class="text-danger">
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                                <label for="username">Username : </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-secondary">
                                                            <i class="bi bi-person-badge"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        value="{{ $data->username }}" id="username" name="username"
                                                        placeholder="Masukkan Username">
                                                </div>
                                                <span class="text-danger">
                                                    @error('username')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="email">Email : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-envelope-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            value="{{ $data->email }}" id="email" name="email"
                                                            placeholder="Masukkan Email">
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('email')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="no_telp">Nomor Telepon : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-telephone-fill"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('no_telp') is-invalid @enderror"
                                                            value="{{ $data->no_telp }}" id="no_telp" name="no_telp"
                                                            placeholder="Masukkan Nomor Telepoon">
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('no_telp')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="password_lama">Masukan Password Lama : </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-secondary">
                                                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                                                            </div>
                                                        </div>
                                                        <input type="password"
                                                            class="form-control @error('password_lama') is-invalid @enderror"
                                                            value="{{ $data->password_lama }}" id="password_lama"
                                                            name="password_lama" placeholder="Masukkan Password Lama">
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('password_lama')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <label class="capitalize" for="foto">Ubah Foto : </label>
                                        <small class="d-block">Catatan : Masukkan Foto dengan Format(png, jpg,
                                            jpeg), maksimal
                                            1
                                            mb</small>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-secondary">
                                                    <i class="bi bi-file-earmark-image"></i>
                                                </div>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('foto') is-invalid @enderror"
                                                    id="foto" name="foto" onchange="previewImage()">
                                                <label class="custom-file-label" class="capitalize" for="foto">Pilih
                                                    Foto
                                                    Baru</label>
                                                <input type="hidden" name="oldImage" value="{{ $data->foto }}">
                                            </div>
                                        </div>
                                        <span class="text-danger">
                                            @error('foto')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <strong class="text-center col-12 bg-primary text-white p-3 mb-3">
                                        Isi dibawah Jika Ingin Mengubah Password
                                    </strong>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="password_baru">Masukan Password Baru : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-eye-slash" id="togglePassword2"></i>
                                                    </div>
                                                </div>
                                                <input type="password"
                                                    class="form-control @error('password_baru') is-invalid @enderror"
                                                    value="{{ $data->password_baru }}" id="password_baru"
                                                    name="password_baru"
                                                    placeholder="kosongkan jika tidak ingin mengubah password">
                                            </div>
                                            <span class="text-danger">
                                                @error('password_baru')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="password_repeat">Ulangi Password Baru : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-secondary">
                                                        <i class="bi bi-eye-slash" id="togglePassword3"></i>
                                                    </div>
                                                </div>
                                                <input type="password"
                                                    class="form-control @error('password_repeat') is-invalid @enderror"
                                                    value="{{ $data->password_repeat }}" id="password_repeat"
                                                    name="password_repeat" placeholder="ulangi seperti password baru">
                                            </div>
                                            <span class="text-danger">
                                                @error('password_repeat')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <div class="mr-2">
                                            <a href="/profile" class="btn btn-warning pe-2 mb-1"><i
                                                    class="bi bi-arrow-90deg-left fs-6 mr-1"></i> <span
                                                    class="bi-text">Kembali</span>
                                            </a>
                                        </div>
                                        <div class="mr-2">
                                            <button type="submit" class="btn btn-primary mb-1 "><i
                                                    class="bi bi-clipboard-plus-fill fs-6 mr-1"></i>
                                                <span class="bi-text">Edit Data</span></button>
                                        </div>
                                        <div class="">
                                            <button type="reset" class="btn btn-secondary"><i
                                                    class="bi bi-arrow-counterclockwise fs-6 mr-1"></i> <span
                                                    class="bi-text">Reset</span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password_lama");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        const togglePassword2 = document.querySelector("#togglePassword2");
        const password2 = document.querySelector("#password_baru");

        togglePassword2.addEventListener("click", function() {
            // toggle the type attribute
            const type = password2.getAttribute("type") === "password" ? "text" : "password";
            password2.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        const togglePassword3 = document.querySelector("#togglePassword3");
        const password3 = document.querySelector("#password_repeat");

        togglePassword3.addEventListener("click", function() {
            // toggle the type attribute
            const type = password3.getAttribute("type") === "password" ? "text" : "password";
            password3.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });
    </script>
    @endforeach
@endsection
