@extends('admin.index')
@section('content')


<!------ start Profile Content---------->

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          {{ trans('admin.single_branch.Playground_Data') }}
          <span class="text-muted" style="font-size: 11px;">
              {{ trans('admin.single_branch.Created_since') }}  {{ date('d-m-Y', strtotime($Branch->created_at)) }}
              </span>
        </h1>
        
        <ol class="breadcrumb">
          <li><a href="{{ aurl('/') }}"><i class="fa fa-dashboard"></i> {{ trans('admin.single_branch.dashboard') }}</a></li>
          <li><a href="{{ aurl('/') }}/branches">{{ trans('admin.single_branch.branches') }}</a></li>
          <li class="active">{{ $Branch->c_b_name }}</li>
        </ol>
      </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"> 
                  <span style="color:#3c8dbc;font-weight: bold;">
                    {{$Branch->c_b_name}}
                  </span> 
                </h3>
  
                @if ($Branch->is_active == 1)
                  <span class="btn btn-success btn-flat margin btn-xs">{{ trans('admin.single_playground.activated_by_Owner') }}</span>
                @elseif($Branch->is_active == 0)
                  <span class="btn btn-danger btn-flat btn-xs">{{ trans('admin.single_playground.deactivated_by_Owner') }}</span>
                @endif
                
                {!! Form::open(['url' => aurl('Playground/changeActivationStatus/'), 'method' => 'POST']) !!}
                {!! Form::hidden( 'target', $Branch->id ) !!}
                  @if($Branch->our_is_active == 1)
                    {!! Form::hidden( 'status', 0 ) !!}
                    {!! Form::submit(trans('admin.single_playground.Deactivate'), ['class' => 'btn btn-danger btn-flat pull-right  btn-xs']) !!}
                  @elseif ($Branch->our_is_active == 0)
                    {!! Form::hidden( 'status', 1 ) !!}
                    {!! Form::submit(trans('admin.single_playground.Activate'), ['class' => 'btn btn-success btn-flat pull-right btn-xs']) !!}
                  @endif
                {!! Form::close() !!}
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <ul class="list-group list-group-unbordered ">
                    <li class="list-group-item">
                        <b>{{ trans('admin.single_playground.club') }}</b>
                        <span class="btn btn-danger btn-flat btn-xs">
                          <a class="pull-right" href="{{ aurl('/') }}/{{ $Branch->id }}" style="color: #fff;">
                            {{ $Branch->c_b_name }}
                          </a>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b>{{ trans('admin.single_playground.branch') }}</b>
                        <span class="btn btn-danger btn-flat btn-xs">
                          <a class="pull-right" href="{{ aurl('/') }}/{{ $Branch->user->id }}" style="color: #fff;">
                            {{ $Branch->user->name }}
                          </a>
                        </span>
                    </li>
                </ul>
                <strong><i class="fa fa-phone custom" style="color: #3c8dbc;"></i>  {{ trans('admin.single_playground.Phone') }}</strong>
    
                <p class="text-muted">
                  <span class="">{{ $Branch->c_b_phone }}</span>
                </p>
                <hr>
                <strong><i class="fa fa-map-marker margin-r-5" style="color: #3c8dbc;"></i> {{ trans('admin.single_playground.Location') }}</strong>
  
                <p class=" text-muted">
                  {{ $Branch->c_b_Country->c_en_name }}, {{ $Branch->c_b_City->g_en_name }} {{ $Branch->c_b_Area->a_en_name }}, 
                </p>
                <p class=" text-muted">
                  {{ $Branch->c_b_address }}, 
                </p>
                <!---->
                <hr>
                <div class="clearfix"></div>
                <!---->
    
                <strong>
                  <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
                  {{ trans('admin.single_playground.Sport') }}
                </strong>
                <p class="">{{ $Branch->c_b_address }}</p>
                <div class="clearfix"></div>
  
              <!---->
              <hr>
              <div class="clearfix"></div>
              <!---->
              <strong>
                <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
                {{ trans('admin.single_playground.Price_Per_Hour') }}
              </strong>
              <p class="">{{ $Branch->c_b_address }}</p>
              <div class="clearfix"></div>
             
              <hr>
              
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-body">
                   <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                          <b>{{ trans('admin.single_playground.Total_Reservations_Count') }}</b>
                          <a class="pull-right badge">{{ $Branch->PlaygroudReservations()->count() }}</a>
                      </li>
                      <li class="list-group-item">
                          <b>{{ trans('admin.single_playground.Total_Challenges_Count') }}</b>
                          <a class="pull-right badge">{{ $Branch->playgroundEvents()->count() }}</a>
                      </li>
                     <li class="list-group-item">
                         <b>{{ trans('admin.single_playground.Playground_Photos') }}</b>
                         @if ($Branch->Photos()->count() > 0)
                           <a class="pull-right badge">{{ $Branch->Photos()->count() }}</a>
                           <br>
                           <div>
                             @foreach ($Branch->Photos as $Photo)
                               <span style="margin: 10px">
                                 <img class="img img-thumbnail" width="100" 
                                     src="{{ Storage::url($Photo->path) }}" alt=""
                                 >
                               </span>
                                 
                             @endforeach
                           </div>
                           
                         @else
                           <b class="pull-right badge">{{ trans('admin.single_playground.No_Photos_for_This_Playground') }}</b>
                         @endif
                     </li>
                   </ul>
                   
  
                   <hr>
           
                 <div class="col-lg-2 editDetails" style="display:none;" >
                   <div id="loader"
                   class="text-center "
                   style="display: none;z-index: 99999;font-size: 10px;color: #3c8dbc;"
                   >
                     <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                   </div>
                 </div>
               <div class="clearfix"></div>
               <!---->
     
                 <strong>
                   <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
                   {{ trans('admin.single_playground.Features') }}
                 </strong>
                 <p class="">
                     {{-- start of display playground features --}}
                       @php
                       $attributes = $Branch->toArray();
                       $features = [];
                     
                       foreach ($attributes as $attrkey => $attrvalue) {
                         if (strpos($attrkey, 'feature') !== false) {
                               $features[$attrkey] = $attrvalue ;
                         }
                       }
                       
                       //print_r($attributes);
                     @endphp
     
                     @foreach ($features as $key => $value)
                       @if ($value == 1)
                       <span class="badge" style="background: #4CAF50;">
                         {{ trans("club.$key") }}
                       </span>
                       @endif
                     @endforeach
                     {{-- start of display playground features --}}
     
                 </p>
                 <div class="clearfix"></div>
                 <!---->
                 <hr>
  
     
                 <strong>
                   <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
                   {{ trans('admin.single_playground.Description') }}
                 </strong>
                 <p class="">{{$Branch->c_b_p_desc}}</p>
                 <div class="clearfix"></div>
                 <!---->
                 <hr>
                 <!---->
                 </div>
                 <!-- /.box-body -->
               </div>
               <!-- /.box -->
               </div>
     
        </div>
          
  
      </section>

  <!------ End Profile Content ------------->
@endsection
