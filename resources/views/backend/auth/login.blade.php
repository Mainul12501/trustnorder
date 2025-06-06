<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="sm technology, sm technology, sms, school management system, modern school management system">
    <meta name="description" content="SM Technology SMS is a modern school management system.">
    <meta name="robots" content="noindex,nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/') }}backend/assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="{{ asset('/') }}backend/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#233242" stroke-width="2"></path>
            <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#233242" stroke-width="2"></path>
            <path id="teabag" fill="#233242" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
            <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#233242"></path>
            <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#233242" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="
          auth-wrapper
          d-flex
          no-block
          justify-content-center
          align-items-center
        " style="
          background: url({{ asset('/') }}backend/assets/images/background/login-register.jpg)
            no-repeat center center;
          background-size: cover;
        ">
        <div class="auth-box p-4 bg-white rounded">
            <div id="loginform">
                <div class="logo">
                    <h3 class="box-title mb-3">Sign In</h3>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal mt-3 form-material" id="<!--loginform-->" action="{{ route('custom-login') }}" method="post">
                            @csrf

                            <div class="form-inputs">
                                <div class="form-group mb-3">
                                    <div class="">
                                        {{--                                    <input class="form-control" type="text" name="mobile" required="" placeholder="Mobile">--}}
                                        <input class="form-control" type="text" name="mobile" id="tb-rmobile" required="" placeholder="Mobile">
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="">
                                        <input class="form-control" type="password" name="password" required="" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="checkbox checkbox-info pt-0">
                                            <input id="checkbox-signup" type="checkbox" name="remember_me" class="material-inputs chk-col-indigo">
                                            <label for="checkbox-signup"> Remember me </label>
                                        </div>
                                        <input type="hidden" name="user_otp" value="1250">
                                        <div class="ms-auto">
                                            <a href="javascript:void(0)" id="to-recover" class="link font-weight-medium d-flex align-items-center"><i class="ri-lock-line fs-5 me-1"></i> Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-4 mb-3">
                                    <div class="col-xs-12">
{{--                                        <button class=" btn btn-info d-block w-100 waves-effect waves-light send-otp" type="button">--}}
{{--                                            Log In--}}
{{--                                        </button>--}}
                                        <button class="a btn btn-info d-block w-100 waves-effect waves-light" type="submit">
                                            Log In
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="otp-check d-none">
                                <div class="form-group mb-4">
                                    <div class="">
{{--                                        <input class="form-control" type="number" name="user_otp" required="" placeholder="OTP">--}}
                                    </div>
                                </div>
                                <div class="form-group text-center mt-4 mb-3">
                                    <div class="col-xs-12">
                                        <button class=" btn btn-info d-block w-100 waves-effect waves-light" type="submit">
                                            Log In
                                        </button>
                                    </div>
                                </div>
                            </div>

{{--                            <div class="row">--}}
{{--                                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">--}}
{{--                                    <div class="social mb-3">--}}
{{--                                        <a href="javascript:void(0)" class="btn btn-facebook" data-bs-toggle="tooltip" title="Login with Facebook">--}}
{{--                                            <i aria-hidden="true" class="ri-facebook-box-fill fs-4"></i>--}}
{{--                                        </a>--}}
{{--                                        <a href="javascript:void(0)" class="btn btn-googleplus" data-bs-toggle="tooltip" title="Login with Google">--}}
{{--                                            <i aria-hidden="true" class="ri-google-fill fs-4"></i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group mb-0 mt-4">
                                <div class="col-sm-12 justify-content-center d-flex">
                                    <p>
                                        Don't have an account?
                                        <a href="{{ route('custom-register') }}" class="text-info font-weight-medium ms-1">Sign Up</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
{{--            forget password form--}}
            <div id="recoverform">
                <div class="logo">
                    <h3 class="font-weight-medium mb-3">Recover Password</h3>
                    <span class="text-muted">Enter your Mobile Number and instructions will be sent to you!</span>
                </div>
                <div class="row mt-3 form-material">
                    <!-- Form -->
                    <form class="col-12" action="{{ route('reset-password') }}" method="post">
                        @csrf
                       <div id="resetInputForm">
                           <!-- email -->
                           <div class="form-group row">
                               <div class="col-12">
                                   <input class="form-control" type="text" id="resetMobileNumber" required="" name="reset_mobile" placeholder="Mobile">
                               </div>
                           </div>
                           <!-- pwd -->
                           <div class="row mt-3">
                               <div class="col-12">
                                   <button class="btn d-block w-100 btn-primary text-uppercase reset-send-otp" type="button" >
                                       Reset
                                   </button>
                               </div>
                           </div>
                       </div>
                        <div class="otp-check d-none">
                            <div class="form-group mb-4">
                                <div class="">
                                    <input class="form-control" type="number" name="reset_user_otp" required="" placeholder="OTP">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="">
                                    <input class="form-control" type="text" name="new_password" required="" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group text-center mt-4 mb-3">
                                <div class="col-xs-12">
                                    <button class=" btn btn-info d-block w-100 waves-effect waves-light" type="submit">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="{{ asset('/') }}backend/dist/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('/') }}backend/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
{{--Toastr Js--}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $("#to-recover").on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.send-otp', function () {
        event.preventDefault();
        $.ajax({
            url: '{{ route('send-otp') }}',
            type: 'POST',
            data: {
                mobile: $('#tb-rmobile').val()
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('.otp-check').removeClass('d-none');
                    $('.form-inputs').addClass('d-none');
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            }
        })
    })
    $(document).on('click', '.reset-send-otp', function () {
        event.preventDefault();
        $.ajax({
            url: '{{ route('reset-send-otp') }}',
            type: 'POST',
            data: {
                mobile: $('#resetMobileNumber').val()
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('.otp-check').removeClass('d-none');
                    $('#resetInputForm').addClass('d-none');
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            }
        })
    })
</script>
</body>
</html>
