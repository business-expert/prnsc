<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
?>
 <?=$msg?>
<!-- content starts -->
<div>
	<ul class="breadcrumb">
		<li><a href="#"><?=$lang['Events']?></a> <span class="divider">/</span></li>
        <li><a href="index.php?model=calendar"><?=$lang['Calendar']?></a><span class="divider"></span></li>        
				</ul>
			</div>

			<div class="row-fluid sortable">
				<div class="box span12">
				  <div class="box-header well" data-original-title>
					  <h2><i class="icon-calendar"></i>Calendar</h2>
					  <div class="box-icon">
						  <!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>-->
						  <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						  <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
				  </div>
				
				 <div class="box-content">
				 <!-- //LEFT PANEL EVENT DRAGGABLE ITEMES
					<div id="external-events" class="well">
						<h4>Draggable Events</h4>
						<div class="external-event badge">Default</div>
						<div class="external-event badge badge-success">Completed</div>
						<div class="external-event badge badge-warning">Warning</div>
						<div class="external-event badge badge-important">Important</div>
						<div class="external-event badge badge-info">Info</div>
						<div class="external-event badge badge-inverse">Other</div>
						<p>
						<label for="drop-remove"><input type="checkbox" id="drop-remove" /> remove after drop</label>
						</p>
					</div>
				-->
				<center>
						<div id="calendar"></div>
				</center>
						<!--<div class="clearfix"></div> -->
					</div> 
				</div>
			</div><!--/row-->

		<!-- START Setting pop up model -->
		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>
		<!-- END Setting pop up model -->	
 </div>
</div>

<script src="<?=JS_ADMIN?>/bootstrap.min.js"></script>
<script src="<?=JS_ADMIN?>/bootbox.min.js"></script>



<?php
#START Fetch out Event From Events table and generate appropriate events to set on rendered calendar#
$source=array();
foreach($records as $row)
{
	$className=$row->event_type_class." ".$row->event_id;
	$title=$row->event_title;
	$start=$row->event_start_date;
	$event_end_date=$row->event_end_date;
	$event_redeem_bonus_point=$row->event_redeem_bonus_point;
	$event_all_day=$row->event_all_day;
	$source[] = array('title'=>$title,'start'=>$start,'end'=>$event_end_date,'className'=>$className,'redeem'=>$event_redeem_bonus_point);
}
$eventsArray = json_encode($source);
#END
?>

<!--#START Initialize last "event_id" from events table So we can apply on drag able items -->
<script type="text/javascript">
window.newelyEventTracker={};
window.redeemTracker={};
window.latestEventId='<?=$event_id?>';
</script>
<!--#END-->


<!--
eventsArray : Events saved in table 'events' from database.
retrieveEventId() : Initialize window.event_id by retrieving event_id from window.eventString 
getEventDetail() : 
makeAcceptableDate() : Converts window.dateTimeStamp in acceptable date format and initialize into window.acceptableDate.
window.latestEventString : When you add event through drag and drop item.
deleteEvent(): Delete an event
-->

<!--#START CALENDAR EVENTS HANDLER AND CALENDAR GENERATOR CODE -->


<script type="text/javascript">
			jQuery(function($) {
//##Initialize External Events
	$('#external-events div.external-event').each(function() {
		var eventObject = {
			title: $.trim($(this).text())//##Element's TEXT as Event Title
		};
		//##Store the Event Object in the DOM element so we can get to it later
		$(this).data('eventObject', eventObject);
		//##Make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      //##Enable revert back on its actual position
			revertDuration: 0  //##Original position after the drag
		});
		
	});



