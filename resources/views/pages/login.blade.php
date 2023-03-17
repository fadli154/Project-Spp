<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body>
    @include('sweetalert::alert')
    <section class="section ">
        <div class="container mt-4">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="text-dark p-2 pt-3">Silahkan Login</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-7 me-auto text-white text-center position-relative ">
                                    <section>
                                        @include('komponen.svg-1')
                                    </section>
                                </div>
                                <div class="col-5 mt-lg-5">
                                    <form action="/login" method="post">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <label class="text-dark" for="email">Masukkan Email</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                id="email" placeholder="Contoh : example155@gmail.com"
                                                value="{{ old('email') }}" required>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label class="text-dark" for="password">Masukkan Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="password" placeholder="Masukkan Password"
                                                value="{{ old('password') }}" required>
                                        </div>
                                        <button type="submit"
                                            class="btn w-100 rounded-pill mt-4 bg-primary text-white">Log
                                            in <i class="bi bi-box-arrow-in-left fs-5 ms-1"></i></button>
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
