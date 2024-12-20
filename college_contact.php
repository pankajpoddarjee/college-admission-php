<?php $slug_url = isset($_GET['slug']) ? "college/".$_GET['slug'] : '';  ?>
<?php include_once('settings.php');
include_once("connection.php");
include_once("function.php");
include_once("QRY_CAcollegeMainPage.php");
$collegeRecord = [];
$additional_contact = [];
$fetchallqry = "SELECT id,college_name  FROM colleges WHERE slug='".$slug_url."'";
$stmt = $dbConn->prepare($fetchallqry);
$stmt->execute();
$collegeRecord = $stmt->fetch(PDO::FETCH_ASSOC);
if(isset($collegeRecord)){
    $college_id = $collegeRecord['id'];
    $qry = "SELECT *  FROM additional_contacts WHERE parent_id='".$college_id."' AND type='college'";
    $stmt = $dbConn->prepare($qry);
    $stmt->execute();
    $additional_contact = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//print_r($additional_detail);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $record['college_name'];?> Notice <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo $college_name;?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, <?php echo $college_name;?> merit list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, <?php echo $college_name;?> contact">
<meta name="description" content="<?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta property="og:title" content="<?php echo $record['college_name'];?> Notice <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?>">
<meta property="og:description" content="<?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">

<meta property="og:image" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $banner_img;?>">
<meta property="og:url" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $file_name;?>">

<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>

<style type="text/css">
    .notice_list{list-style-type:none; padding:0 0 0 15px; margin:0}
    .notice_list li{font-family:Nunito; font-size:14px; font-weight:bold; border-bottom:1px dashed #d2d2d2; padding:7px 2px;}
    .notice_list li a{color:#004ecc}
    .notice_list li a img{width:45px}
    .notice_list li .p_date{font-family:Montserrat; font-size:12px; font-weight:600; color:#444}
    .notice_list li .new_tag{font-size:9px; vertical-align:top}
</style>

</head>
<body>
	<?php include("header.php");?>
    <?php include("menu.php");?>
    
    <?php include("college_page_header.php");?>
    <?php include("college_page_menu.php");?>
    <style type="text/css">
	.active_list{color:#FC0 !important;}
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
                            <h4 class="alert alert-info" title="<?php echo strtolower($college_name);?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>" style="font-family:Oswald"><i class="fa-solid fa-bullhorn"></i> Contact Us </h4>
                        </div>
                    </div>
                	<div class="row">
                        <div class="col-md-12 mt-2">
                            <ul class="notice_list">
                                
                                <li>
                                    College Name: <?php echo !empty($college_name)?$college_name:"" ?>
                                </li>
                                <li>
                                    Address: <?php echo !empty($address)?$address:"" ?>
                                </li>
                                <li>
                                    Landmark: <?php echo !empty($landmark)?$landmark:"" ?>
                                </li>
                                <li>
                                    Country: <?php echo !empty($country_name)?$country_name:"" ?>
                                </li>
                                <li>
                                    State: <?php echo !empty($state_name)?$state_name:"" ?>
                                </li>
                                <li>
                                    District: <?php echo !empty($district_name)?$district_name:"" ?>
                                </li>
                                <li>
                                    City: <?php echo !empty($city_name)?$city_name:"" ?>
                                </li>
                                <li>
                                    Email 1: <?php echo !empty($email)?$email:"" ?>
                                </li>
                                <li>
                                    Email 2: <?php echo !empty($email2)?$email2:"" ?>
                                </li>
                                <li>
                                    Website: <a href="<?php echo !empty($websiteURL)?$websiteURL:"" ?>" target="_blank"><?php echo !empty($websiteDisplay)?$websiteDisplay:"" ?></a>                                        
                                </li>
                                <li>
                                    Phone: <?php echo !empty($phone)?$phone:"" ?>
                                </li>
                            </ul>
                            
                            <br><br><br>
                            <?php if(isset($additional_contact) && count($additional_contact) > 0) { 
                                        foreach ($additional_contact as $value) {
                                            //print_r($value);
                                ?>      
                            <ul class="notice_list">    
                                                      
                                <li>
                                    Address Type: <?php echo !empty($value['additional_address_type'])?$value['additional_address_type']:"" ?>
                                </li>
                                <li>
                                    Address : <?php echo !empty($value['additional_address'])?$value['additional_address']:"" ?>
                                </li>
                                <li>
                                    Email: <?php echo !empty($value['additional_email'])?$value['additional_email']:"" ?>
                                </li>
                                <li>
                                    Phone: <?php echo !empty($value['additional_phone'])?$value['additional_phone']:"" ?>
                                </li>
                                <li>
                                    Website: <?php echo !empty($value['additional_website'])?$value['additional_website']:"" ?>
                                </li>
                                
                               
                            </ul>
                            <?php echo "<br><br><br>"; } } ?>
                            
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