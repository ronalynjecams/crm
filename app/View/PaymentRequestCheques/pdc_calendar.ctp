 
<link href="http://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
    
      <script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
      <script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
      <script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
        <script src="/js/erp_scripts.js"></script>  
        
        
        
    <!--Full Calendar [ OPTIONAL ]-->
    <link href="/css/plug/fullcalendar/fullcalendar.min.css" rel="stylesheet">
	<link href="/css/plug/fullcalendar/nifty-skin/fullcalendar-nifty.min.css" rel="stylesheet">


    <!--Full Calendar [ OPTIONAL ]-->
    <script src="/css/plug/fullcalendar/lib/moment.min.js"></script>
	<script src="/css/plug/fullcalendar/lib/jquery-ui.custom.min.js"></script>
	<script src="/css/plug/fullcalendar/fullcalendar.min.js"></script>


    <!--Full Calendar [ SAMPLE ]-->
    <script src="js/demo/misc-fullcalendar.js"></script>



      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
          <h1 class="page-header text-overflow">Issued Cheques Calendar</h1>
        </div>
        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
          <!-- Basic Data Tables -->
          <!--===================================================-->
          <div class="panel">
            <div class="panel-heading" >
              <h3 class="panel-title">
                   
              </h3>
              <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
              <div class="col-sm-12">
                <table>
                  <tr>
                    <td>Color Legend</td>
                  </tr>
                  <tr>
                    <td bgcolor="#26a69a"  style="padding:10px;"><font color="#FFFFFF">Pending</font></td>
                    <td  bgcolor="#42a5f5" style="padding:10px"><font color="#FFFFFF">Cleared</font></td>
                  </tr>
                </table>
                <p></p>
              </div>
            </div>
            <div class="panel-body">
                
                 <div id='demo-calendar'></div>
                
            </div>
          </div>
        </div>
      </div>  
        <script>  
    
$(document).ready(function() {
var d = new Date();
var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
 
            console.log(strDate);
	$('#demo-calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: false,
		droppable: false, // this allows things to be dropped onto the calendar
		drop: function() {
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
		},
		defaultDate: strDate,
		eventLimit: true, // allow "more" link when too many events
		events:{
		 url: '/payment_request_cheques/get_issued_cheques_calendar', //navigate to this url to see json feed array
            type: 'POST',
            success: function (data) {
                console.log('kuha');
            },
            error: function (data) {
                console.log('d na kuha');
            }, 
		},
		
  eventClick: function(event) {
    if (event.url) {
      window.open(event.url);
      return false;
    }
    }
	});

});

        </script> 
 