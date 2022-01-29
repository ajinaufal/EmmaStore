@extends("template")

@section('page_title', 'Forgot Password')
@section('meta_desc', 'Forgot Password DebiruHouse')
@section('meta_keywords', 'Forgot Password')

@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <h2>forgot password</h2>
                            <ul>
                                <li><a href="index.html">home</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">forgot password</a></li>
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
                        <h3 class="text-center">Forgot Password</h3>
                        @if (session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="theme-form" method="POST" action="/doforgotpassword">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12 form-group">
                                    <label>email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email" required=""
                                        value="{{ old('email') }}">
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-12 form-group"><input type="submit" class="btn btn-normal"
                                            value="Submit" />
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
