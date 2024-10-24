<?php include('../settings.php');?>
<?php include("../connection.php");include("../function.php"); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>Add Post</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta property="og:title" content="">
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta property="og:url" content="">
<?php echo OTHER_META_TAGS;?>
<?php include("../head_includes.php");?>

</head>
<body>
	<?php include("../header.php");?>
    <?php include("../menu.php");?>
    
    <?php //include("../college_page_header.php");?>
    <?php //include("../college_page_menu.php");?>
    <style type="text/css">
	.active_overview{color:#FC0 !important;}
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
                            <h4 class="alert alert-info" title="<?php echo $college_name;?>, <?php echo $city_name;?>" style="font-family:Oswald"><i class="fas fa-building"></i> College Info</h4>
                        </div>
                    </div>
                	<div class="row">
                        <div class="col-md-12 mt-2">
                            <?php
                            if(isset($_SERVER['PATH_INFO'])){

                                $slug_url=$_SERVER['PATH_INFO'];

                                $sql="select * from colleges where slug='$slug_url'";
                                $stmt = $dbConn->prepare($sql);
                                $stmt->execute();
                                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            }
                            
                            else {
                                
                            $record = array();

                            $fetchallqry = "SELECT c.ID, college_name, ISNULL(c.short_name,'') AS shortName, college_type_id, c.slug, c.country_id, co.country_name, c.state_id, s.state_name, c.city_id, ci.city_name, c.banner_img, c.logo_img, c.folder_name, c.file_name FROM colleges c 
                            JOIN countries co ON c.country_id=co.ID 
                            JOIN [states] s ON c.state_id=s.ID 
                            JOIN cities ci ON c.city_id=ci.ID 
                            WHERE c.is_active=1 order by c.college_name";
                            /*WHERE c.city_id='1' AND c.is_active=1 order by c.college_name";*/
                            $qryresult = $dbConn->query($fetchallqry);if($qryresult) {while ($row=$qryresult->fetch(PDO::FETCH_ASSOC)) {$record[] =$row;}} ;

                            }

                            ?>
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
                                    	<a href="<?php echo BASE_URL;?>/college<?php echo $rec["slug"];?>" title="<?php echo $rec["college_name"];?>, <?php echo $rec["city_name"];?>">
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
                    
                    <?php include("../college_page_admission_links_H.php");?>
                    
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                        	<?php include("../google_ads_contextual.php");?>
                        </div>
                    </div>                    
                </div>
                <div class="col-md-3">
                	<?php //include("c_right_panel.php");?>
                </div>
            </div>
        </div>
    </section>
    
	<?php include("../footer.php");?>
    <?php include("../footer_includes.php");?>
    
    <?php $dbConn =NULL; ?>
</body>
</html>