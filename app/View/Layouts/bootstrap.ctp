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
    
        <link rel="icon" type="image/png" sizes="16x16" href="../img/jecams/jecams_logo.png">

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
               if ($authUser){
                   
                 echo $this->Element('header'); 
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
