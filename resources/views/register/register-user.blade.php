@extends('layouts.master2')
@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}"
          rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">

            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"><a href="{{ url('/' . $page='index') }}"><img
                                                src="{{URL::asset('assets/img/brand/favicon.png')}}"
                                                class="sign-favicon ht-40" alt="logo"></a>
                                        <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1></div>
                                    <div class="main-signup-header">
                                        <h4 style="color: red">تَنبَّه ... يجب تسجيل الدخول بعد انشاء الايميل</h4>
                                        <h2 class="text-primary">انشاء ايميل مستخدم جديد</h2>
                                        <form method="POST" action="{{ route('signup.store') }}">
                                            @csrf

                                            <div class="row mb-3">
                                                <label for="name"
                                                       class="col-md-4 col-form-label text-md-end">{{ __('الاسم') }}</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text"
                                                           class="form-control @error('name') is-invalid @enderror"
                                                           name="name" value="{{ old('name') }}" required
                                                           autocomplete="name" autofocus>

                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email"
                                                       class="col-md-4 col-form-label text-md-end">{{ __('البريد الالكتروني') }}</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email"
                                                           class="form-control @error('email') is-invalid @enderror"
                                                           name="email" value="{{ old('email') }}" required
                                                           autocomplete="email">

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="row mb-3">
                                                <label for="password"
                                                       class="col-md-4 col-form-label text-md-end">{{ __('كلمة المرور') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           name="password" required autocomplete="new-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="password-confirm"
                                                       class="col-md-4 col-form-label text-md-end">{{ __('تاكيد كلمة المرور') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control"
                                                           name="password_confirmation" required
                                                           autocomplete="new-password">
                                                </div>
                                            </div>

                                            <div class="row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('انشاء الايميل') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->


            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{URL::asset('assets/img/media/login.png')}}"
                             class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
        </div>
    </div>
@endsection
@section('js')
@endsection
