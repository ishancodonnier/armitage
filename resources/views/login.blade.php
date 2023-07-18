<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Armitage Admin | Log in</title>

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('asset/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/dist/css/adminlte.min.css') }}">
    <style>
        .error {
            color: red;
        }

        input.error{
            border-color: red;
        }

        .fade-out {
            opacity: 1;
            transition: opacity 2s ease-in-out;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="width: 361px">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <span class="h1"><b>Armitage Admin</b></span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                @error('email')
                    <div class="row justify-content-center">
                        <label
                            style="border: 1px solid red; padding: 5px; background-color: rgb(250, 218, 218); border-radius: 5px"
                            class="error fade-out font-weight-normal">{{ $message }}</label>
                    </div>
                @enderror

                <form action="{{ route('login') }}" id="login_form" method="post">@csrf
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" name="email" required class="form-control" placeholder="Email"
                            style="width: auto">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" minlength="8" name="password" required class="form-control"
                            placeholder="Password" style="width: auto">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('asset/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/dist/js/adminlte.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#login_form").validate();

            setTimeout(function() {
                $(".fade-out").css("opacity", "0");
                setTimeout(function() {
                        $(".fade-out").css("display", "none");
                    },
                    1000);
            }, 5000);
        });
    </script>
</body>

</html>
