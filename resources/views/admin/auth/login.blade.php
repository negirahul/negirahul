<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>Login | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Claim Stack" name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css ') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css ') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app-dark.min.css ') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <div class="content">
            @include('front.sections.navbar')
            <div class="row">
                <div class="col-xl-5">
                    <div class="card light-shadow mx-5 my-5">
                        <div class="card-body">
                            <form action="{{ route('admin.login') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="emailaddress" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" id="emailaddress"
                                        placeholder="Enter your email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Enter your password">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="remember"
                                                    id="checkbox-signin" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="checkbox-signin">Remember
                                                    me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="{{ route('admin.password.request') }}"
                                                class="text-primary float-end">Forgot password?</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid mb-4 text-center">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 text-center">
                    <img src="{{ asset('assets/images/logpgImg.png') }}" class="mt-4" alt="loginImage">
                </div>
            </div>
            @include('front.sections.footer-sm')
        </div>
    </div>
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>
