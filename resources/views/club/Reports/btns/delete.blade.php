

<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_user{{ $id }}">
	<i class="fa fa-trash"></i>
</button>

<!------------------->
  <div class="modal fade" id="del_user{{ $id }}" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">{!! trans('admin.modelDeleteTitle') !!}</h4>
        </div>

        {!! Form::open(['url' => url('club/user/delete/' . $id), 'method' => 'POST']) !!}
        <div class="modal-body" style="color:#fff;background:#dd4b39;">

          <div class="notEmptyRecord">
            <h3>
              are you sure, delete {{ $name }} User ?
              {!! trans('admin.ask_delete_one_item') !!}
              <span class="record_count"></span>
              {!! trans('admin.questionMark') !!}
            </h3>
          </div>

        </div>
        <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
    {!! Form::submit('Yes', ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close()!!}
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!------------------->
