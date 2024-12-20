<?php include('settings.php');
include("connection.php");
include("QRY_CAcollegeMainPage.php");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>sadsds Courses | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo strtolower($college_name);?>, <?php echo strtolower($records['notice_title']);?>, <?php echo strtolower($records['tags']);?>">
<meta name="description" content="<?php echo $records['description'];?>">
<meta property="og:title" content="<?php echo $record['college_name'];?> - <?php echo $records['notice_title'];?> | <?php echo SITE_NAME;?>">
<meta property="og:description" content="<?php echo $records['description'];?>">
<meta property="og:image" content="<?php echo $bannerImgPath;?>">
<meta property="og:url" content="<?php echo BASE_URL.'/'.$records['slug'];?>">
<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>
</head>
<body>
	<?php include("header.php");?>
    <?php include("menu.php");?>
    
    <?php include("college_page_header.php");?>
    <?php include("college_page_menu.php");?>
    <style type="text/css">
	.active_courses{color:#FC0 !important;}
	</style>
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
					<?php include("google_ads_horizontal.php");?>
                </div>
                <?php include("college_page_social_share_button.php");?>
            </div>
        </div>
    </section>
    
    <section class="mt-4">
        <div class="container-xxl">
            <div class="row">
                <div class="col-md-9">
                	<div class="row">
                    	<div class="col-md-12">
                            <h5 class="alert alert-info" title="<?php echo strtolower($college_name.' - '. $records['notice_title']);?>" style="font-family:Archivo">Courses</h5>
                        </div>
                    </div>
                    
                	<div class="row">
                        <div class="col-md-12 mt-2 text-center">
                            dsfdfggf
                            <hr>
                        </div>
                    </div>
                    
                	<div class="row">
                        <div class="col-md-12 mt-2">

                            course detail
                        </div>
                    </div>
                    
                    <?php include("college_page_admission_links_H.php");?>
                    
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                        	<?php include("google_ads_contextual.php");?>
                        </div>
                    </div>                    
                </div>
                <div class="col-md-3">
                	<?php include("c_right_panel.php");?>
                </div>
            </div>
        </div>
    </section>
    <?php include("social_share.php");?>
	<?php include("footer.php");?>
    <?php include("footer_includes.php");?>
    
    <?php $dbConn =NULL; ?>
</body>
</html>