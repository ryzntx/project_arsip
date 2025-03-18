<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    {{-- <meta name="description" content="Spruha -  Admin Panel HTML Dashboard Template">
        <meta name="author" content="Spruko Technologies Private Limited">
        <meta name="keywords"
            content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design"> --}}

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.ico') }}" type="image/x-icon" />

    <!-- Title -->
    <title>Masuk | E-Arsip</title>

    <!-- Bootstrap css-->
    <link id="style" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Icons css-->
    <link href="{{ asset('assets/plugins/web-fonts/icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/web-fonts/plugin.css') }}" rel="stylesheet" />

    <!-- Style css-->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

</head>

<body class="ltr main-body leftmenu error-1">

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- End Loader -->

    <!-- Page -->
    <div class="page main-signin-wrapper">

        <!-- Row -->
        <div class="text-center row signpages">
            <div class="col-md-12">
                <div class="card">
                    <div class="row row-sm">
                        <div
                            class="text-center col-lg-6 col-xl-5 d-none d-lg-flex justify-content-center bg-primary details">
                            <div class="p-2 pt-4 mt-5 pos-absolute">
                                <img src="{{ asset('assets/img/brand/logo-light.png') }}"
                                    class="mb-4 d-lg-none header-brand-img text-start float-start error-logo-light"
                                    alt="logo">
                                <img src="{{ asset('assets/img/brand/logo.png') }}"
                                    class="mb-4 d-lg-none header-brand-img text-start float-start error-logo"
                                    alt="logo">
                                <div class="clearfix"></div>
                                <img src="{{ asset('assets/img/svgs/user.svg') }}" class="mb-0 ht-100" alt="user">
                                <h5 class="mt-4 text-center text-white">Selamat Datang di E-Arsip</h5>
                                <span class="mb-5 text-center tx-white-6 tx-13 mt-xl-0">Sistem Informasi Pengarsipan
                                    Surat</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
                            <div class="main-container container-fluid">
                                <div class="row row-sm">
                                    <div class="mt-2 mb-2 card-body">
                                        <img src="{{ asset('assets/img/brand/logo.png') }}"
                                            class="mb-4 d-lg-none header-brand-img text-start float-start"
                                            alt="logo">
                                        <div class="clearfix"></div>

                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <h5 class="mb-2 text-start">
                                                Masuk ke akun Anda
                                            </h5>
                                            <p class="mb-4 text-muted tx-13 ms-0 text-start">
                                                Silahkan masukkan email dan password Anda
                                            </p>
                                            <div class="form-group text-start">
                                                <label>Email</label>
                                                <input class="form-control" placeholder="Masukan email anda"
                                                    name="email" type="text">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group text-start">
                                                <label>Password</label>
                                                <input class="form-control" placeholder="Masukan password anda"
                                                    name="password" type="password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <button class="btn ripple btn-main-primary btn-block">Masuk</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
    <!-- End Page -->

    <!-- Jquery js-->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Select2 js-->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>

    <!-- Perfect-scrollbar js -->
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ asset('assets/js/themeColors.js') }}"></script>

    <!-- Custom js -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

</html>
