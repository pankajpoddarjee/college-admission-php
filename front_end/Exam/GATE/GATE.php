<?php include('../../settings.php');?>
<?php include("../../connection.php");include("../../function.php");

$fetchallqry = "SELECT examType, examName, ISNULL(examFullName,'') AS examFullName, folderName, fileName, ogImage FROM MasterExams WHERE ID='8' and IsActive='1'";

$qryresult = $dbConn->query($fetchallqry);if($qryresult) {while ($row=$qryresult->fetch(PDO::FETCH_ASSOC)) {foreach ($row as $colNum=>$value) {$record[$colNum] = trim($value);}}} 
$examFullName = $record["examFullName"];
//$collegeName = $record["collegeName"];
?>


<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title> <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta property="og:title" content="">
<meta property="og:description" content="">
<meta property="og:image" content="<?php echo BASE_URL;?>/<?php echo $folderName;?>/<?php echo $ogImage;?>">
<meta property="og:url" content="<?php echo BASE_URL;?>/<?php echo $folderName;?>/<?php echo $fileName;?>">
<?php echo OTHER_META_TAGS;?>
<?php include("../../head_includes.php");?>
</head>
<body>
	<?php include("../../header.php");?>
    <?php include("../../menu.php");?>
    
    <?php //include("../../college_page_header.php");?>
	<style type="text/css">
@media only screen and (min-width:1px) and (max-width:481px){
.c_page_header img{display:block; float:none !important; margin-right:auto !important; margin-left:auto !important; margin-bottom:10px; text-align:center}
.c_page_header h1 {text-align:center !important; text-transform:uppercase; font-size:22px; font-weight:bold; font-family:Roboto; margin:0 0 5px 0; padding:0}
.college_location{font-size:12px; display:block; font-family:Roboto; font-weight:normal; margin:0 0 5px 0; text-align:center}
.college_affiliation {font-size:12px; display:block; font-family:Roboto; font-weight:normal; margin:0; text-align:center}
}
.c_page_header {padding:25px 7px; margin:0 auto; background-image: linear-gradient(45deg, #000000 35.71%, #191919 35.71%, #191919 50%, #000000 50%, #000000 85.71%, #191919 85.71%, #191919 100%) !important; background-size: 9.90px 9.90px; color:#fff}
.c_page_header h1 {text-align:left; text-transform:uppercase; font-size:22px; font-weight:bold; font-family:Roboto; margin:0 0 5px 0; padding:0}
.c_page_header a {color:#fff}
.c_page_header img {display:block; float:left; margin-right:10px; padding:2px; border:1px solid #595959}
.college_location{font-size:12px; display:block; font-family:Roboto; font-weight:normal; margin:0 0 5px 0}
.college_affiliation {font-size:12px; display:block; font-family:Roboto; font-weight:normal; margin:0}
</style>

<section class="bg-light">
    <div class="container-fluid c_page_header">
        <div class="row">
            <div class="col-md-10">
                <img class="rounded" src="logo.jpg" alt="" title="">
                <a href="<?php echo BASE_URL;?>/<?php echo $folderName;?>/<?php echo $fileName;?>" title="">
                    <h1><?php echo $record["examFullName"];?> <?php if($record["examName"]!='') {?>[<?php echo $record["examName"];?>]<?php } ?></h1>
                </a>
                <span class="college_location">
                    <i class="fa fa-map-marker"></i> <a href="" title="list of colleges in <?php echo strtolower ($cityName);?>"><?php echo $cityName;?></a>, <a href="" title="list of colleges in <?php echo strtolower ($stateName);?>"><?php echo $stateName;?></a>
                </span>
                <span class="college_affiliation">
                    <i class="fas fa-university"></i> <a href="" title="list of colleges affiliated under <?php echo strtolower ($universityName);?> (<?php echo strtolower ($universityAbbreviation);?>)"><?php echo $universityName;?> (<?php echo $universityAbbreviation;?>)</a>
                </span>
            </div>
            <div class="col-md-2">
                <?php if(SHOW_C_PAGE_HEADER_ADM_LINK==1) {?>
                <a class="btn btn-danger btn-block p-2 pb-2 mt-4" href="<?php echo BASE_URL;?>/<?php echo $folderName;?>/admission_notice.php">
                    <i class="fas fa-desktop"></i> <span class="faa-flash animated text-uppercase text-light">Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></span>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
    
    <?php include("../../college_page_menu.php");?>
    <style type="text/css">
	.active_overview{color:#FC0 !important;}
	</style>
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
					<?php include("../../google_ads_horizontal.php");?>
                </div>
                <?php include("../../college_page_social_share_button.php");?>
            </div>
        </div>
    </section>
    
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                	<div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert-info p-3" style="font-family:Rubik"><i class="fas fa-building"></i> College Info</h4>
                        </div>
                    </div>
                	<div class="row">
                        <div class="col-md-12 mt-4">
                            <?php //include("../../collegeInfoMainTable.php");?>
                        </div>
                    </div>
                    
                    <?php include("../../college_page_admission_links_H.php");?>
                    
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                        	<?php include("../../google_ads_contextual.php");?>
                        </div>
                    </div>                    
                </div>
                <div class="col-md-3">
                	<?php include("c_right_panel.php");?>
                </div>
            </div>
        </div>
    </section>
    
	<?php include("../../footer.php");?>
    <?php include("../../footer_includes.php");?>
    
    <?php $dbConn =NULL; ?>
</body>
</html>