
<?php
 ob_start();
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
 if (!$_SESSION["loggedin"] ) {
 header("location: ../login.php");
 exit();
 }

include_once("../connection.php");

include_once("../configuration.php");

$user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";
$userQuery = $dbConn->prepare("select * from users_admin WHERE id=$user_id");
$userQuery->execute();
$userRecord = $userQuery->fetch(PDO::FETCH_ASSOC);
$adminusername = $userRecord['name'];  
$designation = $userRecord['designation'];

//$adminusername = $_SESSION['user'];

$user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";
$lastPart = basename($_SERVER['REQUEST_URI']);


$sql = "SELECT * FROM permissions WHERE page_url = :page_url AND CHARINDEX(CONVERT(VARCHAR, :user_id), user_ids) > 0";
$stmt = $dbConn->prepare($sql);
$stmt->bindParam(":page_url", $lastPart, PDO::PARAM_STR);
$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
$stmt->execute();
$qryresult = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$qryresult){
    header("location: ../permissionDenied.php ");
}


?>