//##Initialize the calendar
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();

	var calendar = $('#calendar').fullCalendar({ //##LOOPING EVENTS
		 buttonText: {
			prev: '<i class="icon-chevron-left"></i>',
			next: '<i class="icon-chevron-right"></i>'
		},
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		events: <?=$eventsArray?>//##Set Events array from table 'events'.
		,
		editable: true,
		eventResize: function(event,dayDelta,minuteDelta,revertFunc) {//##When you resize event
		if (confirm("Is this range OK ?")) 
		{
            window.dateTimeStamp=event.end;//##End date, on date you stop resize
			makeAcceptableDate();//##Convert dateTimeStamp to acceptable date
			if(event.className.toString()==undefined || event.className.toString()=="")
			{
				window.eventString = window.newelyEventTracker[event.title];
			}
			else
			{
				window.eventString = event.className;
			}
		    retrieveEventId();//##Retrieve Event ID	
			getEventDetail();//##GET THE EVENT REDEEM BONUS POINT
			var encodedURL=encodeURI("&tb=events&upcol_name=event_end_date&upcol_value="+window.acceptableDate+"&col_name=event_id&col_value="+window.event_id);
			$.ajax({
					async   : false,
					type	: "GET",
					url		: "ajax.php",
					data    : "ajaxcall=true&mod=ajaxUpdateSingleRecord"+encodedURL,
					success	: function(result)   {					
						var json = ''+result+'',
						obj = JSON.parse(json);		
						console.log("DONE: "+obj.status);
					}
			     });

        }
		else
		{
			revertFunc();
		}
    },	
		droppable: true, //this allows things to be dropped onto the calendar !!!
		drop: function(date, allDay) { //this function is called when something is dropped
		
			//retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			var $extraEventClass = $(this).attr('data-class');
			
			//we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			
			//assign it the date that was reported
			copiedEventObject.start = date;
			copiedEventObject.allDay = allDay;
			if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
			
			//render the event on the calendar
			//the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
			//############################################################################
				/*var event_type_class="";
				window.dateTimeStamp=date;
				makeAcceptableDate();
				var newstart=window.acceptableDate;
				//$(".processing").show();
				$.ajax({
					type	: "GET",
					url		: "ajax.php",
					data    : "ajaxcall=true&mod=setEvents&event_start_date="+newstart+"&event_end_date="+newstart+"&event_all_day="+allDay+"&event_type_class="+event_type_class,
					success	: function(result) {									
								var json = ''+result+'',
								obj = JSON.parse(json);
								//$(".processing").hide();
								console.log("STATUS: "+obj.status);
								window.latestEventString=obj.event_id;
								}
					});*/	
			//############################################################################
			
			//is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				//if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
		}
		,
		selectable: true,
		selectHelper: true,
		select: function(start, end, allDay) {
			
			bootbox.prompt("Add New Event Details:", function(title) {
			
				//var myobjectdata=$('#calendar').fullCalendar('clientEvents');
				///$.each( myobjectdata, function( key, value ) {
				//alert( key + ": " + value.title );
			//});
				if (title !== null) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
					//## START ADD EVENT AJAX SUBMISSION
					var event_redeem_bonus_point=$(".bonus_points").val();
					var event_enrollment=$(".event_enrollment").val();
					var event_type_class="";  
					var event_desc=$("#event_desc").val();
					window.dateTimeStamp=start;
					makeAcceptableDate();
					var newstart=window.acceptableDate;
					window.dateTimeStamp=end;
					makeAcceptableDate();
					var newend=window.acceptableDate;
var encodedURL=encodeURI("&event_title="+title+"&event_start_date="+newstart+"&event_end_date="+newend+"&event_all_day="+allDay+"&event_redeem_bonus_point="+event_redeem_bonus_point+"&event_type_class="+event_type_class+"&event_desc="+event_desc+"&event_enrollment="+event_enrollment);
					//$(".processing").show();
					$.ajax({
						async   : false,
						type	: "GET",
						url		: "ajax.php",
						data    : "ajaxcall=true&mod=setEvents"+encodedURL,
						success	: function(result)   {									
									var json = ''+result+'',
									obj = JSON.parse(json);
									//$(".processing").hide();
									console.log("STATUS: "+obj.status);
									//window.latestEventString=obj.event_id; //#Track event_id first time data is not updated.
									//window.latestEventString=obj.event_title;
									window.newelyEventTracker[title]=obj.event_id;
									window.redeemTracker[title]=event_redeem_bonus_point;
								  }
				   });	
				   //##END ADD EVENT AJAX SUBMISSION
				}
			});
			calendar.fullCalendar('unselect');
		}
		,
		eventClick: function(calEvent, jsEvent, view) { //##EDIT FORM HERE
		//##Condition First time after event add, we need to track on added 'event_id'
		if(calEvent.className.toString()==undefined || calEvent.className.toString()=="")
		{
			window.eventString = window.newelyEventTracker[calEvent.title];
		}
		else
		{
			window.eventString = calEvent.className;
		}
		    retrieveEventId();	
			getEventDetail();//## GET THE EVENT REDEEM BONUS POINT
			var form = $("<form class='form-inline'><h4 class='modal-title'><label>Update Event Details</label></h4></form>");
			form.append("<div class='modal-header'></div><br />");
			form.append("<span class='event_form_title'>Event Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>");
			form.append("<input class='middle' autocomplete=off type=text value='" + calEvent.title + "' /> ");
			form.append("<br /><br />");
			form.append("Bonus Points: &nbsp;&nbsp;");
			form.append("<input id='event_id' class='"+window.eventString+"' type=hidden value='" + window.eventString + "' /> ");
			form.append("<input class='bonus_points' class='middle' autocomplete=off type=text value='"+ window.event_redeem_bonus_point +"' /> ");
			form.append("<br /><br />Enrollment :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='bootbox-input form-control event_enrollment' autocomplete=off type=text value='"+window.event_enrollment+"' />");
			form.append("<br /><br />Description: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows='5' cols='200' id='event_desc'>"+window.event_desc+"</textarea><br />");
			form.append("<button type='submit' class='btn btn-sm btn-success'><i class='icon-ok'></i> Save</button>");
			
			var div = bootbox.dialog({
				message: form,
				buttons: {
					"delete" : {
						"label" : "<i class='icon-trash'></i> Delete Event",//## DELETE BUTTON
						"className" : "btn-sm btn-danger",
						"callback": function() {
						 deleteEvent();//##Function called to delete event
							calendar.fullCalendar('removeEvents' , function(ev){
								return (ev._id == calEvent._id);
							})
						}
					} ,
					"close" : {
						"label" : "<i class='icon-remove'></i> Close", //## CLOSE BUTTON
						"className" : "btn-sm"
					} 
				}

			});
			
			form.on('submit', function(e){//##SAVE BUTTON ON EDIT FORM
				calEvent.title = form.find("input[type=text]").val();
				calendar.fullCalendar('updateEvent', calEvent);
				//##START UPDATE EVENT AJAX SUBMISSION
					var event_redeem_bonus_point=$(".bonus_points").val();
					var event_enrollment=$(".event_enrollment").val();
					var event_type_class="default";
					var title=calEvent.title;
					var event_desc=$("#event_desc").val();
					window.dateTimeStamp=calEvent.end;
					makeAcceptableDate();
					var newEnd=window.acceptableDate;
					if(newEnd!="T"){extraUrl = "&event_end_date="+newEnd;}else{extraUrl = "";}				
					//$(".processing").show();
					var encodedURL=encodeURI("&event_title="+title+"&event_redeem_bonus_point="+event_redeem_bonus_point+"&event_type_class="+event_type_class+"&event_id="+window.event_id+"&event_desc="+event_desc+"&event_enrollment="+event_enrollment+""+extraUrl);					
					$.ajax({
						async   : false,
						type	: "GET",
						url		: "ajax.php",
						data    : "ajaxcall=true&mod=updateEvents"+encodedURL,
						success	: function(result)   {
									var json = ''+result+'',
									obj = JSON.parse(json);
									console.log("AAAAA: "+obj.status);
									//$(".processing").hide();
								  }
				   });
				//##END UPDATE EVENT AJAX SUBMISSION
				div.modal("hide");
				return false;
			});
		},
		eventRender: function(event, element)//#Called each when event is rendered on each event base
		{
			//element.find('.fc-event-title').append("<br/>Redeem: " + "aaa"); 
		}
	
	});
});
</script>


