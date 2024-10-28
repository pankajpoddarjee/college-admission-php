<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";



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


$statusarr =array();


$company_name   				= sanitize_string($_POST["company_name"]);
$client_name			= sanitize_string($_POST["client_name"]);
$mobile					= sanitize_string($_POST["mobile"]);
$updated_at   			= date("Y-m-d H:i:s");
$updated_by   			= isset($_SESSION['userid'])?$_SESSION['userid']:"";



	$user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";
	$userQuery="";
	$userQuery = "UPDATE clients SET company_name = '$company_name', client_name = '$client_name',mobile = '$mobile',updated_at = '$updated_at', updated_by = '$updated_by' WHERE id = $user_id";
	
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