<?php include('configuration.php');

session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// function generateCsrfToken() {
//     return bin2hex(random_bytes(32));
// }
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="<?php echo $_SESSION['csrf_token']; ?>">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_NAME;?> | <?php echo SITE_TAGLINE;?></title>
<?php include("head_includes.php");?>
</head>
<body class="bg_login">    
    <div id="content">
        
		<style type="text/css">
		.bg_login{
		background: rgb(23,97,145);
		background: -moz-linear-gradient(90deg, rgba(23,97,145,1) 0%, rgba(23,144,96,1) 100%);
		background: -webkit-linear-gradient(90deg, rgba(23,97,145,1) 0%, rgba(23,144,96,1) 100%);
		background: linear-gradient(90deg, rgba(23,97,145,1) 0%, rgba(23,144,96,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#176191",endColorstr="#179060",GradientType=1);
		}
        .bg{background: rgb(88,183,1);
        background: -moz-linear-gradient(90deg, rgba(88,183,1,0.5508578431372548) 0%, rgba(225,237,69,0.500437675070028) 24%, rgba(177,213,0,0.5844712885154062) 62%, rgba(207,232,167,0.80015756302521) 91%, rgba(88,183,1,0.45281862745098034) 100%);
        background: -webkit-linear-gradient(90deg, rgba(88,183,1,0.5508578431372548) 0%, rgba(225,237,69,0.500437675070028) 24%, rgba(177,213,0,0.5844712885154062) 62%, rgba(207,232,167,0.80015756302521) 91%, rgba(88,183,1,0.45281862745098034) 100%);
        background: linear-gradient(90deg, rgba(88,183,1,0.5508578431372548) 0%, rgba(225,237,69,0.500437675070028) 24%, rgba(177,213,0,0.5844712885154062) 62%, rgba(207,232,167,0.80015756302521) 91%, rgba(88,183,1,0.45281862745098034) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#58b701",endColorstr="#58b701",GradientType=1);}
        .footer{padding:10px 0; margin:0; width:100%}
        @media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
        </style>
        
        <div class="container" style="margin-top:16vh">
            <div class="row justify-content-center">
            	<div class="col-md-5 text-center">
                	<img class="rounded mb-2" width="70" src="<?php echo BASE_URL;?>/<?php echo COLLEGE_LOGO; ?>" alt="logo">
                    <h3 class="text-center text-uppercase text-white mb-1" style="font-family:Viga; font-size:24px"><?php echo COLLEGE_NAME; ?></h3>
                    <h5 class="text-center text-white" style="font-family:Rubik; font-size:14px"><?php echo SITE_TAGLINE;?></h5>
                </div>
            </div>           
            
            <div class="row justify-content-center mt-4">
            	<div class="col-md-5 steps_follow_animation">
                	<div class="shadow" style="background:rgba(0,0,0,0.3)">
                        <div class="shadow p-3" style="color:#FC3"><i class="fa fa-sign-in"></i> Authentication Required</div>
                        <div style="margin:5px 0" class="overflow-hidden p-5">
                        	<span class="pt-0 mt-0" style="color:#fff"><i class="fa fa-key"></i> Enter Credentials</span>
                            <form id="frmlogin" name="frmlogin" action="" method="post">
							 
                                <div class="input-group mb-3 mt-2">
                                    <!--<div class="input-group-prepend">
                                        <span class="input-group-text">Student Id <span class="text-danger">*</span></span>
                                    </div>-->
                                    <input type="text" id="txtusername" name="txtusername" class="form-control" placeholder="Username">
                                </div>
                                
                                <div class="input-group mb-3">
                                    <input type="password" id="txtpassword" name="txtpassword" class="form-control" placeholder="Password">
                                </div>
                                
                                <p class="text-center" style="margin:15px 0 10px 0">
                                    <a class="btn btn-sm btn-danger btn-block py-2" href="javascript: void(0)" onclick="verifyLogin()"><i class="fa fa-sign-in"></i> LOG-IN</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
        <!--MODAL START-->
        <div class="modal fade" id="ValidationAlert" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="ShowValidationAlert"><?php echo MODAL_VALIDATION_TEXT;?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="generate_token()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-left" id="msgcontent">
                    	
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="generate_token()">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--MODAL END-->
    </div>	
    <?php include("footer_includes.php");?>    
</body>
</html>
<script src="js_client/clientlogin.js"></script>