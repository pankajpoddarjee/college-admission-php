<?php include('settings.php');?>
<?php include("connection.php");include("function.php");

$record = array();

$fetchallqry = "SELECT c.ID, college_name, ISNULL(c.short_name,'') AS shortName, college_type_id, c.country_id, co.country_name, c.state_id, s.state_name, c.city_id, ci.city_name, c.banner_img, c.logo_img, c.folder_name, c.file_name FROM colleges c 
JOIN countries co ON c.country_id=co.ID 
JOIN [states] s ON c.state_id=s.ID 
JOIN cities ci ON c.city_id=ci.ID 
WHERE c.city_id in (1,7) AND c.is_active=1 order by c.college_name";
/*WHERE c.city_id='1' AND c.is_active=1 order by c.college_name";*/
$qryresult = $dbConn->query($fetchallqry);if($qryresult) {while ($row=$qryresult->fetch(PDO::FETCH_ASSOC)) {$record[] =$row;}} 
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>Colleges in Kolkata, list of colleges in kolkata | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="colleges in kolkata, kolkata colleges, list of colleges in kolkata, colleges in calcutta, calcutta colleges, ba / bsc colleges in kolkata, ba / bsc colleges in calcutta, ug colleges, ug colleges kolkata, ug colleges in kolkata, pg colleges, pg colleges kolkata, pg colleges in kolkata, under graduate colleges, under graduate colleges kolkata, under graduate colleges in kolkata, under graduate colleges, under graduate colleges kolkata, under graduate colleges in kolkata, post graduate colleges, post graduate colleges kolkata, post graduate colleges in kolkata, post graduate college in kolkata, post graduate college, post graduate college kolkata, under graduate college in kolkata, under graduate college, under graduate college kolkata, kolkata colleges list">
<meta name="description" content="List of Under Graduate (UG) and Post Graduate (PG) Colleges in Kolkata, List of Colleges in Kolkata, kolkata college list.">
<meta property="og:title" content="Colleges in Kolkata, list of colleges in kolkata | <?php echo SITE_NAME;?>">
<meta property="og:description" content="List of Under Graduate (UG) and Post Graduate (PG) Colleges in Kolkata, List of Colleges in Kolkata, kolkata college list.">
<meta property="og:image" content="<?php echo BASE_URL;?>/images/kolkata-colleges.jpg">
<meta property="og:url" content="<?php echo BASE_URL;?>/kolkata-colleges.php">
<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>
</head>
<body>
	<?php include("header.php");?>
    <?php include("menu.php");?>    
    <section class="bg-light">
        <div class="container-fluid page_header">
            <div class="row">
                <div class="col-md-10 listing_header">
                    <img src="<?php echo BASE_URL;?>/images/kolkata-colleges.png" alt="logo" title="logo">
                    <a href="<?php echo BASE_URL;?>/kolkata-colleges.php" title="colleges in kolkata">
                        <h1>List of Colleges in Kolkata</h1>
                    </a>
                    <span class="subType1">
                        <i class="fa fa-map-marker"></i> <a href="<?php echo BASE_URL;?>/kolkata-colleges.php" title="kolkata colleges list">Kolkata</a>, <a href="" title="">West Bengal</a>, <a href="" title="">India</a>
                    </span>
                    <span class="subType2">
                        <i class="fas fa-university"></i> <a href="" title="list">All Universities</a>
                    </span>
                </div>
                <div class="col-md-2">
                    <?php if(SHOW_C_PAGE_HEADER_ADM_LINK==1) {?>
                    <a class="btn btn-danger w-100 p-2 pb-2 mt-4" href="">
                        <i class="fas fa-desktop"></i> <span class="faa-flash animated text-uppercase text-light">Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></span>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                	<div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert alert-info p-3" style="font-family:Oswald"><i class="fas fa-building"></i> List of Colleges in Kolkata</h4>
                        </div>
                    </div>
                    
                	<div class="row bg-light pt-4 pb-4 m-0 listing" style="font-family:'Viga'">                        
                        
						<?php ?>
						<?php 
							$i=0;
							foreach($record as $rec){
							$i=$i+1;
                        ?>
                        
                        <div class="col-md-3 mb-4">
                            <div class="img-thumbnail">
                                <div class="row">
                                	<div class="col-12">
                                    	<a href="<?php echo BASE_URL;?>/<?php echo $rec["folder_name"];?>/<?php echo $rec["file_name"];?>" title="<?php echo $rec["college_name"];?>, <?php echo $rec["city_name"];?>">
                                            <div class="listing_banner">
                                            <img class="img-fluid border p-1" src="<?php echo BASE_URL_UPLOADS;?>/college/banner_image/<?php echo $rec["banner_img"];?>" alt="" onerror="this.src='<?php echo BASE_URL;?>/images/no-image.jpg';">
                                            </div>
                                            <div class="ms-2 listing_logo">
                                                <img class="bg-white p-1 rounded d-block" src="<?php echo BASE_URL_UPLOADS;?>/college/logo_image/<?php echo $rec["logo_img"];?>" alt="" onerror="this.src='<?php echo BASE_URL;?>/images/no-logo.jpg';"> 
                                            </div>
                                            <div class="border-bottom pb-1">
                                                <span class="text-danger">
													<?php echo $rec["college_name"];?> 
													<?php if($rec["shortName"]!='') {?>[<?php echo $rec["shortName"];?>]<?php } ?>
                                                </span><br>
                                                <span class="text-dark"><?php echo $rec["city_name"];?>, <?php echo $rec["state_name"];?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="row mt-2">
                                	<div class="col-6 listing_links">                                    	
                                        <a class="btn border btn-sm w-100 mb-2" href="<?php echo BASE_URL;?>/<?php echo $rec["folder_name"];?>/courses.php" title="<?php echo strtolower ($rec["college_name"]);?> courses offered"><i class="fas fa-book-reader"></i> Courses Offered</a>
                                    </div>
                                	<div class="col-6 listing_links">
                                    <a class="btn border btn-sm w-100 mb-2" href="<?php echo BASE_URL;?>/<?php echo $rec["folder_name"];?>/admission_notice.php" title="<?php echo strtolower ($rec["college_name"]);?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>"><i class="fas fa-desktop"></i> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></a>
                                    </div>
                                	<div class="col-6 listing_links">
										<a class="btn border btn-sm w-100 mb-2" href="<?php echo BASE_URL;?>/<?php echo $rec["folder_name"];?>/applynow.php" title="apply online for <?php echo strtolower ($rec["college_name"]);?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>"><i class="fas fa-edit"></i> Apply Now <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></a>
                                    </div>
                                	<div class="col-6 listing_links">
										<a class="btn border btn-sm w-100 mb-2" href="<?php echo BASE_URL;?>/<?php echo $rec["folder_name"];?>/meritlist.php" title="<?php echo strtolower ($rec["college_name"]);?> merit list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>"><i class="fa fa-list-ol"></i> Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></a>
                                    </div>
                                	<div class="col-12 listing_links">
										<a class="btn border btn-sm w-100 mb-1" href="<?php echo BASE_URL;?>/<?php echo $rec["folder_name"];?>/<?php echo $rec["file_name"];?>" title="<?php echo strtolower ($rec["college_name"]);?> <?php echo strtolower ($rec["city_name"]);?>"><i class="fas fa-file-alt"></i> View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <?php ?>                        
                    </div>
                    
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                        	<?php include("google_ads_contextual.php");?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
	<?php include("footer.php");?>
    <?php include("footer_includes.php");?>
    
    <?php $dbConn =NULL; ?>
</body>
</html>