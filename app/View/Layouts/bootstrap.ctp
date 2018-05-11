<!DOCTYPE html>
<html lang="en">
  <head>
	<title>
	    Jecams ERP
		<?php //echo $title_for_layout; ?>
	</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
        <link rel="icon" type="image/png" sizes="16x16" href="/img/jecams/jecams_logo.png">
        <link rel="manifest" href="/manifest.json">

	<?php
// 		echo $this->Html->meta('icon');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

  	<!-- Latest compiled and minified CSS -->


  </head>

  <body onload="onload_functions()">

            <?php 
             echo $this->Element('header');
              if ($authUser){
                 echo $this->Element('navigation');  
                 echo $this->Element('left_side'); 
                 echo $this->Element('right_side'); 
              }
            ?> 


    <!--<div class="container">-->

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
 

    <!--</div> /.container -->

            <?php 
               if ($authUser){
                   
                 echo $this->Element('footer');   
               }
            ?> 
  </body>
</html>


<!--<script src="https://www.gstatic.com/firebasejs/4.9.0/firebase.js"></script>-->
<!--<script src="https://www.gstatic.com/firebasejs/4.9.0/firebase-app.js"></script>-->
<!--<script src="https://www.gstatic.com/firebasejs/4.9.0/firebase-auth.js"></script>-->
<!--<script src="https://www.gstatic.com/firebasejs/4.9.0/firebase-database.js"></script>-->
<!--<script src="https://www.gstatic.com/firebasejs/4.9.0/firebase-firestore.js"></script>-->
<!--<script src="https://www.gstatic.com/firebasejs/4.9.0/firebase-messaging.js"></script>-->
<script>
//get hostname DO NOT COMMENT OUT!
var host = window.location.hostname;
var userDetails = <?php echo json_encode($UserIn); ?>;
console.log(userDetails['id']);

