@extends('club.index')
@section('content')

<section class="content-header">
  <h1>
    {{$title}}
    {{-- <small>Control panel</small> --}}
  </h1>
  {{--<ol class="breadcrumb">
    <li><a href="{{ url('/') }}club/"{{$club->id}}><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">{{ $title }}</li>
  </ol>--}}
</section>

<div class="box">
  <div class="box-header">
    {{-- <h3 class="box-title">{{ $title }}</h3> --}}
    <button id="pdf">get pdf</button>
  </div>
    <!--box-header-->
  <div class="box-body">
      <div class="table-responsive">

          {!! Form::open(['id' => 'form_data', 'url' => aurl('palyersControl/destroy/all')]) !!}
          {!! Form::hidden('_method', 'delete') !!}
          {!! $dataTable->table(['class' => 'dataTable table text-center table-striped table-hover table-bordered '],true) !!}
          {!! Form::close()  !!}
      </div>
  </div>
  <!-- box-body -->
</div>
  <!-- box -->
  <!------------------->
  <div class="modal fade" id="multipleDelete" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">{!! trans('admin.modelDeleteTitle') !!}</h4>
              </div>
              <div class="modal-body" style="color:#fff;background:#dd4b39;">

                <div class="emptyRecord hidden">
                  <h3>{!! trans('admin.please_check_some_records') !!} </h3>
                </div>
                <div class="notEmptyRecord hidden">
                  <h3>
                    {!! trans('admin.ask_delete_item') !!} 
                    <span class="record_count"></span> 
                    {!! trans('admin.questionMark') !!}
                  </h3>
                </div>
                
              </div>
              <div class="modal-footer">
                <div class="emptyRecord hidden">
                  <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
                </div>
                 <div class="notEmptyRecord hidden">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.no') }}</button>
                    <input type="submit" class="btn btn-danger del_all" name="del_all" value="{{ trans('admin.yes') }}">
                </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <!------------------->
@push('js')
<script type="text/javascript">
    delete_all();
</script>
{!! $dataTable->scripts() !!}
@endpush

@endsection


@section('page_specific_scripts')
    <!-- player cripts -->
    
    <!-- player cripts -->
@stop
