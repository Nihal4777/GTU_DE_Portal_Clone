<?php  
use App\Models\College;
use App\Models\Department;
use App\Models\Discipline;
?>
{{-- <table>
    <tr>
        <td>Eno:</td>
        <td><input type="number" name="eno" value="196170307112"></td>
    </tr>
    <tr>
        <td>Year:</td>
        <td><input type="number" name="year" value="2">   </td>
    </tr>
    <tr>
        <td>Semester:</td>
        <td><input type="text" name="sem" value="4">   </td>
    </tr>
    <tr>
        <td> Gender:</td>
        <td>Male:<input type="radio" name="gender" value="M" required> 
            Female<input type="radio" name="gender" value="F">   </td>
    </tr>

</table> --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config("app.name") }} </title> 
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assets/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/admin/dist/css/adminlte.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="/assets/admin/plugins/select2/css/select2.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box" style="width:60%">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="/logo.png" alt="GTU Logo" width="100px">
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
      <p class="login-box-msg">Student & Guide Registration</p>

      <form method="post">
        {{csrf_field()}}
        <div class="input-group form-group">
          <input type="text" class="form-control" placeholder="Full name" name="name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="input-group col-md-6">
            <input type="number" class="form-control" placeholder="Enrollment Number" name="eno" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-key"></span>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <select required style="width: 100%;" name="sem">
                <option value="-1">Select Semester</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
          </div>
        </div>
          <div class="form-group row">
                <div class="col-sm-12">
                  <select name="college_id" required style="width: 100%;">
                      <option value="-1">Select College</option>
                  <?php
                      foreach(College::all() as $c)
                      {
                          echo "<option value=".$c['id'].">".$c['name']."</option>";
                      }    
                  ?>
                  </select>
                </div>
          </div>
          <div class="row">
              <div class="input-group mb-3  col-sm-12 col-md-6">
                  <select name="department_id" required style="width: 100%">
                      <option value="-1">Select Department</option>
                  <?php
                      foreach(Department::all() as $c)
                      {
                          echo "<option value=".$c['id'].">".$c['name']."</option>";
                      }    
                  ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-sm-12 col-md-6">
                  <select name="discipline_id" required style="width: 100%">
                      <option value="-1">Select Discipline</option>
                  <?php
                      foreach(Discipline::all() as $c)
                      {
                          echo "<option value=".$c['id'].">".$c['name']."</option>";
                      }    
                  ?>
                  </select>
                </div>
          </div>
          <div class="row">
              <div class="input-group mb-3  col-sm-12 col-md-6">
                  <input type="email" name="email" required placeholder="Email" class="form-control">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3 col-sm-12 col-md-6">
                  <input type="tel" name="mobile"  class="form-control" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-phone"></span>
                    </div>
                  </div>
                </div>
          </div>
          <div class="row">
            <div class="input-group mb-3 col-sm-12 col-md-6" style="">
              Gender: 
              
                <input class="mr-1 ml-2" type="radio" name="gender" id="flexRadioDefault1" value="M" required> Male

                <input class="ml-3 mr-1" type="radio" name="gender" id="flexRadioDefault2" value="F"> Female
              </div>
              
              <div class="input-group mb-3 col-sm-12 col-md-6">
                User:
                <input class="mr-1 ml-2" type="radio" name="user" id="flexRadioDefault1" value="S" required> Student

                <input class="ml-3 mr-1" type="radio" name="user" id="flexRadioDefault2" value="G"> Guide
              </div>
        </div>
          <div class="row">
              <div class="input-group mb-3  col-sm-12 col-md-6">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3 col-sm-12 col-md-6">
                  <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" disabled>Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <a href="/login" class="text-center">Already Registered?</a>
      </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="/assets/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/admin/plugins/select2/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
      $('select').select2();
      $('#agreeTerms').change(function(e){
        $('button[type="submit"]')[0].disabled=(this.checked?false:true);
      });
  });
</script>
<style>
    .select2-container {
    width: 100% !important;
    }
    span.select2-selection.select2-selection--single
    {
        border: 1px solid #DADCE0;
    }
    .select2-container--default:focus {
        border-color: #4099ff;
    }
    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
        border-color: transparent transparent #ff2c57 transparent;
    }
    .select2-container--default .select2-search__field:focus {
        border: 1px solid #4099ff;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #4099ff;
    }
    .select2-container--default .select2-selection--multiple {
        padding: 3px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #4099ff;
        border: 1px solid #4099ff;
        padding: 5px 15px;
        color: #fff;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice span {
        color: #ff2c57;
    }
    .select2-container--default .select2-selection--multiple .select2-search__field {
        border: none;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border: 1px solid #4099ff;
    }
    .select2-container--default .select2-selection--single {
        color: #fff;
        height: auto;
    }
    .select2-container--default .select2-selection--single {
        padding: 5px 15px; !important
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 10px;
        right: 15px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-color: #fff transparent transparent transparent;
    }
</style>
</body>
</html>
