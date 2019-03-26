@extends('club.index')
@section('content')


<!------ start Profile Content---------->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ trans('club.single_playground.Playground_Data') }}
        <span class="text-muted" style="font-size: 11px;">
            {{ trans('club.single_playground.Created_since') }}  {{ date('d-m-Y', strtotime($Playground->created_at)) }}
            </span>
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}/club/{{ $Playground->clubUser->id }}"><i class="fa fa-dashboard"></i> {{ trans('club.single_playground.dashboard') }}</a></li>
        <li><a href="{{ url('/') }}/playgrounds/club">{{ trans('club.single_playground.playgrounds') }}</a></li>
        <li class="active">{{ $Playground->c_b_p_name }}</li>
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
                  {{$Playground->c_b_p_name}}
                </span> 
              </h3>

              @if ($Playground->our_is_active == 1)
                <span class="btn btn-success btn-flat margin btn-xs">{{ trans('club.single_playground.activated_by_SM') }}</span>
              @elseif($Playground->our_is_active == 0)
                <span class="btn btn-danger btn-flat btn-xs">{{ trans('club.single_playground.deactivated_by_SM') }}</span>
              @endif
              
              {!! Form::open(['url' => url('playground/changeActivationStatus'), 'method' => 'POST']) !!}
              {!! Form::hidden( 'target', $Playground->id ) !!}
                @if($Playground->is_active == 1)
                  {!! Form::hidden( 'status', 0 ) !!}
                  {!! Form::submit(trans('club.single_playground.Deactivate'), ['class' => 'btn btn-danger btn-flat pull-right  btn-xs']) !!}
                @elseif ($Playground->is_active == 0)
                  {!! Form::hidden( 'status', 1 ) !!}
                  {!! Form::submit(trans('club.single_playground.Activate'), ['class' => 'btn btn-success btn-flat pull-right btn-xs']) !!}
                @endif
              {!! Form::close() !!}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="list-group list-group-unbordered ">
                  <li class="list-group-item">
                      <b>{{ trans('club.single_playground.branch') }}</b>
                      <span class="btn btn-danger btn-flat btn-xs">
                        <a class="pull-right" href="{{ url('/') }}/branche/club/{{ $Playground->branch->id }}" style="color: #fff;">
                          {{ $Playground->branch->c_b_name }}
                        </a>
                      </span>
                  </li>
              </ul>
              <strong><i class="fa fa-phone custom" style="color: #3c8dbc;"></i>  {{ trans('club.single_playground.Phone') }}</strong>
  
              <p class="text-muted">
              	<span class="">{{ $Playground->c_b_p_phone }}</span>
              </p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5" style="color: #3c8dbc;"></i> {{ trans('club.single_playground.Location') }}</strong>

              <p class=" text-muted">
              	{{ $Playground->country->c_en_name }}, {{ $Playground->city->g_en_name }} {{ $Playground->area->a_en_name }}, 
              </p>
              <p class=" text-muted">
                {{ $Playground->c_b_p_address }}, 
              </p>
              <!---->
              <hr>
              <div class="clearfix"></div>
              <!---->
  
              <strong>
                <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
                {{ trans('club.single_playground.Sport') }}
              </strong>
              <p class="">{{$Playground->Sport->en_sport_name}}</p>
              <div class="clearfix"></div>

            <!---->
            <hr>
            <div class="clearfix"></div>
            <!---->
            <strong>
              <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
              {{ trans('club.single_playground.Price_Per_Hour') }}
            </strong>
            <p class="">{{$Playground->c_b_p_price_per_hour}}</p>
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
                      <b>{{ trans('club.single_playground.Total_Reservations_Count') }}</b>
                      <a class="pull-right badge">{{ $Playground->PlaygroudReservations()->count() }}</a>
                  </li>
                  <li class="list-group-item">
                      <b>{{ trans('club.single_playground.Total_Challenges_Count') }}</b>
                      <a class="pull-right badge">{{ $Playground->playgroundEvents()->count() }}</a>
                  </li>
                  <li class="list-group-item">
                      <b>{{ trans('club.single_playground.Playground_Photos') }}</b>
                      @if ($Playground->Photos()->count() > 0)
                        <a class="pull-right badge">{{ $Playground->Photos()->count() }}</a>
                        <br>
                        <div>
                          @foreach ($Playground->Photos as $Photo)
                            <span style="margin: 10px">
                              <img class="img img-thumbnail" width="100" 
                                  src="{{ Storage::url($Photo->path) }}" alt=""
                              >
                            </span>
                              
                          @endforeach
                        </div>
                        
                      @else
                        <b class="pull-right badge">{{ trans('club.single_playground.No_Photos_for_This_Playground') }}</b>
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
                 {{ trans('club.single_playground.Features') }}
               </strong>
               <p class="">
                   {{-- start of display playground features --}}
                     @php
                     $attributes = $Playground->toArray();
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
                 {{ trans('club.single_playground.Description') }}
               </strong>
               <p class="">{{$Playground->c_b_p_desc}}</p>
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
