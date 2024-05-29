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
            @if(count($documents))
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h2 class="card-title"><b>Document Aprroval Requests</b></h2>
                </div>
                <div class="card-body">
                  <table class="table" id="approvalsTable">
                    <thead>
                      <tr>
                        <th>Document ID</th>
                        <th>Document Type</th>
                        <th>Project Name</th>
                        <th>Submitted on</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($documents as $document)
                      <tr>
                        <td># {{$document->id}}</td>
                        <td>{{$document->document_type->type}}</td>
                       <td>{{$document->team->title}}</td>
                       <td>{{$document->created_at}}</td>
                      <td><a href="/upload/documents/{{$document->filename}}" target="_blank" class="btn btn-link">View</a></td>
                      <td>
                        <div class="row justify-content-end">
                          <button class="btn btn-primary mx-2 btnApprove" data-docid="{{$document->id}}">Approve</button>
                          <button class="btn btn-danger mx-2 btnReject" data-docid="{{$document->id}}">Reject</button>
                        </div>
                      
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

            @else
            <div class="callout callout-success">
              <h5>Looks Good!</h5>
              <p>No Approvals Pending.</p>
              </div>
            @endif
            
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    {{-- /* --------------------------------- Modals --------------------------------- */ --}}
    <div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reject Document</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to reject this document?
            <div class="input-group pt-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Remarks</span>
              </div>
              <textarea class="form-control" aria-label="With textarea" name="remarks" form="documentsAction"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <form action="/documentsAction" method="post"  id="documentsAction">
              <input type="hidden" name="docid" id="document_id">
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
              <h5 class="modal-title">Approve Document</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>  Are you sure you want to approve this document?</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="submit" value="1" form="documentsAction">Approve</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
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
    $('#approvalsTable').DataTable({
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

    $('.container-fluid').on('click','.btnApprove',(e)=>{
      $('#document_id').val(e.target.dataset.docid);
      $('#modalApprove').modal('show');
   });
   $('.container-fluid').on('click','.btnReject',(e)=>{
    $('#document_id').val(e.target.dataset.docid);
    $('#modalReject').modal('show');
   });
  
});

</script>
@stop