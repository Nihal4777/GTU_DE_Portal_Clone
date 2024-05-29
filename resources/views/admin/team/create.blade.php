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
                <h2 class="card-title"><b>Register Team</b></h2>
              </div>
              <form id="quickForm" method="post" action='{{ route('team.store') }}'>
                {{csrf_field()}}
                <!-- form start -->
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"><span style="font-size: 1.2rem">Project Title</span></label>
                    <div class="col-sm-10" style="
                    padding-top: 0.5rem;">
                      <input type="text" class="form-control" name="title" id="inputEmail3" placeholder="Enter project title">
                    </div>
                  </div>
                    <textarea id="summernote" rows="10" name="projectDesc">
                      Place <em>some</em> <u>text</u> <strong>here</strong>
                    </textarea>

                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Internal Guide(s)</label>
                      <div class="col-sm-10">
                        <select class="select2" id="internalGuides" multiple="multiple" data-placeholder="Select Internal Guide(s)" name="guides[]" style="width: 100%;">
                          <?php 
                            foreach ($guides as $guide ) {
                              echo "<option value='".$guide->id."'>".$guide->name."</option>";
                            }
                            ?>

                        </select>
                      </div>
                    </div>


                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Add Team Members</h3>
                      </div>
                      <div class="card-body">
                        <!-- Date -->
                        <div class="form-group">

                          <label>Enrollment No.:</label>
                          <div class="row">
                            <div class="col-md-10 col-sm-8 mb-2">
                              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="number" class="form-control datetimepicker-input" data-target="#reservationdate" id="addMemberId">
                              </div>
                            </div>
                            <div class="col-md-2 col-sm-4">
                              <button class="btn btn-info btn-flat" id="searchByEnroll">
                                <div class="" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <i class="fa fa-search"> Search </i>
                                </div>
                              </button>
                            </div>
                          </div>
                           
                        </div>
                            <table class="table table-striped" id="tableTeamMembers" style="display:none;">
                              <thead>
                                <tr>
                                  <th>Enrollment Number</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                </tr>
                              </thead>
                              <tbody id="teamMembers">

                              </tbody>
                            </table>
                        <!-- /.form group -->
                      </div>
                        <div class="card-footer">
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit Request</button>
                    {{-- <button type="submit" class="btn btn-default float-right">Cancel</button> --}}
                  </div>
                  <!-- /.card-footer -->
                </form>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    {{-- /* --------------------------------- Modals --------------------------------- */ --}}
    <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Confirm Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!-- form start -->
              <div class="form-group row">
                <label  class="col-sm-2 ">Enrollment Number: </label>
                <div class="col-sm-10">
                 <span id="addConfirmId"></span>
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 ">Name: </label>
                <div class="col-sm-10">
                 <span id="addConfirmName"></span>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 ">Email: </label>
                <div class="col-sm-10">
                  <span id="addConfirmEmail"></span>
                </div>
              </div>
                <!-- /.card-body -->
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Go back</button>
            <button type="button" class="btn btn-primary" id="addConfirmadd">Add</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection 
@section("styles")
<link rel="stylesheet" href="/assets/admin/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="/assets/admin/plugins/select2/css/select2.min.css">
<style>
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice{
  color: black;
}

</style>
@stop
@section('scripts')
<script src="/assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/assets/admin/plugins/select2/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('#internalGuides').select2();
});


  $(function () {
    // Summernote
    $('#summernote').summernote({height: 300})

    // CodeMirror
  //   CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
  //     mode: "htmlmixed",
  //     theme: "monokai"
  //   });
  });
  var response={};
  $('#searchByEnroll').click(function(e){
    e.preventDefault();
    if($('#addMemberId').val()=={{$user->id}})
    {
      $(document).Toasts('create', {
              class: 'bg-info',
              title: 'Add Member',
              // subtitle: 'Subtitle',
              body: 'No need to add yourself'
          });
        this.innerHTML='<div class=""><i class="fa fa-search"> Search </i>';
        return;
    }
    if($(`.memberIds[value='${$('#addMemberId').val()}']`).length) 
    {
      $(document).Toasts('create', {
            class: 'bg-info',
            title: 'Add Member',
            // subtitle: 'Subtitle',
            body: 'Member already added'
        });
      this.innerHTML='<div class=""><i class="fa fa-search"> Search </i>';
      return;
    }
    this.innerHTML='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait...';
    $.ajax({
      method:'post',
      url:'{{route("team.fetch")}}',
      data:{id:$('#addMemberId').val(),_token:'{{csrf_token()}}'},
      success:(res)=>{
        this.innerHTML='<div class=""><i class="fa fa-search"> Search </i>';
        if(!res.success)
        {
          $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Add Member',
            // subtitle: 'Subtitle',
            autohide: true,
            body: 'Invalid Enrollment Number'
          });
          return ;
        }
        response=res;
        $('#modal-lg').modal('show');
        $('#addConfirmId').text(response.id);
        $('#addConfirmName').text(response.name);
        $('#addConfirmEmail').text(response.email);
      }
    });
  });
  $('#addConfirmadd').click(function(e){
      if(!$("#teamMembers").children().length)
        $('#tableTeamMembers').show();
      $('#teamMembers').append(`<tr><td>${response.id}<input type='hidden' name='memberId[]' class="memberIds" value='${response.id}'/></td><td>${response.name}<input type='hidden' name='memberName[]' value="${response.name}"/></td><td>${response.email}<input type='hidden' name='memberEmail[]' value="${response.email}"/></td><td><button type="button" class="btn btn-link removeMember">Remove</button></td></tr>`);
      $('#modal-lg').modal('hide');
      $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Add Member',
            // subtitle: 'Subtitle',
            autohide: true,
            body: 'Member added'
          });
          $('#addMemberId').val('')
    });
  $('#teamMembers').on('click','.removeMember',function(e){
    $(this).parent().parent().remove();
    $(document).Toasts('create', {
            class: 'bg-warning',
            title: 'Add Member',
            // subtitle: 'Subtitle',
            autohide: true,
            body: 'Member Removed'
          });
          $('#addMemberId').val('')
    if(!$("#teamMembers").children().length)
        $('#tableTeamMembers').hide();
  });

  // $('#quickForm').validate({
  //   rules: {
  //     email: {
  //       required: true,
  //       num: true,
  //     },
      // password: {
      //   required: true,
      //   minlength: 5
      // },
      // terms: {
      //   required: true
      // },
    // },
    // messages: {
    //   email: {
    //     required: "Please enter a email address",
    //     email: "Please enter a valid email address"
    //   },
      // password: {
      //   required: "Please provide a password",
      //   minlength: "Your password must be at least 5 characters long"
      // },
      // terms: "Please accept our terms"
  //   },
  //   errorElement: 'span',
  //   errorPlacement: function (error, element) {
  //     error.addClass('invalid-feedback');
  //     element.closest('.form-group').append(error);
  //   },
  //   highlight: function (element, errorClass, validClass) {
  //     $(element).addClass('is-invalid');
  //   },
  //   unhighlight: function (element, errorClass, validClass) {
  //     $(element).removeClass('is-invalid');
  //   }
  // });


</script>
@stop