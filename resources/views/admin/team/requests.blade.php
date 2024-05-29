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
            @if(count($teams))
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h2 class="card-title"><b>Team Registration Requests</b></h2>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>Team ID</th>
                        <th>Leader</th>
                        <th>Project Name</th>
                        <th>Submitted on</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($teams as $team)
                      <tr>
                        <td>#{{$team->id}}</td>
                        <td>{{$team->leader->name}}<br>({{$team->leader->id}})</td>
                        <td>{{$team->title}}</td>
                        <td>{{$team->created_at}}</td>
                        <td>Pending</td>
                        <td><a href="/team/{{$team->id}}" class="btn btn-link">View</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

            @else
            <div class="callout callout-success">
              <h5>Looks Good!</h5>
              <p>No Requests Pending.</p>
              </div>
            @endif
            
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    {{-- /* --------------------------------- Modals --------------------------------- */ --}}

@endsection 
@section("styles")

<style>
 
</style>
@stop
@section('scripts')

<script>
  $(document).ready(function() {
   
});

</script>
@stop