<script type="text/javascript">
function getEventDetail()
{
	$.ajax({
			async   : false,
			type	: "GET",
			url		: "ajax.php",
			data    : "ajaxcall=true&mod=getEventDetail&event_id="+window.event_id,
			success	: function(result)   {					
				var json = ''+result+'',
				obj = JSON.parse(json);		
				window.event_redeem_bonus_point=obj.event_redeem_bonus_point;	
				window.event_desc=obj.event_desc;
				window.event_enrollment=obj.event_enrollment;
			}
		});
}

function retrieveEventId()
{
	eventString=window.eventString;
	eventString=eventString.toString();
	events_id_array=new Array();
	events_id_array=eventString.split(",");
	if(events_id_array[1]==undefined || events_id_array[1]=="")
	{
		window.event_id=events_id_array; return;
	}
	window.event_id=events_id_array[1];
}
function deleteEvent()
{
	retrieveEventId();
	$.ajax({
			async   : false,
			type	: "GET",
			url		: "ajax.php",
			data    : "ajaxcall=true&mod=ajaxDeleteRecord&tb=events&col_name=event_id&col_value="+window.event_id,
			success	: function(result)   {					
				var json = ''+result+'',
				obj = JSON.parse(json);		
				console.log("DONE: "+obj.status);
			}
		});
}

function makeAcceptableDate()
{
	//2013-10-10T14:30:00 ACCEPTED DATE FORMAT
	var currentDate = $.fullCalendar.formatDate(window.dateTimeStamp, 'yyyy-MM-dd');
	var currentTime = $.fullCalendar.formatDate(window.dateTimeStamp, 'HH:mm:ss');
	var acceptableDate=currentDate+"T"+currentTime;
	window.acceptableDate=acceptableDate;
}
</script>




