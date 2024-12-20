<?php

include_once("../session.php");
include_once("../connection.php");
include_once("../configuration.php");
//session_start();



// function transformInput2($val)
// {
// 	$finalval	=	trim($val);
	
// 	//$finalval 		=	ereg_replace("[ \t]+", " ", $finalval);
// 	$finalval		=	str_replace("\r\n","",$finalval);
// 	$finalval		=	str_replace("\n","",$finalval);
// 	$finalval 		= 	str_replace("'", "''",$finalval);
// 	$finalval 		= 	stripslashes($finalval);
// 	//$finalval = strtoupper($finalval);
	
// 	return $finalval;

// }	

function transformInput2($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	//$data = strip_tags($data);
	$data = htmlspecialchars($data);
	return $data;
}
$statusarr =array();


$old_password   	= transformInput2($_POST["old_password"]);
$password			= transformInput2($_POST["password"]);
$repassword			= transformInput2($_POST["repassword"]);
$updated_at   		= date("Y-m-d H:i:s");
$updated_by   		= isset($_SESSION['userid'])?$_SESSION['userid']:"";

	$user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";
	$userQuery = $dbConn->prepare("select * from users_admin WHERE id=$user_id");
	$userQuery->execute();
	$userRecord = $userQuery->fetch(PDO::FETCH_ASSOC);
	$dbPassword = $userRecord['password']; 

	if($dbPassword  != md5($old_password)){
		$statusarr["status"]=0;
		$statusarr["msg"]="Your Old password is incorrect.";
		echo json_encode($statusarr); 
		return;
	}
	if($password  != $repassword){
		$statusarr["status"]=0;
		$statusarr["msg"]="Your New Password and Re-Enter New Password does not match.";
		echo json_encode($statusarr); 
		return;
	}

	$update_password = md5($password);
	$updateQuery = "UPDATE users_admin SET password = '$update_password',updated_at = '$updated_at  ', updated_by = '$updated_by' WHERE id = $user_id";
	
	$result =$dbConn->query($updateQuery); 
	$dbConn= NULL;

	if($result) {
		$statusarr["status"]=1;
		$statusarr["msg"]="Successfully Updated ";
		echo json_encode($statusarr); 
	}
	else
	{
		$statusarr["status"]=0;
		$statusarr["msg"]="There is some problem with the data. Please Try again";
		echo json_encode($statusarr); 
	}



			


		
		
?>