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

  <body>

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