{{-- start for manager create ONE-full-calender for all playgrounds --}}
<script>
$( document ).ready(function() {
    @if (!empty(Auth::user()->playgrounds))
	    var reservations = $('#reservations').fullCalendar({
	    	//editable:true,
		    header:{
		     left:'prev,next today',
		     center:'title',
		     right:'month,agendaWeek,agendaDay'
		    },
	    	events: '/getplaygroundReservation/' + {{ Auth::user()->id }} + '/user' ,

		    eventClick:function(event)
		    {
			     if(confirm("Are you sure you want to remove it?"))
			     {
			      var id = event.id;
			      var _token = $("input[name=_token]").val();
			      $.ajax({
			       url:"/reservations/club/delete/",
			       type:"POST",
			       data:{
			       		id:id,
			       		_token:_token
			       	},
			       success:function(data)
			       {
			        {{-- calendar{{$playground->id}}.fullCalendar('refetchEvents'); --}}
			        //alert("Event Removed");
				        if (data == 'true') {
				        	swal({
				              title: "Deleted",
				              text: "Reservation Deleted successfully !!!",
				              icon: "success",
				              dangerMode: false,
				            });
				            reservations.fullCalendar('refetchEvents');
				        } else {
				        	swal({
				              title: "Error",
				              text: "Some Error Occurred ",
				              icon: "warning",
				              dangerMode: true,
				            });
				        }
			        
			       }
			      })
			     }
		    },
	    	
	   });
	@endif
	
});
</script>
{{-- start for manager create ONE-full-calender for all playgrounds --}}


{{-- start for manager including to create full calender to each playground --}}
<script>
$( document ).ready(function() {
	@if (!empty(Auth::user()->playgrounds))
		@foreach (Auth::user()->playgrounds as $playground)
          	@if ($playground->is_active == 1 && $playground->our_is_active == 1)
		     var calendar{{$playground->id}} = $('#Reservations{{$playground->id}}').fullCalendar({
		    	//editable:true,
			    header:{
			     left:'prev,next today',
			     center:'title',
			     right:'month,agendaWeek,agendaDay'
			    },
		    	events: '/getplaygroundReservation/' + {{ $playground->id}} + '/playground' ,
		    	//selectable:true,
		    	//selectHelper:true,
			    /*select: function(start, end, allDay)
			    {
				     var title = prompt("Enter Event Title");
				     if(title)
				     {
				      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
				      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
				      $.ajax({
				       url:"insert.php",
				       type:"POST",
				       data:{title:title, start:start, end:end},
				       success:function()
				       {
				        calendar{{$playground->id}}.fullCalendar('refetchEvents');
				        alert("Added Successfully");
				       }
				      })
				     }
			    },*/
		    	//editable:true,
			    /*eventResize:function(event)
			    {
				     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
				     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
				     var title = event.title;
				     var id = event.id;
				     $.ajax({
				      url:"update.php",
				      type:"POST",
				      data:{title:title, start:start, end:end, id:id},
				      success:function(){
				       calendar{{--$playground->id--}}.fullCalendar('refetchEvents');
				       alert('Event Update');
				      }
				     })
			    },*/

		    	/*eventDrop:function(event)
			    {
				     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
				     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
				     var title = event.title;
				     var id = event.id;
				     $.ajax({
				      url:"update.php",
				      type:"POST",
				      data:{title:title, start:start, end:end, id:id},
				      success:function()
				      {
				       calendar{{$playground->id}}.fullCalendar('refetchEvents');
				       alert("Event Updated");
				      }
				     });
			    },*/

			    eventClick:function(event)
			    {
				     if(confirm("Are you sure you want to remove it?"))
				     {
				      var id = event.id;
				      var _token = $("input[name=_token]").val();
				      $.ajax({
				       url:"/reservations/club/delete/",
				       type:"POST",
				       data:{
				       		id:id,
				       		_token:_token
				       	},
				       success:function(data)
				       {
				        //calendar{{$playground->id}}.fullCalendar('refetchEvents');
				        //alert("Event Removed");
					        if (data == 'true') {
					        	swal({
					              title: "Deleted",
					              text: "Reservation Deleted successfully !!!",
					              icon: "success",
					              dangerMode: false,
					            });
					            calendar{{$playground->id}}.fullCalendar('refetchEvents');
					        } else {
					        	swal({
					              title: "Error",
					              text: "Some Error Occurred ",
					              icon: "warning",
					              dangerMode: true,
					            });
					        }
				        
				       }
				      })
				     }
			    },

		   });
		 	@endif 
        @endforeach
	@endif
	
});
</script>
{{-- end for manager including to create full calender to each playground --}}



