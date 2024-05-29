@extends('admin.app')


@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Profile</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                {{-- <h5 class="m-0">You are not in any team!</h5> --}}
               @role("Student") Enrollment: {{$user->id}}
               @else
               #{{$user->id}}
               @endrole
              </div> 
              <form id="quickForm" method="post">
                {{csrf_field()}}
              <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{$user->name}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mobile Number</label>
                    <input type="tel" name="mobile" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile number" value="{{$user->mobile}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" value="M" name="gender" {{$user->gender=='M'?'checked':''}}>
                      <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" value="F" name="gender" {{$user->gender=='F'?'checked':''}}>
                      <label class="form-check-label">Female</label>
                    </div>
                  </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content -->
@endsection 