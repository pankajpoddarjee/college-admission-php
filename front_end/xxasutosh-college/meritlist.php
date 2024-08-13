<?php include('../settings.php');?>
<?php include("../connection.php");include("../function.php");include("c_settings.php"); include ('../QRY_CAcollegeMainPage.php');
define("HIDE_NOTICE_BOARD","Y");?>

<!--UG MERIT LIST QUERY-->
<?php 
$recordUG_ML = array();
$fetchallqryUG_ML = "SELECT nc.ID, nc.collegeID, nc.courseType, mct.typeShortName, nc.noticeYear, nc.noticeType, nt.typeDisplayName, convert(varchar,convert(date, publishDate ,103) ,106) as publishDate, nc.noticeTitle, nc.noticeLink, nc.IsActive, nc.IsNew from noticeCollege nc 
JOIN college c ON nc.collegeID=c.ID JOIN noticeType nt ON nc.noticeType=nt.ID JOIN MasterCourseType mct ON nc.courseType=mct.ID WHERE nc.noticeYear='".CURRENT_YEAR."' and nc.collegeID='".$collegeID."' and mct.ID='1' and nt.ID='2' and nc.IsActive='1' order by ID desc";
$qryresultUG_ML = $dbConn->query($fetchallqryUG_ML);if($qryresultUG_ML) {while ($rowUG_ML=$qryresultUG_ML->fetch(PDO::FETCH_ASSOC)) {$recordUG_ML[] =$rowUG_ML;}}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $collegeName;?> Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo strtolower ($collegeName);?> merit list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, admission list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, counselling list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, online admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta name="description" content="<?php echo $collegeName;?> Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Admission List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta property="og:title" content="<?php echo $collegeName;?> Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?>">
<meta property="og:description" content="<?php echo $collegeName;?> Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Admission List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta property="og:image" content="<?php echo BASE_URL;?>/<?php echo $folderName;?>/<?php echo $ogImage;?>">
<meta property="og:url" content="<?php echo BASE_URL;?>/<?php echo $folderName;?>/meritlist.php">
<?php echo OTHER_META_TAGS;?>
<?php include("../head_includes.php");?>
</head>
<body>
	<?php include("../header.php");?>
    <?php include("../menu.php");?>
    
    <?php include("../college_page_header.php");?>
    <?php include("../college_page_menu.php");?>
    <style type="text/css">
	.active_list{color:#FC0 !important;}
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
                            <h4 class="alert-info p-3" style="font-family:Rubik"><i class="fas fa-list-ol"></i> Merit / Admission List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></h4>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                    	<div class="col-md-12">
                            <div class="dropdown text-right">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                	<i class="fas fa-history"></i> Archived Years
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" title="<?php echo $collegeName;?> Admission 2021"><i class="fa fa-hand-o-right"></i> 2021 - 2022</a>
                                    <a class="dropdown-item" href="#" title="<?php echo $collegeName;?> Admission 2020"><i class="fa fa-hand-o-right"></i> 2020 - 2021</a>
                                    <a class="dropdown-item" href="#" title="<?php echo $collegeName;?> Admission 2019"><i class="fa fa-hand-o-right"></i> 2019 - 2020</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                    	<div class="col-md-12">
                        	
                            <nav class="" style="font-family:Rubik">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link font-weight-bold pt-3 pb-3 active" id="nav-UG-tab" data-toggle="tab" href="#nav-UG" role="tab" aria-controls="nav-UG" aria-selected="true"><i class="fas fa-graduation-cap"></i> All Notices <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></span></a>
                                </div>
                            </nav>
                            
                            <style type="text/css">
							.adm_Updates a {display:block; text-decoration:none; transition:200ms ease-in-out}
							.adm_Updates a:hover { color:#F00}
							.publishDetails {color:#555; font-size:12px; display:block; transition:200ms ease-in-out}
							.adm_Updates a:hover .publishDetails{color:#000}
							.adm_Updates a:hover .publishDetails i{color:#000}
							</style>

                            <div class="input-group mb-3 mt-2">    
                                <input type="search" class="light-table-filter form-control p-4" data-table="order-table" aria-describedby="search" placeholder="Type to Search Notices">
                            </div>
                                                        
                            <table class="table table-bordered table-hover order-table adm_Updates" style="font-family:Viga">
                            <tbody>                
                            <?php 
                            $i=0;
                            foreach($recordUG_ML as $rec_UG_ML){
                            $i=$i+1;
                            ?>
                            <tr>
                            <td>
                            <a href="<?php echo $rec_UG_ML["noticeLink"];?>" title="<?php echo $collegeName;?> <?php echo $rec_UG_ML["noticeTitle"];?>">
                            <?php echo $rec_UG_ML["noticeTitle"];?>&nbsp;<?php if($rec_UG_ML["IsNew"]==1) { ?><span class='badge badge-danger faa-flash faa-fast animated'>New</span><?php }?>
                            <span class="publishDetails">
                                <i class="fa fa-calendar"></i> <?php echo $rec_UG_ML["publishDate"];?>
                                
                                <?php if($rec_UG_ML["typeShortName"]!='NA'){ ?> | <i class="fa fa-graduation-cap"></i> <?php echo $rec_UG_ML["typeShortName"];?><?php } ?> | <i class="fa fa-file-text-o"></i> <?php echo $rec_UG_ML["typeDisplayName"];?>
                            </span>
                            </a>
                            </td>
                            </tr>                
                            <?php }?><?php ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    
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