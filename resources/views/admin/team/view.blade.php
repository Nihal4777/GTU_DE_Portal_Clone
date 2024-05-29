@extends('admin.app')


@section('main-content')

<!-- Main content -->
    <div class="content pt-2">
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
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h2 class="card-title"><b>Team #{{$team->id}}</b></h2>
              </div>
              <div class="card-body">
                <div class="row">
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
      </div><!-- /.container-fluid -->
    </div>

    {{-- /* --------------------------------- Modals --------------------------------- */ --}}
<!-- Modal -->
<div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reject Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to reject team?
        <div class="input-group pt-2">
          <div class="input-group-prepend">
            <span class="input-group-text">Remarks</span>
          </div>
          <textarea class="form-control" aria-label="With textarea" name="remarks" form="teamRegistrationAction"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <form action="/teamRegistrationAction" method="post"  id="teamRegistrationAction">
          <input type="hidden" name="teamid" value='{{$team->id}}'>
          {{ csrf_field() }}
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" name="submit" value="0">Reject</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalApprove" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Approve Team</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>  Are you sure you want to approve team?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="submit" value="1" form="teamRegistrationAction">Approve</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endsection 
@section("styles")
<link rel="stylesheet" href="/assets/admin/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="/assets/admin/plugins/select2/css/select2.min.css">
<style>
 
</style>
@stop
@section('scripts')
<script src="/assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/assets/admin/plugins/select2/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
   $('#btnApprove').click((e)=>{
    $('#modalApprove').modal('show');
   });
   $('#btnReject').click((e)=>{
    $('#modalReject').modal('show');
   });
});

</script>
@stop