<?php include('../settings.php');?>
<?php include("../connection.php");include("../function.php");include("c_settings.php"); include ('../QRY_CAcollegeMainPage.php');
define("HIDE_NOTICE_BOARD","N");?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $college_name;?> - Contact Us, Location, Phone, Website, Email | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo $college_name;?> contact us, location, email, website">
<meta name="description" content="<?php echo $college_name;?>, Contact Us, College Location, College Phone Number, College Website, Colleg Email.">
<meta property="og:title" content="<?php echo $college_name;?> - Contact Us, Location, Phone, Website, Email | <?php echo SITE_NAME;?>">
<meta property="og:description" content="<?php echo $college_name;?>, Contact Us, College Location, College Phone Number, College Website, Colleg Email.">
<meta property="og:image" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $banner_img;?>">
<meta property="og:url" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/contact.php">
<?php echo OTHER_META_TAGS;?>
<?php include("../head_includes.php");?>
</head>
<body>
	<?php include("../header.php");?>
    <?php include("../menu.php");?>
    
    <?php include("../college_page_header.php");?>
    <?php include("../college_page_menu.php");?>
    <style type="text/css">
	.active_contact{color:#FC0 !important;}
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
                <div class="col-md-9">
                	
                    <div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert alert-info" title="<?php echo $college_name;?> Contact" style="font-family:Oswald"><i class="fas fa-building"></i> Contact Details</h4>
                        </div>
                    </div>
                    
                    <?php include("../collegeContactMainTable.php");?>
                    
                    <?php include("../college_page_admission_links_H.php");?>
                    
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                        	<?php include("../google_ads_contextual.php");?>
                        </div>
                    </div>                    
                </div>
                <div class="col-md-3">
                	<?php include("c_right_panel.php");?>
                </div>
            </div>
        </div>
    </section>
    
	<?php include("../footer.php");?>
    <?php include("../footer_includes.php");?>
    
    <?php $dbConn =NULL; ?>
</body>
</html>