{{-- start script for display claender for playground to [ owner / admin ] and allow delete reservations --}}
<script>
$( document ).ready(function() {
	@if (!empty($Playground))
      	@if ($Playground->is_active == 1 && $Playground->our_is_active == 1)
	     var calendar{{$Playground->id}} = $('#Reservations{{$Playground->id}}').fullCalendar({
	    	//editable:true,
	    	//slotEventOverlap: false,
		    header:{
		     left:'prev,next today',
		     center:'title',
		     right:'month,agendaWeek,agendaDay'
		    },
	    	events: '/getplaygroundReservation/' + {{$Playground->id}} + '/playground' ,
	    	//selectable:true,
	    	//selectHelper:true,
		    /*select: function(start, end, allDay)
		    {
			     var title = prompt("Enter Event Title");
			     if(title)
			     {
			      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
			      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
			      var _token = $('input[name=_token]').val();
			      $.ajax({
			       url:"/reservations/club/store",
			       type:"POST",
			       data:{_token:_token, title:title, start:start, end:end},
			       success:function(data)
			       {console.log(data) ;
			        calendar{{$Playground->id}}.fullCalendar('refetchEvents');
			        alert("Added Successfully");
			       }
			      })
			     }
		    },*/
	    	//editable:true,
		    /*eventResize:function(event)
		    {
			     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
			     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
			     var title = event.title;
			     var id = event.id;
			     $.ajax({
			      url:"update.php",
			      type:"POST",
			      data:{title:title, start:start, end:end, id:id},
			      success:function(){
			       calendar{{$Playground->id}}.fullCalendar('refetchEvents');
			       alert('Event Update');
			      }
			     })
		    },*/

	    	/*eventDrop:function(event)
		    {
			     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
			     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
			     var title = event.title;
			     var id = event.id;
			     $.ajax({
			      url:"update.php",
			      type:"POST",
			      data:{title:title, start:start, end:end, id:id},
			      success:function()
			      {
			       calendar{{$Playground->id}}.fullCalendar('refetchEvents');
			       alert("Event Updated");
			      }
			     });
		    },*/

		    eventClick:function(event)
			    {
				     if(confirm("Are you sure you want to remove it?"))
				     {
				      var id = event.id;
				      var _token = $("input[name=_token]").val();
				      $.ajax({
				       url:"/reservations/club/delete/",
				       type:"POST",
				       data:{
				       		id:id,
				       		_token:_token
				       	},
				       success:function(data)
				       {
				        //calendar{{$Playground->id}}.fullCalendar('refetchEvents');
				        //alert("Event Removed");
					        if (data == 'true') {
					        	swal({
					              title: "Deleted",
					              text: "Reservation Deleted successfully !!!",
					              icon: "success",
					              dangerMode: false,
					            });
					            calendar{{$Playground->id}}.fullCalendar('refetchEvents');
					        } else {
					        	swal({
					              title: "Error",
					              text: "Some Error Occurred ",
					              icon: "warning",
					              dangerMode: true,
					            });
					        }
				        
				       }
				      })
				     }
			    },

	   });
	 	@endif 
	@endif
	
});
</script>
{{-- end script for display claender for playground to [ owner / admin ] and allow delete reservations --}}


