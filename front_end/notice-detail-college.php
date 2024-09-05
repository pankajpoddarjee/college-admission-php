<?php include_once('settings.php');
include_once("connection.php");
//include("function.php");
include_once("QRY_CAcollegeMainPage.php");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $record['college_name'];?> - <?php echo $records['notice_title'];?> | <?php echo SITE_NAME;?></title>
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
	.active_notice{color:#FC0 !important;}
	</style>
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
					<?php include("google_ads_horizontal.php");?>
                </div>
            </div>
        </div>
    </section>
    
    <section class="mt-4">
        <div class="container-xxl">
            <div class="row">
                <div class="col-md-9">
                	<div class="row">
                    	<div class="col-md-12">
                            <h5 class="alert alert-info" title="<?php echo strtolower($college_name.' - '. $records['notice_title']);?>" style="font-family:Archivo"><?php echo $records['notice_title'];?></h5>
                        </div>
                    </div>
                    
                	<div class="row">
                        <div class="col-md-12 mt-2 text-center">
                            <img src="<?php echo $logoImgPath;?>" alt="<?php echo strtolower ($college_name);?> logo" title="<?php echo strtolower ($college_name);?> logo" class="border border-secondary border-opacity-25 p-1 mb-1"  height="70">
                            <h2 style="font-family:Oswald"><?php echo $record['college_name'];?></h2>
                            <!-- <h6 style="font-family:Rubik"><?php echo $record['city_name'] . ', ' . $record['state_name'];?></h6> -->
                            <h5 style="font-family:Archivo"><?php echo $records['notice_title'];?></h5>
                            <hr>
                        </div>
                    </div>
                    
                	<div class="row">
                        <div class="col-md-12 text-end">
                            <?php include("social_share.php");?>
                        </div>
                        <div class="col-md-12 mt-2">
                            <?php if($records['notice_type'] == 'page' && !empty($records['page_link']) ){ 
                                include("../uploads/notices/".$records['page_link']);                                
                            }
                            ?>
                        </div>
                        <div class="col-md-12 text-center">
                            <?php include("social_share.php");?>
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
	<?php include("footer.php");?>
    <?php include("footer_includes.php");?>
    
    <?php $dbConn =NULL; ?>
</body>
</html>