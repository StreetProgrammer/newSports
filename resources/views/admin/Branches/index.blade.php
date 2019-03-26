@extends('admin.index')
@section('content')

<section class="content-header">
  <h1>
      {{ trans('admin.Branches_Datatable.title') }}
  </h1>
  
  <ol class="breadcrumb">
    <li><a href="{{ aurl('/') }}"><i class="fa fa-dashboard"></i> {{ trans('admin.dashboard') }}</a></li>
    <li class="active">{{ trans('admin.Branches_Datatable.title') }}</li>
  </ol>
</section>

<div class="box">
  <div class="box-body">
      <div class="table-responsive">

          {!! Form::open(['id' => 'form_data', 'url' => aurl('clubsControl/destroy/all')]) !!}
          {!! Form::hidden('_method', 'delete') !!}
          {!! $dataTable->table(['class' => 'dataTable text-center table table-striped table-hover table-bordered '],true) !!}
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
