@extends("template")

@section('page_title', 'Registrasi')
@section('meta_desc', 'Registrasi ke DebiruHouse')
@section('meta_keywords', 'registrasi, pendaftaran, sign up')

@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>register</h2>
                            <ul>
                                <li><a href="index.html">home</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">register</a></li>
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
                        <h3 class="text-center">Pendaftaran</h3>
                        @if (session('errors'))
                            <div style="background-color: #f8d7da !important;border-color: #f5c2c7 !important;"
                                class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="theme-form" method="POST" action="/doregister">
                            @csrf
                            <div class="row g-3">
                                <input type="hidden" name="g-recaptcha-response">
                                <div class="col-md-12 form-group">
                                    <label>email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email" required=""
                                        value="{{ old('email') }}">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Enter your password"
                                        name="password" required="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Enter your confirm password"
                                        name="password_confirmation" required="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="firstname">Nama Depan</label>
                                    <input type="text" class="form-control" id="fname" name="firstname"
                                        placeholder="Nama Depan" required="" value="{{ old('firstname') }}">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="review">Nama Belakang</label>
                                    <input type="text" class="form-control" id="lname" name="lastname"
                                        placeholder="Nama Belakang" required="" value="{{ old('lastname') }}">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control" placeholder="No. Telepon" name="telephone"
                                        required="" value="{{ old('telephone') }}">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" placeholder="alamat" name="address"
                                        required="">{{ old('address') }}</textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Kode Pos</label>
                                    <input type="text" class="form-control" placeholder="Kode Pos" name="postal_code"
                                        required="" value="{{ old('postal_code') }}">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Kota</label>
                                    <input type="text" id="kota" class="form-control" placeholder="Kota" name="kota"
                                        required="" value="{{ old('kota') }}">
                                </div>
                                <div class="col-md-12 form-group">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group"><input type="submit" class="btn btn-normal"
                                        value="create Account" />
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-12 ">
                                        <p>Have you already have an account?</p>
                                        <a href="/login" class="txt-default">click</a> here to &nbsp;<a href="/login"
                                            class="txt-default">Login</a></p>
                                    </div>
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
