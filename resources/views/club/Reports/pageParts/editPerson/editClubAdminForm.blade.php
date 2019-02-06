{!! Form::open(['url' => url('club/user/update/' . $user->id), 'method' => 'POST']) !!}
             {!! Form::hidden( 'clubId', Auth::id() ) !!}
             {!! Form::hidden( 'type', 4 ) !!}
             <p class="" style="font-weight:bold">
               <i class="fa fa-user custom" style="color: #3c8dbc;"></i>
               {{ trans('club.adminName') }}
           </p>
             <p class="text-muted">
               <input type="text" class="form-control" name="name"
                 value="@if( old('name') ) {{ old('name') }} @else {{ $user->name }} @endif"
               >
             </p>
             <hr>

             <p class="" style="font-weight:bold">
               <i class="fa fa-phone custom" style="color: #3c8dbc;"></i>
               {{ trans('club.email') }}
             </p>
             <p class="text-muted">
               <input type="email" class="form-control" name="email"
                 value="@if( old('name') ) {{ old('email') }} @else {{ $user->email }} @endif"
               >
             </p>
             <hr>
             <p class="displayDetails" style="font-weight:bold">
               <i class="fa fa-key custom" style="color: #3c8dbc;"aria-hidden="true"></i>
               {{ trans('club.password') }}
           </p>
             <div class="col-md-10">
               <p class="text-muted">
                 <input type="password" name="password" class="form-control" value="">
               </p>
             </div>
             <div class="col-md-2 text-center">
               <strong class="showHidePass" style="font-size: 120%;
                                       border: 2px solid #3c8dbc;
                                       padding: 3px 5px;
                                       border-radius: 15px;
                                       cursor: pointer;"
               >
                 <i class="fa fa-eye" style="color: #3c8dbc;"aria-hidden="true"></i>
               </strong>
             </div>


             <hr>
             <div class="row">
               <div class="col-md-12">
                 <label for="name">{{trans('club.accountStatus')}}</label>
               </div>
                 <div class="col-md-12">
                   <div class="checkbox">
                       <label><input type="checkbox" name="user_is_active" value="1"
                         @if ( old('user_is_active') == 1 || $user->user_is_active == 1 )
                           checked="checked"
                         @endif
                     >{{trans('club.activeAccount')}}</label>
                   </div>
                 </div>
             </div>
             <br><br>

{!! Form::submit(trans('club.save'),['class'=>'btn btn-primary', 'id' => 'createMamnager']) !!}
{!! Form::close() !!}
<br><br>
