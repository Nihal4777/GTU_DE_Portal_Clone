@extends('admin.app')
@section('main-content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Timeline</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Timeline</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
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
          <div class="col-md-12">
            <div class="timeline">
            <div class="time-label">
              <span class="bg-red">Till 31 March 2023</span>
            </div>
            <div>
              <i class="fas fa-check bg-green"></i>
              <div class="timeline-item">
                <!-- <span class="time"><i class="fas fa-clock"></i> 12:05</span> -->
                <h3 class="timeline-header text-primary text-bold">Task 1</h3>
                <div class="timeline-body">
                  Registration for Team/Guide/DE Coordinator
                </div>
                <div class="timeline-footer">
                </div>
              </div>
            </div>
            @foreach ($tasks as $task)
              <div class="time-label">
                <span class="bg-red">Till {{date_format(date_create($task->deadline),"j'S F o")}}</span>
              </div>
              <div>
                <i class="fas {{array_key_exists($task->id,$success_documents_tasks)?(count($success_documents_tasks[$task->id])==count($task->documents)?'fa-check bg-green':'fa-exclamation bg-yellow'):'fa-exclamation bg-yellow'}}"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header text-primary text-bold">Task {{$task->id}}</h3>
                    <div class="timeline-body">
                      {{$task->desc}}
                    </div>
                    <div class="timeline-footer">
                      @if (array_key_exists($task->id,$documents_tasks))
                       @foreach ($documents_tasks[$task->id] as $dt)
                          <p class="border p-2 border-{{$dt->status==1?'warning':($dt->status==2?'success':'danger')}}"><a href="/upload/documents/{{$dt->filename}}">{{$dt->filename}}</a></p>
                        @endforeach
                      @endif
                      <form action="{{route('uploadCanvas')}}" class="uploadForm" enctype="multipart/form-data" method="POST">
                        @foreach ($task->documents as $doc)
                          @if (!(isset($array[$doc->id]) && ($array[$doc->id]==2 || $array[$doc->id]==1)))
                            <div class="form-group {{(isset($array[$doc->id]) && ($array[$doc->id]==2 || $array[$doc->id]==1))?'d-none':''}}">
                              <div class="custom-file  ">
                                <input type="file" class="custom-file-input" required data-label="Upload Empathy Canvas" name="doc[{{$doc->id}}]" accept="image/*, application/pdf">
                                <label class="custom-file-label" for="customFile">Upload {{$doc->type}}</label>
                                  <div class="invalid-feedback">{{$doc->type}} is required</div>
                              </div>
                            </div>
                          @endif
                            @endforeach
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                  </div>
              </div>  
            @endforeach
              <div id="certDiv">
                <i class="fas fa-trophy bg-orange"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection 

@section('scripts')
<script>
  $(document).ready(function() {
   $('.uploadForm button[type="submit"]').click(function(e)
   {
    $(this).parent().addClass('was-validated');
   });
   $('.uploadForm input[type="file"]').change(function(e)
   {
        $(this).next().text(this.files.length?this.files[0].name:this.getAttribute('data-label'));
   });
   if($('div.timeline-body').length==$('i.fa-check').length)
   {
      $('i.fa-trophy').css('top','15px');
      $('#certDiv').append(`<div class="timeline-item">
                <p class="timeline-header text-primary">Congrats! You can now<a class='btn btn-link text-primary' href="/download_certificate" target="_blank">Dowload Certificate</a></p>
              </div>`);
   }
});
</script>
@stop
