<?php

include("../../connection.php");
include("../../configuration.php");
session_start();



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
	$data = strip_tags($data);
	$data = htmlspecialchars($data);
	return $data;
}
$statusarr =array();


$name   				= transformInput2($_POST["name"]);
$designation			= transformInput2($_POST["designation"]);
$mobile					= transformInput2($_POST["mobile"]);
$updated_at   			= date("Y-m-d H:i:s");
$updated_by   			= isset($_SESSION['userid'])?$_SESSION['userid']:"";



	$user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";
	$userQuery="";
	$userQuery = "UPDATE users SET name = '$name', designation = '$designation',mobile = '$mobile',updated_at = '$updated_at  ', updated_by = '$updated_by' WHERE id = $user_id";
	
	$result =$dbConn->query($userQuery); 
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