@extends("template")

@section('page_title', 'Masuk')
@section('meta_desc', 'Masuk ke DebiruHouse')
@section('meta_keywords', 'masuk, login, sign in')

@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>login</h2>
                            <ul>
                                <li><a href="index.html">home</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">login</a></li>
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
                <div class="col-xl-4 col-lg-6 col-md-8 offset-xl-4 offset-lg-3 offset-md-2">
                    <div class="theme-card">
                        <h3 class="text-center">Login</h3>
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
                        <form class="theme-form" method="post" action="/dologin">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Email" name="email" required="">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Enter your password"
                                    name="password" required="">
                            </div>
                            <input type="submit" class="btn btn-normal" value="Login" />
                            <a class="float-end txt-default mt-2" href="/forgotpassword">Forgot your password?</a>
                        </form>
                        <p class="mt-3">Sign up for a free account at our store. Registration is quick and easy.
                            It allows you to be able to order from our shop. To start shopping click register.</p>
                        <a href="/register" class="txt-default pt-3 d-block">Create an Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->

@endsection
