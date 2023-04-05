<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Spp</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo 13.png') }}">

    <!-- Favicons -->
    <link href="images/favicon.png" rel="icon">
    <link href="images/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- owl carousel css -->
    <link rel="stylesheet" href="{{ asset('assets/modules/starterpage/css/owl.carousel.min.css') }}">
    <!-- font awesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets/modules/starterpage/css/bootstrap.min.css') }}">

    {{-- aos animation --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Montserrat&family=Oswald&family=Sora&display=swap"
        rel="stylesheet">

    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/modules/starterpage/css/style.css') }}">
</head>

<body>

    <!-- Preloader Start -->
    <div class="preloader">
        <span></span>
    </div>
    <!-- Preloader End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <!-- <a class="navbar-brand d-block d-sm-none" href="#">Yordan App</a> -->
            <a class="navbar-brand d-lg-none me-5 mb-2" href="#">
                <img src="{{ asset('img/logo 10.png') }}" height="25" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-light"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" data-scroll-nav="0" aria-current="page" href="#"><i
                                class="fas fa-home me-2"></i>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll-nav="1" href="#tentang"><i
                                class="bi bi-book-half me-2"></i>Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll-nav="3" href="#tutorial"><i
                                class="bi bi-gear-fill me-2"></i>Tutorial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll-nav="4" href="#map"><i
                                class="bi bi-geo-alt-fill me-2"></i>Lokasi</a>
                    </li>
                </ul>
                @guest
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/login" class="btn btn-1" type="button"> Login <i
                                class="fas fa-sign-in-alt ms-2"></i></a>
                    </div>
                @else
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start me-2 -2">
                        <a href="/dashboard" class="btn btn-1" type="button"> Dahboard</a>
                    </div>
                    <form action="/logout" method="post" class="d-grid gap-2 d-md-flex justify-content-md-start">
                        @csrf
                        <button type="submit" class="btn btn-logout">Log out <i class="fas fa-sign-out-alt"></i></button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Section Start -->
    <section class="hero d-flex align-items-center" id="hero" data-scroll-index="0">
        <div class="effect-wrap">
            <i class="fas fa-plus effect effect-1"></i>
            <i class="fas fa-plus effect effect-2"></i>
            <i class="fas fa-circle-notch effect effect-3"></i>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 text-center order-lg-last">
                    <div class="hero-img" data-aos="fade-up-left" data-aos-duration="2000">
                        <img src="{{ asset('assets/modules/starterpage/images/hero-img.png') }}" alt="hero image">
                    </div>
                </div>
                <div class="col-md-7 order-lg-first">
                    <div class="hero-text" data-aos="fade-up" data-aos-duration="3000">
                        <img class="d-none d-lg-block " src="{{ asset('img/logo 10.png') }}" height="80"
                            alt="">
                        <h1 class="lilita">Aplikasi Pembayaran SPP</h1>
                        <p class="text-capitalize sora">Lihat riwayat pembayaran dan lakukan pembayaran SPP Anda pada
                            website
                            kami</p>
                        <a class="btn-get mt-2 " type="button" href="/dashboard">
                            <div class="i-wrapper-1">
                                <div class="i-wrapper">
                                    <i class="fas fa-plane"></i>
                                </div>
                            </div>
                            <span>Started</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Socmed Section Start -->
    <section class="socmed">
        <div class="container d-flex justify-content-center">
            <ul>
                <a href="/facebook.com">
                    <li style="--i:#2808dd;--j:#4461e2;">
                        <span class="icon"><i class="bi bi-facebook"></i></span>
                        <span class="text-icon">facebook</span>
                    </li>
                </a>
                <a href="https://github.com/fadli154" target="_blank">
                    <li style="--i:#373738;--j:#787879;">
                        <span class="icon"><i class="bi bi-github"></i></span>
                        <span class="text-icon">github</span>
                    </li>
                </a>
                <a href="">
                    <li style="--i:#e44acf;--j:#a72ab8;">
                        <span class="icon"><i class="bi bi-instagram"></i></span>
                        <span class="text-icon">instagram</span>
                    </li>
                </a>
            </ul>
        </div>
    </section>
    <!-- Socmed Section End -->

    <!-- Tentang Section Start -->
    <section class="tentang section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title" data-aos="zoom-in" data-aos-duration="2000">
                        <h2>Tentang <span>Kami</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Tentang Section End -->

    <!-- About Section Start -->
    <section class="about section-padding" id="tentang" data-scroll-index="1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-5 d-flex align-items-center justify-content-center">
                    <div class="about-img" data-aos="fade-right" data-aos-duration="2000">
                        <img src="{{ asset('assets/modules/starterpage/images/about.png') }}" alt="fun facts">
                    </div>
                </div>
                <div class="col-lg-6 col-md-7">
                    <div class="section-title">
                        <h2>E- <span>SPP</span></h2>
                    </div>
                    <div class="about-text">
                        <p>sebuah aplikasi untuk mempermudah sebuah sekolah dalam mendata pembayaran SPP para
                            siswa/siswinya, dengan menggunakan aplikasi ini tentunya akan lebih mengurangi biaya dalam
                            pendataan pembayaran SPP, dan mengurangi penggunaan kertas yang dimana pohon adalah GO GREEN
                            bagi kehidupan manusia. </p>
                        <div class="row">
                            <div class="main">
                                <div class="up">
                                    <button class="card1 card-level"
                                        style="--i:rgb(243, 192, 179);--j: rgb(172, 4, 4);">
                                        <i class="fa fa-user-graduate"></i>
                                        <span class="text-level">Siswa</span>
                                    </button>
                                    <button class="card2 card-level"
                                        style="--i:rgb(104, 193, 228);--j:rgb(73, 76, 248);">
                                        <i class="fa fa-user-tie"></i>
                                        <span class="text-level">Petugas</span>
                                    </button>
                                </div>
                                <div class="down">
                                    <button class="card3 card-level"
                                        style="--i:rgb(150, 240, 32);--j: rgb(212, 206, 123);">
                                        <i class="fa fa-credit-card"></i>
                                        <span class="text-level">Tagihan</span>
                                    </button>
                                    <button class="card4 card-level"
                                        style="--i:rgb(32, 240, 178);--j: rgb(28, 182, 28);">
                                        <i class="fa fa-wallet"></i>
                                        <span class="text-level">Pembayaran</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    @guest
        <!-- Level Section Start -->
        <section class="level section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title">
                            <h2>Multilevel <span style="color: #5754fe">Role</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="level-item" data-aos="fade-up" data-aos-duration="1000">
                            <i class="fas fa-user-tie"></i>
                            <h3>Administrator</h3>
                            <p>Memiliki semua fitur dalam aplikasi</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="level-item" data-aos="fade-up" data-aos-duration="1000">
                            <i class="fas fa-user-plus"></i>
                            <h3>Petugas</h3>
                            <p>Memiliki sedikit fitur dalam aplikasi</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="level-item" data-aos="fade-up" data-aos-duration="1000">
                            <i class="fas fa-user-check"></i>
                            <h3>Wali Murid</h3>
                            <p>Sebagai wali dari siswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Level Section End -->
    @endguest

    @guest
        <!-- How It Works Section Start -->
        <section class="how-it-works section-padding" id="tutorial" data-scroll-index="3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title mt-5">
                            <h2>Cara <span>Memakai Aplikasi</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="how-it-works-item line-right">
                            <div class="step">1</div>
                            <h3>Login</h3>
                            <p>Lakukan Login terlebih dahulu, pencet tombol Login/Get Started</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="how-it-works-item ">
                            <div class="step">2</div>
                            <h3>Selesai</h3>
                            <p>Ikuti cara pemakaian sesuai dengan akses</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- How It Works Section End -->
    @endguest

    @auth
        @can('administrator')
            <!-- How It Works Section Start -->
            <section class="how-it-works section-padding" id="tutorial" data-scroll-index="3">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="section-title mt-5">
                                <h2>Cara <span>Memakai Aplikasi</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-6">
                            <div class="how-it-works-item line-right">
                                <div class="step">1</div>
                                <h3>Buka Apa saja</h3>
                                <p>Administrator memiliki semua akses fitur</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="how-it-works-item ">
                                <div class="step">2</div>
                                <h3>Selesai</h3>
                                <p>Ikuti semua aturan yang berlaku, selaku administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- How It Works Section End -->
        @endcan
        @can('petugas')
            <!-- How It Works Section Start -->
            <section class="how-it-works section-padding" id="tutorial" data-scroll-index="3">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="section-title mt-5">
                                <h2>Cara <span>Memakai Aplikasi</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-6">
                            <div class="how-it-works-item line-right">
                                <div class="step">1</div>
                                <h3>Buka Transaksi Pembayaran</h3>
                                <p>Lakukan Entri pembayaran</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="how-it-works-item ">
                                <div class="step">2</div>
                                <h3>Selesai</h3>
                                <p>Ikuti semua aturan yang berlaku, selaku petugas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- How It Works Section End -->
        @endcan
        @can('wali')
            <!-- How It Works Section Start -->
            <section class="how-it-works section-padding" id="tutorial" data-scroll-index="3">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="section-title mt-5">
                                <h2>Cara <span>Memakai Aplikasi</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="how-it-works-item line-right">
                                <div class="step">1</div>
                                <h3>Buka data siswa</h3>
                                <p>Lihat tagihan dengan tombol aksi DETAIL</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="how-it-works-item line-right">
                                <div class="step">2</div>
                                <h3>Buka Pembayaran</h3>
                                <p>Isi semua input yang di butuhkan</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="how-it-works-item line-right">
                                <div class="step">3</div>
                                <h3>Kirim</h3>
                                <p>Tunggu hingga petugas/administrator Mengkonfirmasi</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="how-it-works-item">
                                <div class="step">4</div>
                                <h3>Selesai</h3>
                                <p>Jika sudah selesai maka status pembayaran akan berubah menjadi hijau</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- How It Works Section End -->
        @endcan
    @endauth

    <!-- Map Section Start -->
    <section class="map section-padding " id="map" data-scroll-index="4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title" id="report">
                        <h2>Lokasi <span>Kami</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5768925963066!2d106.63556391455468!3d-6.187333395520691!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f929162547c7%3A0xbbf35137362e584d!2sSMK%20Negeri%204%20Kota%20Tangerang!5e0!3m2!1sid!2sid!4v1677921080826!5m2!1sid!2sid"
                        width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- Map Section End -->

    <!-- Footer Start -->
    <footer class="footer">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-col">
                            <h3>about us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-col">
                            <h3>company</h3>
                            <ul>
                                <li><a href="#">privacy policy</a></li>
                                <li><a href="#">terms & condition</a></li>
                                <li><a href="#">latest blog</a></li>
                                <li><a href="#">app services</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-col">
                            <h3>quick links</h3>
                            <ul>
                                <li><a href="#hero">home</a></li>
                                <li><a href="#tentang">tentang</a></li>
                                <li><a href="#map">map</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-col">
                            <h3>social pages</h3>
                            <ul>
                                <li><a href="#">facebook</a></li>
                                <li><a href="#">twitter</a></li>
                                <li><a href="#">instagram</a></li>
                                <li><a href="#">github</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="copyright-text">&copy;2023 XI RPL</p>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    <!-- Footer End -->

    {{-- aos script --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- jquery js -->
    <script src="{{ asset('assets/modules/starterpage/js/jquery.min.js') }}"></script>
    <!-- owl carousel js -->
    <script src="{{ asset('assets/modules/starterpage/ js/owl.carousel.min.js') }}"></script>
    <!-- bootstrap bundle with popper -->
    <script src="{{ asset('assets/modules/starterpage/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ScrollIt js -->
    <script src="{{ asset('assets/modules/starterpage/js/scrollIt.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/modules/starterpage/js/main.js') }}"></script>
</body>

</html>