function onload_functions(){
    // =============================================================>
    var path = window.location.pathname;
    if(path == "/users/dashboard_proprietor") {
        $.get('/users/yearly_total', function(data) {
    		$("#yearly").text(data);
    	});
    	$.get('/users/monthly_total', function(data) {
    		$("#monthly").text(data);
    	});
    	$.get('/users/daily_total', function(data) {
    		$("#daily").text(data);
    	});
    	$.get('/users/team_total/monthly', function(data) {
    		var team_monthly = '';
    		var returnval = $.parseJSON(data);
    		
    		for(var i=0;i<=returnval.length;i++) {
    		    var team_id = data[i]['id'];
    		    team_monthly += '<p class="mar-no">'+
                     <span class="pull-right text-bold">&#8369; <?php if(!empty($data['grand_total_team'])) echo number_format($data['grand_total_team'],2); else echo 0;?></span>
                     <a id="team_clicked" data-id="<?php echo $team_id; ?>"
                        data-name="<?php echo $data['display_name']; ?>"
                        style="color:white;cursor:pointer;">
                     		[<?php echo $data['display_name']; ?>]
                     </a> =>
                 </p>
    		}
    	});
    }
    // ===============================================================>
    var moved_edited_quote_count_left_side = document.getElementById("moved_edited_quote_count_left_side");
    var edited_quote_count_left_side = document.getElementById("edited_quote_count_left_side");
    var moved_quote_count_left_side = document.getElementById("moved_quote_count_left_side");
    var count_product_request = document.getElementById("count_product_request");
    var count_pending_pr = document.getElementById("count_pending_pr");
    var count_pending_pr_cheque = document.getElementById("count_pending_pr_cheque");
    var count_pending_pr_pettycash = document.getElementById("count_pending_pr_pettycash");
    var count_pending_replenishment = document.getElementById("count_pending_replenishment");
    
    if(moved_edited_quote_count_left_side){
        $.get("/app/moved_edited_quote_count_left_side/moved", function(data, status){
            if(data > 0 && status == "success"){
                $("#moved_edited_quote_count_left_side_view").append('<span class="label label-danger ">'+data+'</span>');
        
            }
        });
    }
    if(edited_quote_count_left_side){
        $.get("/app/edited_quote_count_left_side/rejected", function(data, status){
            if(data > 0 && status == "success"){
                $("#edited_quote_count_left_side_view").append('<span class="label label-danger ">'+data+'</span>');
        
            }
        });
    }
    if(moved_quote_count_left_side){
        $.get("/app/moved_quote_count_left_side/moved", function(data, status){
            if(data > 0 && status == "success"){
                $("#moved_quote_count_left_side_view").append('<span class="label label-danger ">'+data+'</span>');
        
            }
        });
    }
    if(count_product_request){
        $.get("/app/count_product_request/request", function(data, status){
            if(data > 0 && status == "success"){
                $("#count_product_request_view").append('<span class="label label-danger ">'+data+'</span>');
        
            }
        });
    }
    if(count_pending_pr){
        $.get("/app/count_pending_pr/cash/acknowledged", function(data, status){
            if(data > 0 && status == "success"){
                $("#count_pending_pr_view").append('<span class="label label-danger ">'+data+'</span>');
                $("#count_pending_pr_view1").append('<span class="label label-danger ">'+data+'</span>');
        
            }
        });
    }
    if(count_pending_pr_cheque){
        $.get("/app/count_pending_pr/cheque/pending", function(data, status){
            data = 5;
            if(data > 0 && status == "success"){
                $("#count_pending_pr_cheque_view").append('<span class="label label-danger ">'+data+'</span>');
                $("#count_pending_pr_cheque_view1").append('<span class="label label-danger ">'+data+'</span>');
        
            }
        });
    }
    if(count_pending_pr_pettycash){
        $.get("/app/count_pending_pr/pettycash/replenished", function(data, status){
            data = 5;
            if(data > 0 && status == "success"){
                $("#count_pending_pr_pettycash_view").append('<span class="label label-danger ">'+data+'</span>');
                
            }
        });
    }
    if(count_pending_replenishment){
        $.get("/app/count_pending_replenishment", function(data, status){
            data = 5;
            if(data > 0 && status == "success"){
                $("#count_pending_replenishment_view").append('<span class="label label-danger ">'+data+'</span>');
                
            }
        });
    }
}
// function moved_edited_quote_count_left_side(){
//     $.get("app/moved_edited_quote_count_left_side/moved", function(data, status){
//             alert("Data: " + data + "\nStatus: " + status);
//     });
// }
  // Initialize Firebase
//   var config = {
//     apiKey: "AIzaSyDEQ5dupvtFW1KyMxtX3as5xR3HiHWz_go",
//     authDomain: "crm-erp-2017.firebaseapp.com",
//     databaseURL: "https://crm-erp-2017.firebaseio.com",
//     projectId: "crm-erp-2017",
//     storageBucket: "",
//     messagingSenderId: "677477016979" 
//   };
  // firebase.initializeApp(config);
  
  
  // const messaging = firebase.messaging();
  
  // messaging.requestPermission()
  //   .then(function() {
  //     console.log('Notification permission granted.');
  //     // TODO(developer): Retrieve an Instance ID token for use with FCM.
  //     messaging.getToken()
  //         .then(function(currentToken) {
  //           if (currentToken) {
  //             sendTokenToServer(currentToken);
  //             updateUIForPushEnabled(currentToken);
  //           } else {
  //             // Show permission request.
  //             console.log('No Instance ID token available. Request permission to generate one.');
  //             // Show permission UI.
  //             updateUIForPushPermissionRequired();
  //             setTokenSentToServer(false);
  //           }
  //         })
  //         .catch(function(err) {
  //           console.log('An error occurred while retrieving token. ', err);
  //           showToken('Error retrieving Instance ID token. ', err);
  //           setTokenSentToServer(false);
  //         });
  //     // ...
  //   })
  //   .catch(function(err) {
  //     console.log('Unable to get permission to notify.', err);
  //   });
  
</script>