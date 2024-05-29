@extends('admin.app')


@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      {{-- <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Starter Page</li>
        </ol>
      </div><!-- /.col --> --}}
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

@role("Guide")
<div class="content">
  <div class="container-fluid">
    @if ($errors->any())
    <div class="callout callout-danger alet-dismissable">
      <h5>Error!</h5>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>      
    @endif


    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-bags-shopping"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>
              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="fas fa-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </div>
    Dashboard comes here....
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

@endrole



@role("Student")
<!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @if ($errors->any())
        <div class="callout callout-danger alet-dismissable">
          <h5>Error!</h5>
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>      
        @endif
        @if(!$hasTeam)
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">You are not in any team!</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">If you are the team leader, create your team now otherwise ask your team leader to add you. </h6>

                <p class="card-text"></p>
                <a href="{{route('team.create')}}" class="btn btn-primary">Create Team</a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        @else
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h2 class="card-title" style="display: contents;"><b>Team #{{$team->id}}</b>
                  @if($team->status==1)
                  <span class="text-warning  float-right">Approval Pending!</span>
                  @elseif($team->status==3)
                  <span class="text-danger float-right">Rejected!</span>
                  @endif
                </h2>
              </div>
              <div class="card-body">
                <div class="row">
                  @if($team->status==3)
                  <div class="col-12">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-warning">Remarks</span>
                        <span class="info-box-text text-center text-muted">{{$team->remarks}}</span>
                      </div>
                    </div>
                  </div>
                  @endif
                  <div class="col-12 col-sm-5">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Project Name</span>
                        <span class="info-box-number text-center text-muted mb-0">{{$team->title}}</span>
                      </div>
                    </div>
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Team Size</span>
                        <span class="info-box-number text-center text-muted mb-0">{{$team->members->count()+1}}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-7">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Leader Details</span>
                        <span class="info-box-number text-center text-muted mb-0"></span>
                        <table>
                          <tr>
                            <td width="150px">Enrollment No.</td>
                            <td>
                              {{$team->leader->id}}
                            </td>
                          </tr>
                          <tr>
                            <td>Name</td>
                            <td>
                              {{$team->leader->name}}
                            </td>
                          </tr>
                          <tr>
                            <td>Mobile</td>
                            <td>
                              {{$team->leader->mobile}}
                            </td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td>
                              {{$team->leader->email}}
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col">
                      <iframe srcdoc="{{$team->description}}" width="99%" height="225"></iframe>
                  </div>
                </div>
                <h5 class="mt-3">Team Members</h5>
                <table class="table table-striped" id="tableTeamMembers">
                  <thead>
                    <tr>
                      <th>Enrollment Number</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                    </tr>
                  </thead>
                  <tbody id="teamMembers">
                    <tr>
                      <td>{{$team->leader->id}} (Leader)</td>
                      <td>{{$team->leader->name}}</td>
                      <td>{{$team->leader->email}}</td>
                      <td>{{$team->leader->mobile}}</td>
                      </td>
                    </tr>
                    @foreach ($team->members as $member)
                    <tr>
                      <td>{{$member->user->id}}</td>
                      <td>{{$member->user->name}}</td>
                      <td>{{$member->user->email}}</td>
                      <td>{{$member->user->mobile}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @if($team->status==1)
                  <div class="row justify-content-end">
                    <button class="btn btn-primary mx-2 mt-2" id="btnApprove">Approve</button>
                    <button class="btn btn-danger mx-2 mt-2" id="btnReject">Reject</button>
                  </div>
                  @endif
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
        @endif
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content -->
@endrole



@endsection 
