<?php include('../settings.php');?>
<?php include("../connection.php");include("../function.php");include("c_settings.php"); include ('../QRY_CAcollegeMainPage.php');
define("HIDE_NOTICE_BOARD","Y");?>
<?php 
$recordCNB_ADM_UG = array();
$fetchallqryCNB_ADM_UG = "SELECT nc.ID, nc.collegeID, nc.courseType, mct.typeShortName, nc.noticeYear, nc.noticeType, nt.typeDisplayName, convert(varchar,convert(date, publishDate ,103) ,106) as publishDate, nc.noticeTitle, nc.noticeLink, nc.IsActive, nc.IsNew from noticeCollege nc 
JOIN college c ON nc.collegeID=c.ID JOIN noticeType nt ON nc.noticeType=nt.ID JOIN MasterCourseType mct ON nc.courseType=mct.ID WHERE nc.noticeYear='".CURRENT_YEAR."' and nc.collegeID='".$collegeID."' and nc.IsActive='1' order by ID desc";
$qryresultCNB_ADM_UG = $dbConn->query($fetchallqryCNB_ADM_UG);if($qryresultCNB_ADM_UG) {while ($rowCNB_ADM_UG=$qryresultCNB_ADM_UG->fetch(PDO::FETCH_ASSOC)) {$recordCNB_ADM_UG[] =$rowCNB_ADM_UG;}}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission Dates <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo strtolower ($college_name);?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, merit list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, admission list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, counselling list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, online admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta name="description" content="<?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Admission Dates <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta property="og:title" content="<?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission Dates <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?>">
<meta property="og:description" content="<?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Admission Dates <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta property="og:image" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $ogImage;?>">
<meta property="og:url" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/admission_notice.php">
<?php echo OTHER_META_TAGS;?>
<?php include("../head_includes.php");?>
</head>
<body>
	<?php include("../header.php");?>
    <?php include("../menu.php");?>
    
    <?php include("../college_page_header.php");?>
    <?php include("../college_page_menu.php");?>
    <style type="text/css">
	.active_admission{color:#FC0 !important;}
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
        <div class="container-xxl">
            <div class="row">
                <div class="col-md-9">

                    <div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert alert-info" title="<?php echo $college_name;?> notices <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>" style="font-family:Oswald"><i class="fa-solid fa-bullhorn"></i> Notice Board <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></h4>
                        </div>
                    </div>
                    
                    <style type="text/css">
                    .adm_Updates a {display:block; text-decoration:none; font-family:Poppins; font-weight:bold; color:#069}
                    .adm_Updates a:hover {color:#F00}
                    .publishDetails {color:#555; font-size:12px; display:block}
                    .adm_Updates a:hover .publishDetails{color:#000}
                    </style>

                    <div class="row align-items-center">
                        <div class="col-8 col-md-10">
                            <div class="input-group">    
                                <input type="search" class="light-table-filter form-control bg-light p-2" data-table="order-table" aria-describedby="search" placeholder="Type to Search">
                            </div>
                        </div>

                        <div class="col-4 col-md-2">
                            <button class="btn btn-secondary w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fa-solid fa-clock-rotate-left"></i> Archive</button>

                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                <div class="offcanvas-header border-bottom">
                                    <h5 class="offcanvas-title m-0 p-0" id="offcanvasRightLabel" style="font-family:Oswald"><i class="fa-regular fa-building"></i> <?php echo $college_name;?> | <span class="text-danger">Archive</span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <a class="btn btn-warning mb-2 w-100" href=""><i class="fa-solid fa-clock-rotate-left"></i> 2022-2023</a>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <a class="btn btn-warning mb-2 w-100" href=""><i class="fa-solid fa-clock-rotate-left"></i> 2021-2022</a>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <a class="btn btn-warning mb-2 w-100" href=""><i class="fa-solid fa-clock-rotate-left"></i> 2020-2021</a>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <a class="btn btn-warning mb-2 w-100" href=""><i class="fa-solid fa-clock-rotate-left"></i> 2019-2020</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 mt-3">                                
                            <div class="table-responsive">
                                <table class="table table-bordered order-table adm_Updates">
                                <thead class="fw-bold">
                                <tr>
                                <td>Date</td>
                                <td>Title</td>
                                <td>Course</td>
                                <td>Type</td>
                                </tr>
                                </thead>
                                <tbody>                
                                <?php 
                                $i=0;
                                foreach($recordCNB_ADM_UG as $rec_ADM_UG){
                                $i=$i+1;
                                ?>
                                <tr>
                                <td class="align-middle"><?php echo $rec_ADM_UG["publishDate"];?></td>
                                <td>
                                <a href="<?php echo $rec_ADM_UG["noticeLink"];?>" title="<?php echo strtolower($college_name);?> <?php echo strtolower($rec_ADM_UG["noticeTitle"]);?>">
                                <?php echo $rec_ADM_UG["noticeTitle"];?><?php if($rec_ADM_UG["IsNew"]==1) { ?>&nbsp;<sup><span class='badge bg-danger fa-fade animated'>New</span></sup><?php }?>
                                </a>
                                </td>
                                <td><?php echo $rec_ADM_UG["typeShortName"];?></td>
                                <td><?php echo $rec_ADM_UG["typeDisplayName"];?></td>
                                </tr>                
                                <?php }?><?php ?>
                                </tbody>
                                </table>
                            </div>
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