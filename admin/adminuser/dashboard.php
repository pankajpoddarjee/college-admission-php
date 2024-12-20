<?php 
include_once("../session.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");


//All  users record
$userRecord = [];
$user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";

$userSql = "select users_admin.name,users_admin.email,users_admin.mobile,users_admin.designation,users_admin.is_active FROM users_admin WHERE users_admin.id = $user_id";

$userQry = $dbConn->prepare($userSql);
$userQry->execute();
$userRecord = $userQry->fetchAll(PDO::FETCH_ASSOC);
//print_r($userRecord);
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
                
                <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                	<?php echo !empty($userRecord[0]['name'])?$userRecord[0]['name']:""; ?>
                </div>
                
                <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                	<?php echo !empty($userRecord[0]['department_name'])?$userRecord[0]['department_name']:"N/A"; ?>
                </div>
                
                <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                	<?php echo !empty($userRecord[0]['designation'])?$userRecord[0]['designation']:"N/A"; ?>
                </div>
                
                <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                	<?php echo !empty($userRecord[0]['mobile'])?$userRecord[0]['mobile']:""; ?>
                </div>
                
                <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                	<?php echo !empty($userRecord[0]['email'])?$userRecord[0]['email']:""; ?>
                </div>
                
                <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter">

                    <?php if($userRecord[0]['is_active'] == 1) {?>
                	<span class="badge badge-success pt-2 pb-2 pl-3 pr-3">                        
                    <i class="fa fa-thumbs-o-up"></i> Active</span>
                    <?php } else{?>
                        <span class="badge badge-danger pt-2 pb-2 pl-3 pr-3">                        
                        <i class="fa fa-thumbs-o-down"></i> Inactive</span>
                    <?php } ?>
                    
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