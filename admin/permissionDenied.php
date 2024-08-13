<?php include('../settings.php');?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>Unauthorized Access</title>
<?php include("../head_includes.php");?>
</head>
<body class="bg_login">    
    <div id="content">
        
		<style type="text/css">
		.bg_login{
		background: #332851;
		}
		.footer{padding:10px 0; margin:0; width:100%}
        @media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
        </style>
        
        <div class="container" style="margin-top:28vh">
            <!--<div class="row justify-content-center mt-5">
            	<div class="col-md-5 text-center mt-4">
                	<img class="rounded mb-2" width="70" src="<?php echo BASE_URL_ADMIN;?>/<?php echo COLLEGE_LOGO; ?>" alt="logo">
                    <h3 class="text-center text-uppercase text-white mb-0" style="font-family:Viga"><?php echo COLLEGE_NAME; ?></h3>
                    <h6 class="text-center text-white"><?php echo SITE_TAGLINE;?></h6>
                </div>
            </div>-->
            
            <div class="row justify-content-center mt-5">
            	<div class="col-md-12 text-center steps_follow_animation">
                	<h1 class="m-0" style="font-size:120px; color:#ca3674; font-weight:bold">403</h1>
                    <h4 style="color:#FC0; margin-top:-15px">Access Forbidden</h4>
                </div>
                
                <div class="col-md-6 text-center steps_follow_animation">
                	<h5 class="m-0" style="font-size:18px; color:#a38ddd">You dont' have permission to access this page.</h5>
                </div>
                
                <div class="col-md-12 mt-4 text-center steps_follow_animation">
                	<a class="btn btn-warning btn-sm" href="<?php echo BASE_URL_ADMIN;?>/login.php">
                    	Go to Login
                    </a>
                </div>
            </div>
        </div>
		
        <!--MODAL START-->
        <div class="modal fade" id="ValidationAlert" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="ShowValidationAlert"><?php echo MODAL_VALIDATION_TEXT;?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-left" id="msgcontent">
                    	
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--MODAL END-->
          
        <section class="text-light footer">
            <div class="container-fluid">
                <div class="row" style="padding:15px 0">
                    <div class="col-md-6">
                        <div class="text-center text-sm-left">
                            <i class="fa fa-copyright mr-2"></i><?php echo CURRENT_YEAR;?> All rights reserved.
                        </div>
                    </div>
                    
                    <div class="col-md-6 text-center text-sm-right">
                        Powered by: 
                        <a class="text-warning text-decoration-none" href="https://www.suryashaktiinfotech.com" target="_blank">
                            <img src="<?php echo BASE_URL_ADMIN;?>/images/sipl_logo_small.png" width="25" style="vertical-align:top"> Suryashakti Infotech Pvt. Ltd.
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html>