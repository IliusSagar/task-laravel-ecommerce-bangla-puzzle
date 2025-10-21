<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Login</title>


    <script src="{{ asset('backend/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.2/build/css/intlTelInput.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.2/build/js/intlTelInput.js"></script>

    <style>
        /* CSS for screens between 250px and 400px */
        @media only screen and (min-width: 250px) and (max-width: 380px) {
            .phone {
                width: 243px !important;
            }
        }
    </style>

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <!-- <a href="../../index2.html"><b>SELAI</b> DIDIMONI</a> -->
            <h3>Admin - Login</h3>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <!-- <p class="login-box-msg">LOG IN</p> -->

                <form action="{{route('login')}}" class="mt-5" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" style="width: 280px;">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <span style="color: red;">
                            @error('email')
                            {{$message}}
                            @enderror
                        </span>


                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" id="password-field">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span toggle="#password-field" class="fas fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>




                    </div>

                    <div style="margin-top: -10px;">
                        <span style="color: red;">
                            @error('password')
                            {{$message}}
                            @enderror
                        </span>
                    </div>

                    <div class="mt-3 text-center mb-2">
                        <a href="{{ route('register') }}" class="text-decoration-none text-primary fw-semibold">
                            You have no account? Register now
                        </a>
                    </div>

                    <!-- /.col -->
                    <center>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                    </center>
                    <!-- /.col -->
            </div>
            </form>


            <!-- /.social-auth-links -->


        </div>
        <!-- /.login-card-body -->
    </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->

    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.min.js')}}"></script>




    @if(Session::has('success'))
    <script>
        toastr.success("{{ session("
            success ") }}");
    </script>
    @endif

    @if(Session::has('error'))
    <script>
        toastr.error("{{ session("
            error ") }}");
    </script>
    @endif

    <script>
        $(document).ready(function() {
            var input = document.querySelector("#phone");
            var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
            var errorMsg = document.querySelector("#error-msg");
            var validMsg = document.querySelector("#valid-msg");

            var iti = window.intlTelInput(input, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                geoIpLookup: function(callback) {
                    $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        callback(countryCode);
                    });
                },

                onlyCountries: ['bd'],

            });

            $(validMsg).addClass("hide");

            input.addEventListener('blur', function() {
                reset();
                if (input.value.trim()) {
                    if (iti.isValidNumber()) {
                        validMsg.classList.remove("hide");
                    } else {
                        input.classList.add("error");
                        var errorCode = iti.getValidationError();
                        errorMsg.innerHTML = errorMap[errorCode];
                        errorMsg.classList.remove("hide");
                    }
                }
            });

            function reset() {
                input.classList.remove("error");
                errorMsg.innerHTML = "";
                errorMsg.classList.add("hide");
                validMsg.classList.add("hide");
            }

            $("#phone").val("");
        });
    </script>

    <script>
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>

</body>

</html>