<!--asdasd-->
<!--<script>
//    navbar-content clearfix
//$('div').removeClass('navbar-content');
//$(".navbar-content").removeClass();


$( document ).ready(function() {
    
//$("#mainnav-menu-wrap").removeAttr("id");
//$(".navbar-brand").removeAttr("class");
 
$(".navbar-content").removeClass();

$("#container").removeAttr("id");
$("#navbar").removeAttr("id");
$("#navbar").removeAttr("id");
aside

});
</script>-->



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page | Nifty - Admin Template</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="../css/nifty.min.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">



    <!--Demo [ DEMONSTRATION ]-->
    <link href="../css/demo/nifty-demo.min.css" rel="stylesheet">


    <!--Magic Checkbox [ OPTIONAL ]-->
    <link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">






    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="../plugins/pace/pace.min.css" rel="stylesheet">
    <script src="../plugins/pace/pace.min.js"></script>


    <!--jQuery [ REQUIRED ]-->
    <script src="../js/jquery.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="../js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="../js/nifty.min.js"></script>






    <!--=================================================-->

    <!--Background Image [ DEMONSTRATION ]-->
    <!--<script src="../js/demo/bg-images.js"></script>-->


 


</head>
<div id="container" class="cls-container">

		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay"></div>


		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h3 class="h4 mar-no">Account Login</h3>
		                <p class="text-muted">Sign In to your account</p>
		            </div>
<!--		            <form action="http://www.themeon.net/nifty/v2.6/index.html">
		                <div class="form-group">
		                    <input type="text" class="form-control" placeholder="Username" autofocus>
		                </div>
		                <div class="form-group">
		                    <input type="password" class="form-control" placeholder="Password">
		                </div>
		                <div class="checkbox pad-btm text-left">
		                    <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox">
		                    <label for="demo-form-checkbox">Remember me</label>
		                </div>
		                <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
		            </form>-->
<?php echo $this->Form->create('User', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Username','label'=>false));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password','label'=>false));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Login'), array('class' => 'btn btn-primary btn-lg btn-block')); ?>
				</div>

			<?php echo $this->Form->end() ?>
		        </div>

		        <div class="pad-all">
		                
<!--		            <a href="pages-password-reminder.html" class="btn-link mar-rgt">Forgot password ?</a>
		            <a href="pages-register.html" class="btn-link mar-lft">Create a new account</a>-->

		                <div class="pull-right"> 
		                    <a href="/users/social_login/Google" class="pad-rgt"><i class="demo-psi-google-plus icon-lg text-danger"></i></a>
		                </div>
		                <div class="media-body text-left">
		                    Login with
		                </div>
		                <!--<button class="btn btn-default  btn-block" type="submit">Sign In</button>-->
		            <!--<div class="media pad-top bord-top">-->
		            <!--</div>-->
                             
		        </div>
		    </div>
		</div>
		<!--===================================================-->


		<!-- DEMO PURPOSE ONLY -->
		<!--===================================================-->
<!--		<div class="demo-bg">
		    <div id="demo-bg-list">
		        <div class="demo-loading"><i class="psi-repeat-2"></i></div>
		        <img class="demo-chg-bg bg-trans active" src="../img/bg-img/thumbs/bg-trns.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="../img/bg-img/thumbs/bg-img-1.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="../img/bg-img/thumbs/bg-img-2.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="../img/bg-img/thumbs/bg-img-3.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="../img/bg-img/thumbs/bg-img-4.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="../img/bg-img/thumbs/bg-img-5.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="../img/bg-img/thumbs/bg-img-6.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="../img/bg-img/thumbs/bg-img-7.jpg" alt="Background Image">
		    </div>
		</div>-->
		<!--===================================================-->



	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->a