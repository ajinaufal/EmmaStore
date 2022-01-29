@extends("template")

@section('page_title', 'Profile')
@section('meta_desc', 'Profil Pengguna DebiruHouse')
@section('meta_keywords', 'profile')

@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>profile</h2>
                            <ul>
                                <li><a href="index.html">home</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    <!--section start-->
    <section class="login-page section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="theme-card">
                        <h3 class="text-center">Edit Profile Pengguna</h3>
                        @if (session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="theme-form" method="POST" action="/profile">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12 form-group">
                                    <label>email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email" required=""
                                        value="{{ auth()->user()->email }}">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Password Lama</label>
                                    <input type="password" class="form-control" placeholder="Enter your current password"
                                        name="current_password">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Password Baru</label>
                                    <input type="password" class="form-control" placeholder="Enter your new password"
                                        name="new_password">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="firstname">Nama Depan</label>
                                    <input type="text" class="form-control" id="fname" name="firstname"
                                        placeholder="Nama Depan" required="" value="{{ auth()->user()->firstname }}">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="review">Nama Belakang</label>
                                    <input type="text" class="form-control" id="lname" name="lastname"
                                        placeholder="Nama Belakang" required="" value="{{ auth()->user()->lastname }}">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control" placeholder="No. Telepon" name="telephone"
                                        required="" value="{{ auth()->user()->telephone }}">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" placeholder="alamat" name="address"
                                        required="">{{ auth()->user()->address }}</textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Kode Pos</label>
                                    <input type="text" class="form-control" placeholder="Kode Pos" name="postal_code"
                                        required="" value="{{ auth()->user()->postal_code }}">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Kota</label>
                                    <input type="text" id="kota" class="form-control" placeholder="Kota" name="kota"
                                        required="" value="{{ auth()->user()->kota }}">
                                </div>
                                <div class="col-md-12 form-group"><input type="submit" class="btn btn-normal"
                                        value="Update Account" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->
@endsection
