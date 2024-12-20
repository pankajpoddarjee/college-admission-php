
<?php $slug_url = isset($_GET['slug']) ? "notice/".$_GET['slug'] : '';  ?>
<?php include_once('settings.php');
include_once("connection.php");

//include("function.php");
//include_once("QRY_CAcollegeMainPage.php");

$records = [];
$fetchallqry = "SELECT id, notice_for, notice_title, tags, description, slug, notice_type, url_link, page_link  FROM notices WHERE slug='".$slug_url."'";
$stmt = $dbConn->prepare($fetchallqry);
$stmt->execute();
$records = $stmt->fetch(PDO::FETCH_ASSOC);
//echo "<pre>"; print_r($records);
?>

<?php 
    if($records['notice_for'] == 1){
        include_once("notice-detail-college.php");
    } 
    if($records['notice_for'] == 2){
        include_once("notice-detail-university.php");
    } 
    if($records['notice_for'] == 3){
        include_once("notice-detail-exam.php");
    } 
?>