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
    @if(session()->has('success'))
    <div class="callout callout-success alet-dismissable">
      <h5>Success!</h5>
        {{ session()->get('success') }}
    </div>
    @endif
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h2 class="card-title"><b>Team Registration Requests</b></h2>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover" id="teamsTable">
                  <thead>
                    <tr>
                      <th>Team ID</th>
                      <th>Leader</th>
                      <th>Project Name</th>
                      <th>Submitted on</th>
                      <th>Status</th>
                      <th> </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($teams as $team)
                    <tr>
                      <td>#{{$team->id}}</td>
                      <td>{{$team->leader->name}}<br>({{$team->leader->id}})</td>
                      <td>{{$team->title}}</td>
                      <td>{{$team->created_at}}</td>
                      <td>Approved</td>
                      <td><a href="/team/{{$team->id}}" class="btn btn-link">View</a></td>
                    </tr>
                   @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    {{-- /* --------------------------------- Modals --------------------------------- */ --}}

@endsection 
@section("styles")
<link rel="stylesheet" href="/assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
{{-- <link rel="stylesheet" href="/assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> --}}
<style>
 
</style>
@stop
@section('scripts')
<script src="/assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
    $('#teamsTable').DataTable({
      columnDefs: [
    { orderable: false, targets: 5 },
    { orderable: false, targets: 4 }
  ],
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
});

</script>
@stop