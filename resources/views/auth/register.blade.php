<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | register</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="flex justify-content-end">
        <div class="position-fixed m-2 " id="alerts"
            style="right: 0;top: 0; z-index: 99999; border-radius: 10px;  box-shadow: 3px 3px 6px #0000009e; ">
        </div>
    </div>
    <div class="login-box " style="width: 380px">
        <div class="login-logo">
            <a href="#"><b>Register</b></a>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="login-box-msg">Register in to Admin</p>

                <form action="{{ route('register') }}" autocomplete="off" method="post" autocomplete="off"
                    redirect="{{ url('admin/dashboard') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name">Name</label>
                        <input type="name" class="form-control" name="name" placeholder="Name" value=""
                            autocomplete="off" id="name">
                    </div>
                    <div class="mb-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value=""
                            autocomplete="off" id="email">
                    </div>
                    <div class="mb-4">
                        <label for="phone">Phone Number</label>
                        <input type="phone" class="form-control" name="phone_no" placeholder="phone" value=""
                            autocomplete="off" id="phone">
                    </div>
                    <div class="mb-4">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            autocomplete="new-password" placeholder="Enter Password" value="">
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                            autocomplete="new-password" placeholder="Confirm Password">
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('dist/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/formsubmit.js') }}"></script>
    <script src="{{ asset('admin/common.js') }}"></script>
</body>

</html>
