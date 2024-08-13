<?php include('../settings.php');?>
<?php include("../connection.php");include("../function.php");include("c_settings.php"); include ('../QRY_CAcollegeMainPage.php');?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $collegeName;?> - Apply Now for Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo $collegeName;?> apply now <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, online admission website <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta name="description" content="Apply Now for admission to <?php echo $collegeName;?> <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta property="og:title" content="<?php echo $collegeName;?> - Apply Now for Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?>">
<meta property="og:description" content="Apply Now for admission to <?php echo $collegeName;?> <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta property="og:image" content="<?php echo BASE_URL;?>/<?php echo $folderName;?>/<?php echo $ogImage;?>">
<meta property="og:url" content="<?php echo BASE_URL;?>/<?php echo $folderName;?>/applynow.php">
<?php echo OTHER_META_TAGS;?>
<?php include("../head_includes.php");?>
</head>
<body>
	<?php include("../header.php");?>
    <?php include("../menu.php");?>
    
    <?php include("../college_page_header.php");?>
    <?php include("../college_page_menu.php");?>
    <style type="text/css">
	.active_apply{color:#FC0 !important;}
	</style>
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
					<?php include("../google_ads_horizontal.php");?>
                </div>
                <?php include("../college_page_social_share_button.php");?>
            </div>
        </div>
    </section>
    
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                	<div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert-info p-3" style="font-family:Rubik"><i class="fas fa-edit"></i> Apply Now <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></h4>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center mt-4 mb-5">
                        <div class="col-md-12">
                            <!--<div class="embed-responsive embed-responsive-16by9">
                            	<iframe class="embed-responsive-item" src="##" allowfullscreen></iframe>
                            </div>-->
                        </div>
                    </div>
                    
                    <?php include("../college_page_admission_links_H.php");?>
                    
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                        	<?php include("../google_ads_contextual.php");?>
                        </div>
                    </div>                    
                </div>
                <!--<div class="col-md-3">
                	<?php //include("c_right_panel.php");?>
                </div>-->
            </div>
        </div>
    </section>
    
	<?php include("../footer.php");?>
    <?php include("../footer_includes.php");?>
    
    <?php $dbConn =NULL; ?>
</body>
</html>