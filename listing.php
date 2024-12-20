<?php $slug_url = isset($_GET['slug']) ? $_GET['slug'] : '';  ?>
<?php include('settings.php');?>
<?php include("connection.php");include("function.php");
$masterSlugRecord = [];
$stmt = $dbConn->prepare("SELECT * FROM slug_master WHERE slug= :slug_url ");
$stmt->execute(['slug_url' => $slug_url]);
$masterSlugRecord = $stmt->fetch(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($masterSlugRecord);
$response_from = $masterSlugRecord['response_from'];
// echo "<pre>"; print_r($masterSlugRecord);

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $masterSlugRecord['title'];?> | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta property="og:title" content="">
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta property="og:url" content="">
<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>
<style>
.lds-roller {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  margin: -4px 0 0 -4px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s; background:#F00;
}
.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px; background: #007bff;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px; background: #6c757d;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px; background: #F36;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px; background: #28a745;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px; background: #dc3545;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px; background: #ffc107;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px; background: #17a2b8;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px; background: #B68F49;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
<!-- LOADER START-->    
<div id="dvLoading" style="display:none; position:fixed; top:0; left:0; background:rgba(0,0,0,0.8); width:100%; height:100%; padding:0; margin:0 auto; z-index:9999999999">
    <div class="lds-roller" style="padding:5px; border-radius:5px;height:100px;width:100px; position:absolute; top:50%; left:50%;margin-left:-50px;    margin-top:-50px; display:block;">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="text-white" style="padding:5px; border-radius:5px;height:100px;width:100px; position:absolute; top:50%; left:50%;margin-left:-50px; margin-top:30px; display:block;">Please wait...</div>
</div>
<!-- LOADER ENDS-->
</head>


<body>
    <div id="dvLoading" style="display:none"></div>
    <input type="hidden" name="slug" id="slug" value="<?php echo $slug_url; ?>">
    <input type="hidden" name="response_from" id="response_from" value="<?php echo $response_from; ?>">
	<?php include("header.php");?>
    <?php include("menu.php");?>    

    <?php if($response_from=='colleges'){ ?>
        <?php include("college_listing.php");?>
	  <?php } ?>

    

    <?php if($response_from=='universities'){ ?>
        <?php include("university_listing.php");?>
	  <?php } ?>

    <?php if($response_from=='exams'){ ?>
        <?php include("exam_listing.php");?>
	  <?php } ?>

    <?php include("footer.php");?>
    <?php include("footer_includes.php");?>


    <?php if($response_from=='colleges'){ ?>
        <script src="<?php echo BASE_URL;?>/js/collegeListing.js"></script>
    <?php } ?>
    <?php if($response_from=='universities'){ ?>
        <script src="<?php echo BASE_URL;?>/js/universityListing.js"></script>
    <?php } ?>
    <?php if($response_from=='exams'){ ?>
        <script src="<?php echo BASE_URL;?>/js/examListing.js"></script>
    <?php } ?>
     
    <?php $dbConn =NULL; ?>
</body>
</html>