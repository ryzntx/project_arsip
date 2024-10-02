@extends('layout.index')
@section('title', 'Edit profil')

@section('content')
<div class="main-content side-content pt-0">

    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Profile</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
                          <i class="fe fe-download me-2"></i> Import
                        </button>
                        <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
                          <i class="fe fe-filter me-2"></i> Filter
                        </button>
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                          <i class="fe fe-download-cloud me-2"></i> Download Report
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <div class="row square">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="panel profile-cover" style="position: relative;">
                                <div class="profile-cover__img" style="position: absolute; bottom: -50px; left: 20px;">
                                    <img src="../assets/img/users/1.jpg" alt="Profile picture of Sonia Taylor" style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover; border: 3px solid white;" />
                                    <h3 class="h3" style="margin-top: 10px; font-weight: bold;">Sonia Taylor</h3>
                                </div>
                                <div class="profile-cover__action bg-img" style="height: 200px; background-color: #d1e0ff;">
                                    <!-- Background atau konten tambahan bisa diisi di sini -->
                                </div>
                            </div>
                            <div class="profile-tab tab-menu-heading" style="margin-top: 100px;">
                                <nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#about">About</a>
                                    <a class="nav-link" data-bs-toggle="tab" href="#settings">Account Settings</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card main-content-body-profile">
                        <div class="tab-content">
                            <div class="main-content-body tab-pane p-4 border-top-0 active" id="about">
                                <div class="card-body p-0 border p-0 rounded-10">
                                    <div class="p-4">
                                        <h4 class="tx-15 text-uppercase mb-3">BIOdata</h4>
                                        <p class="m-b-5">Hai User admin, ini merupakan Sistem Informasi E-Arsip Dokumen berbasis web khusus untuk Perusahaan Software House PT Pratama Solusi Teknologi

                                        </p>

                                    </div>
                                    <div class="border-top"></div>
                                    <div class="p-4">
                                        <label class="main-content-label tx-13 mg-b-20">Contact</label>
                                        <div class="d-sm-flex">
                                            <div class="mg-sm-r-20 mg-b-10">
                                                <div class="main-profile-contact-list">
                                                    <div class="media">
                                                        <div class="media-icon bg-primary-transparent text-primary"> <i class="icon ion-md-phone-portrait"></i> </div>
                                                        <div class="media-body"> <span>Mobile</span>
                                                            <div> +245 354 654 </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mg-sm-r-20 mg-b-10">
                                                <div class="main-profile-contact-list">
                                                    <div class="media">
                                                        <div class="media-icon bg-success-transparent text-success"> <i class="icon ion-logo-slack"></i> </div>
                                                        <div class="media-body"> <span>Slack</span>
                                                            <div> @spruko.w </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="main-profile-contact-list">
                                                    <div class="media">
                                                        <div class="media-icon bg-info-transparent text-info"> <i class="icon ion-md-locate"></i> </div>
                                                        <div class="media-body"> <span>Current Address</span>
                                                            <div> San Francisco, CA </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top"></div>
                                    <div class="p-3 p-sm-4">
                                        <label class="main-content-label tx-13 mg-b-20">Social</label>
                                        <div class="d-xl-flex">
                                            <div class="mg-md-r-20 mg-b-10">
                                                <div class="main-profile-social-list">
                                                    <div class="media">
                                                        <div class="media-icon bg-primary-transparent text-primary"> <i class="icon ion-logo-github"></i> </div>
                                                        <div class="media-body"> <span>Github</span> <a href="">github.com/spruko</a> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mg-md-r-20 mg-b-10">
                                                <div class="main-profile-social-list">
                                                    <div class="media">
                                                        <div class="media-icon bg-success-transparent text-success"> <i class="icon ion-logo-twitter"></i> </div>
                                                        <div class="media-body"> <span>Twitter</span> <a href="">twitter.com/spruko.me</a> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mg-md-r-20 mg-b-10">
                                                <div class="main-profile-social-list">
                                                    <div class="media">
                                                        <div class="media-icon bg-info-transparent text-info"> <i class="icon ion-logo-linkedin"></i> </div>
                                                        <div class="media-body"> <span>Linkedin</span> <a href="">linkedin.com/in/spruko</a> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mg-md-r-20 mg-b-10">
                                                <div class="main-profile-social-list">
                                                    <div class="media">
                                                        <div class="media-icon bg-danger-transparent text-danger"> <i class="icon ion-md-link"></i> </div>
                                                        <div class="media-body"> <span>My Portfolio</span> <a href="">spruko.com/</a> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="main-content-body tab-pane p-4 border-top-0" id="settings">
                                <div class="card-body border" data-select2-id="12">
                                    <form class="form-horizontal" data-select2-id="11">
                                        <div class="mb-4 main-content-label">Akun</div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Username</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="User Name" value="Sonia Taylor"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Email</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Email" value="info@SoniaTaylor.in"> </div>
                                            </div>
                                        </div>



                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3 col">
                                                    <label class="form-label">Verifikasi</label>
                                                </div>
                                                <div class="col-md-9 col">
                                                    <label class="ckbox mg-b-10">
                                                        <input type="checkbox"><span>Email</span></label>
                                                    <label class="ckbox mg-b-10">
                                                        <input checked="" type="checkbox"><span>SMS</span></label>
                                                    <label class="ckbox mg-b-10">
                                                        <input type="checkbox"><span>Telepon</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-2"> </div>
                                                <div class="col-md-50"> <a class="mg-r-2"><a class="" href="/profile/edit/ubahPassword">Ubah Password</a> </div>
                                            </div>
                                        </div>
                                    </form>


                                    <!-- Modal Ubah Password -->
<div class="modal fade" id="ubahPasswordModal" tabindex="-1" aria-labelledby="ubahPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahPasswordModalLabel">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Ubah Password -->
                <form action="{{ route('profile.updatePassword') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Password Saat Ini -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-control" placeholder="Password Saat Ini" required>
                    </div>

                    <!-- Password Baru -->
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Password Baru" required>
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
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
    </div>
</div>
@endsection



{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
