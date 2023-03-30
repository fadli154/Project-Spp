<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body>
    @include('sweetalert::alert')
    <section class="section ">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="logo-sm-brand mb-1">
                    <div class="d-flex justify-content-end col-md-2">
                        <img src="{{ asset('img/logo 11.png') }}" alt="" sizes="10" width="500px">
                        <strong class="name-brand ml-2 sora">E-SPP</strong>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-login card-primary">
                        <div class="card-header ">
                            <div class="mr-2 button-back mt-1">
                                <a href="/">
                                    <i class="bi bi-arrow-left-circle-fill" style="font-size: 25px"></i>
                                </a>
                            </div>
                            <h3 class="text-dark p-2 pt-3 col sora">Silahkan Login</h3>
                            <div class="d-flex justify-content-end col-md-2 ">
                                <img src="{{ asset('img/logo 10.png') }}" class="logo-brand" alt=""
                                    sizes="10">
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-7 col-md-6 me-auto text-white text-center position-relative ">
                                    <section class="svg-login">
                                        @include('komponen.svg-1')
                                    </section>
                                </div>
                                <div class="col-lg-5 col-md-6 mt-5 form-login">
                                    <form action="/login" method="post">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <label class="text-dark" for="email">Masukkan Email : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="bi bi-envelope-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" id="email" placeholder="example155@gmail.com"
                                                    value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label class="text-dark" for="password">Masukkan Password : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="bi bi-lock-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" id="password" placeholder="Masukkan Password"
                                                    value="{{ old('password') }}" required>
                                            </div>
                                        </div>
                                        <button class="button-login w-100 mt-5" type="submit">
                                            Log in
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright © XI RPL
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partials.script')
</body>

</html>