{{-- start script for check vacant time in some playground --}} 
<script>
	$(document).on('change', ".date", function () {

		var err = 0 ;
		var id = this.id ;
		//alert(id) ;
		id = id.substr(0, id.indexOf('_'));

		$("#" + id + "_err").text("");
		$("input[name=" + id + "_name]").val("") ;
		$("#" + id + "_nameDiv").fadeOut() ;
		//alert(id) ;
		var date  =  $("input[name=" + id + "_date]").val();
		if (date == null || date == "" ) {
			err = 1 ;
		}
		var from  =  $("select[name=" + id + "_from]").val();
		if (from == null || from == "" ) {
			err = 1 ;
		}
		var to    =  $("select[name=" + id + "_to]").val();
		if (to == null || to == "" ) {
			err = 1 ;
		}
		var diff = parseInt(to) - parseInt(from) ;
		if ( Math.sign(diff) != 1 ) {
			err = 1
		}
		//alert( date + ' ' + from + ' ' + to);
		//alert(err) ;
		if(err == 0){
			$('.reCheckLoader').fadeIn();
			var _token = $("input[name=_token]").val();
			var playgroundId = $("input[name=playgroundId]").val();
			$.ajax({
		      type:'POST',
		      url:'/checkVacantTime/' ,
		      data:{
                 	_token:_token,
                 	playgroundId:id,
                 	date:date,
                 	from:from,
                 	to:to,
             },
		    	success:function(data){
		    		if (data == 'true') {
		    			$("#" + id + "_err").removeClass('alert-danger');
		    			$("#" + id + "_err").addClass('alert-success');
		    			$("#" + id + "_err").text("it's a vacant time, you can reserve it.");
		    			$("#" + id + "_nameDiv").fadeIn() ;
		    			$("input[name=" + id + "_add]").show() ;
		    			//$( "#" + playgroundId + "_add" ).removeClass( 'disabled' );

		    		} else {
		    			$( "#" + id + "_err" ).removeClass( 'alert-success' );
		    			$( "#" + id + "_err" ).addClass( 'alert-danger' );
		    			$("#" + id + "_err").text("Please check or complete your entries.");
		    			$("#" + id + "_nameDiv").fadeOut() ;
		    			$("input[name=" + id + "_add]").hide() ;
		    			//$( "#" + playgroundId + "_add" ).addClass( 'disabled' );
		    		}
		    		$('.reCheckLoader').fadeOut();
		            //alert(data);
		            console.log(data) ;
		            //$('#AddGameLoading').hide();
		            
		         }
		   });
		}else{
			$( "#" + id + "_err" ).removeClass( 'alert-success' );
		    $( "#" + id + "_err" ).addClass( 'alert-danger' );
			$("#" + id + "_err").text("Please check or complete your entries.");
		}

	});
</script>
{{-- end script for check vacant time in some playground --}}

{{-- start script for add new reservation --}} 
<script>
	$(document).on('click', ".submit", function (e) {
		e.preventDefault();
		
		var err = 0 ;
		var id = this.id ;
		//alert(id) ;
		id = id.substr(0, id.indexOf('_'));
		$("#" + id + "_err").text("");
		//alert(id) ;
		var date  =  $("input[name=" + id + "_date]").val();
		if (date == null || date == "" ) {
			err = 1 ;
		}
		var from  =  $("select[name=" + id + "_from]").val();
		if (from == null || from == "" ) {
			err = 1 ;
		}
		var to    =  $("select[name=" + id + "_to]").val();
		if (to == null || to == "" ) {
			err = 1 ;
		}
		var name   =  $("input[name=" + id + "_name]").val();
		console.log(name) ;
		if (name.replace(/\s/g,"") === "") {
			err = 1 ;
		}
		var diff = parseInt(to) - parseInt(from) ;
		if ( Math.sign(diff) != 1 ) {
			err = 1
		}
		//alert( date + ' ' + from + ' ' + to);
		//alert(err) ;
		if(err == 0){
			$('.reCheckLoader').fadeIn();
			var _token = $("input[name=_token]").val();
			//var playgroundId = $("input[name=playgroundId]").val();
			$.ajax({
		      type:'POST',
		      url:'/reservations/club/store/' ,
		      data:{
                 	_token:_token,
                 	playgroundId:id,
                 	date:date,
                 	from:from,
                 	to:to,
                 	name:name
             },
		    	success:function(data){
		    		console.log(data)
		    		if (data != 'false') {
		    			$("#" + id + "_err").removeClass( 'alert-danger' );
		    			$("#" + id + "_err").addClass( 'alert-success' );
		    			$("#" + id + "_err").text("Reservation Added Successfully ");
		    			$("#" + id + "_nameDiv").show() ;
		    			$("input[name=" + id + "_add]").show() ;
		    			var win = window.open('/reservations/invoice/' + data, '_blank');
  						win.focus();

		    		} else {
		    			$("#" + id + "_err").removeClass( 'alert-success' );
		    			$("#" + id + "_err").addClass( 'alert-danger' );
		    			$("#" + id + "_err").text("an Error Occurred, please try again");
		    			$("#" + id + "_nameDiv").hide() ;
		    			$("input[name=" + id + "_add]").hide() ;
		    			//$( "#" + playgroundId + "_add" ).addClass( 'disabled' );
		    		}
		    		$('.reCheckLoader').fadeOut();
		            //alert(data);
		            console.log(data) ;
		            //$('#AddGameLoading').hide();
		            
		         }
		   });
		}else{
			$("#" + id + "_err").removeClass( 'alert-success' );
		    $("#" + id + "_err").addClass( 'alert-danger' );
			$("#" + id + "_err").text("Please check or complete your entries.");
		}

	});
</script>
{{-- end script for add new reservation --}}