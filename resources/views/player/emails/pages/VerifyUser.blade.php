@extends('player.emails.index')
@section('content')

@yield('content')

<!-- start english section -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
     <tr>
        <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;" class="main-header">
            <div style="line-height: 35px">
                Dear, <span style="color: #5caad2;"> {{ $users->name}}</span>
                Welcome to 
                <a style="color: #5caad2; text-decoration: none;">
                    SportsMate
                </a>
                the first big real sport community web application
                First you will need to verify your account by click the link below
                <p style="font-size: 100%;color: #66BB6A;">
                    <a 
                        href="{{url('mailRedirect')}}?url=profile/{{sm_crypt($creator->id)}}&kind=user" 
                        style="color: #5caad2; text-decoration: none;"
                    >
                    	verify account link
                    </a>
                    Suggested 
                    a Match for the event of 
                    @if ($eventType == 'event')
                        <span style="color: #5caad2;"> {{ $event->eventSport->en_sport_name }} </span>   
                    @else
                        <span style="color: #5caad2;"> {{ $event->challengeSport->en_sport_name }} </span>   
                    @endif
                    
                    at 
                    @php
                        if ($eventType == 'event') {
                            echo strftime( '%d %B %Y' , strtotime($event->E_date) );// to display a nice formatted date
                        } else {
                            echo strftime( '%d %B %Y' , strtotime($event->C_date) );// to display a nice formatted date
                        }
                    @endphp 
                </p>
            </div>
        </td>
    </tr>
    <tr>
        <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
    </tr>
    <tr>
        <td align="center">
            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                <tr>
                    <td align="center">
                        <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                            <tr>
                                <td align="center" style="color: #5caad4; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                    <div style="line-height: 24px">
                                        you have recieved this email baecouse your are one of the event members. 
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center">
                        <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                            <tr>
                                <td align="center" style="color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                    <div style="line-height: 24px">
                                        
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                </tr>
                <tr>

                </tr>
                <tr>
                    <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center">
                        <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                            <tr>
                                <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center">
                        <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                            <tr>
                                <td align="center" style="color: #607d8b; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                    <div style="line-height: 24px">
										click the button below and Accpet or reject the Suggested match  
										<br>
										<span style="color: #66BB6A;">
											enjoy SportsMate.
										</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center">
                        <table border="0" align="center" width="160" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="">

                            <tr>
                                <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                            </tr>

                            <tr>
                                <td align="center" style="color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;">


                                    <div style="line-height: 26px;">
                                        <a 
                                            @if ($eventType == 'event')
                                             href="{{url('mailRedirect')}}?url=Event/Show/{{sm_crypt($event->id) }}&kind=user"   
                                            @else
                                             href="{{url('mailRedirect')}}?url=Challenge/Show/{{sm_crypt($event->id) }}&kind=user"   
                                            @endif
                                            style="color: #ffffff; text-decoration: none;"
                                        >
                                            Your Event
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                            </tr>

                        </table>
                    </td>
                </tr>


            </table>

        </td>
    </tr>

</table>
<!-- end english section -->

<!-- start english section -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    <tr>
       <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;" class="main-header">
           <div style="line-height: 35px">
               Dear, <span style="color: #5caad2;"> {{ $users->name}}</span>
               <p style="font-size: 100%;color: #66BB6A;">
                   <a 
                       href="{{url('mailRedirect')}}?url=profile/{{sm_crypt($creator->id)}}&kind=user" 
                       style="color: #5caad2; text-decoration: none;"
                   >
                       {{ $creator->name }}
                   </a>
                   Suggested 
                   a Match for the event of 
                   @if ($eventType == 'event')
                       <span style="color: #5caad2;"> {{ $event->eventSport->en_sport_name }} </span>   
                   @else
                       <span style="color: #5caad2;"> {{ $event->challengeSport->en_sport_name }} </span>   
                   @endif
                   
                   at 
                   @php
                       if ($eventType == 'event') {
                           echo strftime( '%d %B %Y' , strtotime($event->E_date) );// to display a nice formatted date
                       } else {
                           echo strftime( '%d %B %Y' , strtotime($event->C_date) );// to display a nice formatted date
                       }
                   @endphp 
               </p>
           </div>
       </td>
   </tr>
   <tr>
       <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
   </tr>
   <tr>
       <td align="center">
           <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
               <tr>
                   <td align="center">
                       <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                           <tr>
                               <td align="center" style="color: #5caad4; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                   <div style="line-height: 24px">
                                       you have recieved this email baecouse your are one of the event members. 
                                   </div>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
               <tr>
                   <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
               </tr>
               <tr>
                   <td align="center">
                       <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                           <tr>
                               <td align="center" style="color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                   <div style="line-height: 24px">
                                       
                                   </div>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
               <tr>
                   <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
               </tr>
               <tr>

               </tr>
               <tr>
                   <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
               </tr>
               <tr>
                   <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
               </tr>

               <tr>
                   <td align="center">
                       <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                           <tr>
                               <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                           </tr>
                       </table>
                   </td>
               </tr>

               <tr>
                   <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
               </tr>

               <tr>
                   <td align="center">
                       <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                           <tr>
                               <td align="center" style="color: #607d8b; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                   <div style="line-height: 24px">
                                       click the button below and Accpet or reject the Suggested match  
                                       <br>
                                       <span style="color: #66BB6A;">
                                           enjoy SportsMate.
                                       </span>
                                   </div>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>

               <tr>
                   <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
               </tr>

               <tr>
                   <td align="center">
                       <table border="0" align="center" width="160" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="">

                           <tr>
                               <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                           </tr>

                           <tr>
                               <td align="center" style="color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;">


                                   <div style="line-height: 26px;">
                                       <a 
                                           @if ($eventType == 'event')
                                            href="{{url('mailRedirect')}}?url=Event/Show/{{sm_crypt($event->id) }}&kind=user"   
                                           @else
                                            href="{{url('mailRedirect')}}?url=Challenge/Show/{{sm_crypt($event->id) }}&kind=user"   
                                           @endif
                                           style="color: #ffffff; text-decoration: none;"
                                       >
                                           Your Event
                                       </a>
                                   </div>
                               </td>
                           </tr>

                           <tr>
                               <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                           </tr>

                       </table>
                   </td>
               </tr>


           </table>

       </td>
   </tr>

</table>
<!-- end english section -->
@endsection
    