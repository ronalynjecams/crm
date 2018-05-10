<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page | Nifty - Admin Template</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="/css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="/css/nifty.min.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="/css/demo/nifty-demo-icons.min.css" rel="stylesheet">



    <!--Demo [ DEMONSTRATION ]-->
    <link href="/css/demo/nifty-demo.min.css" rel="stylesheet">


    <!--Magic Checkbox [ OPTIONAL ]-->
    <link href="/css/plug/magic-check/css/magic-check.min.css" rel="stylesheet">






    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="/css/plug/pace/pace.min.css" rel="stylesheet">
    <script src="/css/plug/pace/pace.min.js"></script>


    <!--jQuery [ REQUIRED ]-->
    <script src="/js/jquery.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="/js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="/js/nifty.min.js"></script>






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
    <div class="cls-content" id="result_not_in_incognito">
        <div class="cls-content-sm panel">
            <div class="panel-body">
                <div class="mar-ver pad-btm">
                    <h3 class="h4 mar-no">Account Login</h3>
                    <p class="text-muted">Sign In to your account</p>
                </div> 
                <?php echo $this->Form->create('User', array('role' => 'form')); ?>

                <div class="form-group">
                    <?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Username', 'label' => false)); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password', 'label' => false)); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->submit(__('Login'), array('class' => 'btn btn-primary btn-lg btn-block')); ?>
                </div>

                <?php echo $this->Form->end() ?>
            </div>

            <div class="pad-all"> 

                <div class="pull-right"> 
                    <a href="/users/social_login/Google" class="pad-rgt"><i class="demo-psi-google-plus icon-lg text-danger"></i></a>
                </div>
                <div class="media-body text-left">
                    Login with
                </div> 
                <p></p>
                <p></p>
                <p></p>
                <p></p>

              <!--  <div class="pull-right"> -->
		            <!--<a href="/employee_details/add" class="btn-link mar-lft"><i class="fa fa-address-book icon-lg text-primary"></i></a>-->
              <!--  </div>-->
                <!--<div class="media-body text-left">Applicant</div> -->
                

               
            </div>
             
		
		        <div class="pad-all">
		            <!--<a href="pages-password-reminder.html" class="btn-link mar-rgt">Are you an Applicant ?</a>-->
		
		            <div class="media pad-top bord-top">
		                <div class="pull-right">
		                    <a href="/employee_details/add" class="pad-rgt"><i class="demo-pli-add-user icon-lg text-danger"></i></a>
		                </div>
		                <div class="media-body text-left">
		                    Applicant
		                </div>
		            </div>
		        </div>
        </div>
    </div>
    <div id="result_with_incognito"> 

    </div>

    <div id="strict_browser"> 

    </div>



</div>


<script>
    //allow users to use chrome browser only
    //activate these scripts on live version
    // $(document).ready(function () {

    //     if ((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1) {
    //         $('#result_not_in_incognito').hide();
    //         $('#result_with_incognito').hide();
    //         $('#strict_browser').append('<div class="cls-content">' +
    //                 '<div class=" panel"><div class="panel-body"><h3 class="text-danger">Only Chrome and Safari browsers are allowed</h3></div></div></div>');

    //     } else if (navigator.userAgent.indexOf("Chrome") != -1) {
    //         // alert('Chrome');
    //     } else if (navigator.userAgent.indexOf("Safari") != -1) {
    //         // alert('Safari');
    //     } else if (navigator.userAgent.indexOf("Firefox") != -1) {
    //         $('#result_not_in_incognito').hide();
    //         $('#result_with_incognito').hide();
    //         $('#strict_browser').append('<div class="cls-content">' +
    //                 '<div class=" panel"><div class="panel-body"><h3 class="text-danger">Only Chrome and Safari browsers are allowed</h3></div></div></div>');

    //     } else if ((navigator.userAgent.indexOf("MSIE") != -1) || (!!document.documentMode == true)) { //IE
    //         $('#result_not_in_incognito').hide();
    //         $('#result_with_incognito').hide();
    //         $('#strict_browser').append('<div class="cls-content">' +
    //                 '<div class=" panel"><div class="panel-body"><h3 class="text-danger">Only Chrome and Safari browsers are allowed</h3></div></div></div>');

    //     } else if (window.navigator.userAgent.indexOf("Edge") > -1) {

    //         //alert('unknown');
    //         $('#result_not_in_incognito').hide();
    //         $('#result_with_incognito').hide();
    //         $('#strict_browser').append('<div class="cls-content">' +
    //                 '<div class=" panel"><div class="panel-body"><h3 class="text-danger">Only Chrome and Safari browsers are allowed</h3></div></div></div>');
    //     } else {
    //         //alert('unknown');
    //         $('#result_not_in_incognito').hide();
    //         $('#result_with_incognito').hide();
    //         $('#strict_browser').append('<div class="cls-content">' +
    //                 '<div class=" panel"><div class="panel-body"><h3 class="text-danger">Only Chrome and Safari browsers are allowed</h3></div></div></div>');

    //     }

    //     if (navigator.appVersion.indexOf('Edge') > -1) {
    //         $('#result_not_in_incognito').hide();
    //         $('#result_with_incognito').hide();
    //         $('#strict_browser').append('<div class="cls-content">' +
    //                 '<div class=" panel"><div class="panel-body"><h3 class="text-danger">Only Chrome and Safari browsers are allowed</h3></div></div></div>');

    //     }
    //     //to check if user is in incognito mode 
    //     var fs = window.RequestFileSystem || window.webkitRequestFileSystem;
    //     if (!fs) {
    //         // result.textContent = "check failed?";

    //         $('#result_not_in_incognito').hide();
    //         $('#result_with_incognito').hide();
    //         return;
    //     }
    //     fs(window.TEMPORARY, 100, function (fs) {
    //         // result.textContent = "it does not seem like you are in incognito mode";
    //         $('#result_with_incognito').hide();
    //         $('#result_not_in_incognito').show();

    //     }, function (err) {
    //         $('#result_not_in_incognito').hide();
    //         $('#result_with_incognito').show();
    //         // result.textContent = "Incognito mode is not allowed";
    //         $('#result_with_incognito').append('<div class="cls-content">' +
    //                 '<div class=" panel"><div class="panel-body"><h3 class="text-danger">Chrome Browser in Incognito mode is not allowed</h3></div></div></div>');
    //     });

    // });


</script>