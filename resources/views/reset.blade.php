<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config("app.name") }} </title> 
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/admin/dist/css/adminlte.min.css">
  </head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <img src="/logo.png" alt="GTU Logo" width="100px"><br/>
      <b>GTU</b>DE
        @if(session()->has('status'))
        <div class="callout callout-info alet-dismissable">
            {{ session()->get('status') }}
        </div>
        @endif
        @if(session()->has('email'))
        <div class="callout callout-danger alet-dismissable">
            {{ session()->get('email') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="callout callout-danger alet-dismissable">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>      
        @endif
      </div>
      <div class="card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
        <form action="{{route('password.request')}}" method="post">
          {{csrf_field()}}
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" required name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="/login">Login Instead</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
<!-- /.login-box -->

<script src="assets/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
{{-- <!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script> --}}
</body>
</html>
