<?php

include_once("../session.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");

$client_id = $_SESSION['userid']; 

// Fetch ad records for the client
$ad_records = [];
$strsql = "SELECT * FROM ads WHERE client_id = :client_id";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
$stmt->execute();
$ad_records = $stmt->fetchAll(PDO::FETCH_ASSOC);

//echo "<pre>"; print_r($ad_records);

// Extract ad IDs from records
$ad_ids = array_column($ad_records, 'id');
//print_r($ad_ids);

// Prepare the placeholder for the IN clause
$in_placeholder = implode(',', array_fill(0, count($ad_ids), '?'));

// Fetch click counts from `ad_clicks` for each `ad_id`
if (!empty($ad_ids)) {
    $strsql = "SELECT ad_id, COUNT(*) AS click_count FROM ad_clicks WHERE ad_id IN ($in_placeholder) GROUP BY ad_id";
    $stmt = $dbConn->prepare($strsql);
    $stmt->execute($ad_ids);
    $click_counts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
  // echo "<pre>Click Counts:\n"; print_r($click_counts);
} else {
    echo "No ads found for the client.";
}
$dbConn = null;
?>


<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>Dashboard | <?php echo COLLEGE_NAME; ?></title>
<?php include("../head_includes.php");?>
<!--<style type="text/css">
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>-->
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <div class="pl-3 pr-3 pt-0 mt-5">
            <div class="row justify-content-center" style="margin-top:13vh; margin-bottom:13vh">                
                <div class="col-md-12 mb-1 text-center">
                    <i class="fa-solid fa-graduation-cap info2 mb-2 text-secondary" style="font-size:90px"></i>
                    <h3 class="m-0" style="font-family:Roboto">Welcome to</h3>
                	<h1 class="m-0 text-danger" style="font-family:Oswald; font-size:36px"><?php echo COLLEGE_NAME;?></h1>
                </div>
                
                <div class="col-md-12 mb-1 text-center">
                	<hr>
                </div>

                <?php 
                if($click_counts){
                    foreach ($click_counts as $value) {
                        $ad_image_file = getAdImageByAdId($value['ad_id']); 
                        ?>
                            <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                                <img class="img-fluid" src="<?php echo BASE_URL_UPLOADS.'/ad/'.$ad_image_file;?>" ><h2>Click : <?php echo $value['click_count'] ?></h2>
                        </div>
                <?php    }
                }

                ?>
                
                
                
                <!-- <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                	<?php //echo !empty($userRecord[0]['department_name'])?$userRecord[0]['department_name']:"N/A"; ?>
                </div>
                
                <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                	<?php //echo !empty($userRecord[0]['designation'])?$userRecord[0]['designation']:"N/A"; ?>
                </div>
                 -->
                <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                	<?php //echo !empty($userRecord[0]['mobile'])?$userRecord[0]['mobile']:""; ?>
                </div>
                
                <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                	<?php// echo !empty($userRecord[0]['email'])?$userRecord[0]['email']:""; ?>
                </div>
                
               
            </div>
        </div>
        
        <div class="clearfix"></div>
        
        <div class="pl-5 pr-5 pt-0">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6 text-center">
                    <div id="appStats" class="steps_follow_animation3"></div>
                </div>
                
                <!--<div class="col-md-4 text-center">
                    <div id="categoryStats" class="steps_follow_animation3"></div>
                </div>
                
                <div class="col-md-4 text-center">
                    <div id="genderStats" class="steps_follow_animation3"></div>
                </div>-->
            </div>
        </div>
        
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html>