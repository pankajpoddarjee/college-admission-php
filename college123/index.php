<?php include('../settings.php');?>
<?php include("../connection.php");include("../function.php");

if(isset($_SERVER['PATH_INFO'])){


    $slug_url=$_SERVER['PATH_INFO'];

    //$sql="select * from colleges where slug='$slug_url'";
    $sql="SELECT c.ID, college_name, ISNULL(c.short_name,'') AS shortName, college_type_id, c.slug, c.country_id, co.country_name, c.state_id, s.state_name, c.city_id, ci.city_name, c.banner_img, c.logo_img, c.folder_name, c.file_name FROM colleges c 
    JOIN countries co ON c.country_id=co.ID 
    JOIN [states] s ON c.state_id=s.ID 
    JOIN cities ci ON c.city_id=ci.ID 
    WHERE c.slug='$slug_url' AND c.is_active=1 order by c.college_name";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //echo "<pre>";
    //print_r($records);

}


?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $records[0]['college_name'];?>, <?php echo $city_name;?> - Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo $college_name;?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, <?php echo $college_name;?> merit list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, <?php echo $college_name;?> contact">
<meta name="description" content="<?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission / Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Courses <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Contact">
<meta property="og:title" content="<?php echo $college_name;?>, <?php echo $city_name;?> - Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?>">
<meta property="og:description" content="<?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission / Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Courses <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Contact">
<meta property="og:image" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $banner_img;?>">
<meta property="og:url" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $file_name;?>">
<?php echo OTHER_META_TAGS;?>
<?php include("../head_includes.php");?>
</head>
<body>
	<?php include("../header.php");?>
    <?php include("../menu.php");?>
    
    <?php include("../college_page_header.php");?>
    <?php include("../college_page_menu.php");?>
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

                        echo $records[0]['college_name'];
                        echo $records[0]['slug'];

                        }
                        else {
                        echo "All College List";
                        }

                        ?>



                            <?php include("../collegeInfoMainTable.php");?>
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