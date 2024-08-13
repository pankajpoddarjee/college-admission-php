<?php

include("../../connection.php");
include("../../configuration.php");
session_start();



if(isset($_GET['jid']))
{
	$journal_id =$_GET['jid'];

	$journalQuery = $dbConn->prepare("select * from journal WHERE id=$journal_id");
	$journalQuery->execute();
	$journalRecord = $journalQuery->fetch(PDO::FETCH_ASSOC);

	$dbConn =NULL;
	$res = [
		'status' => 1,
		'record' =>$journalRecord
	];
	echo json_encode($res);
	return;
}	

if(isset($_GET['did']))
{

	$deleted_at   			= date("Y-m-d H:i:s");
	$deleted_by   			= isset($_SESSION['userid'])?$_SESSION['userid']:"";

	$journal_id =$_GET['did'];

	$journalQuery = $dbConn->prepare("UPDATE journal SET is_deleted = '1', deleted_at = '$deleted_at',deleted_by = '$deleted_by' where id=$journal_id");
	$journalQuery->execute();
	$journalRecord = $journalQuery->fetch(PDO::FETCH_ASSOC);

	$dbConn =NULL;
	$res = [
		'status' => 1
	];
	echo json_encode($res);
	return;
}

if(isset($_GET['statusid']) )
{


	$journal_id =$_GET['statusid'];
	$status = $_GET['status'];
	if($status==1){
		$newStatus = 0;
	}else{
		$newStatus = 1;
	}

	$journalQuery = $dbConn->prepare("UPDATE journal SET is_active = '$newStatus' where id=$journal_id");
	$journalQuery->execute();
	$journalRecord = $journalQuery->fetch(PDO::FETCH_ASSOC);

	$dbConn =NULL;
	$res = [
		'status' => 1
	];
	echo json_encode($res);
	return;
}
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

$journal_id   			= transformInput2($_POST["journal_id"]);
$paper_title   			= transformInput2($_POST["paper_title"]);
$author_name			= transformInput2($_POST["author_name"]);
$department_of_teacher	= transformInput2($_POST["department_of_teacher"]);
$teacher_name			= transformInput2($_POST["teacher_name"]);
$journal_name   		= transformInput2($_POST["journal_name"]);
$year_of_publication   	= transformInput2($_POST["year_of_publication"]);
$issn_no   				= transformInput2($_POST["issn_no"]);
$website_link   		= transformInput2($_POST["website_link"]);
$article_link   		= transformInput2($_POST["article_link"]);
$upload_date   			= transformInput2($_POST["upload_date"]);
$created_at   			= date("Y-m-d H:i:s");
$created_by   			= isset($_SESSION['userid'])?$_SESSION['userid']:"";
$update_at   			= date("Y-m-d H:i:s");
$updated_by   			= isset($_SESSION['userid'])?$_SESSION['userid']:"";


			
$journalQuery="";
//echo "jid - $journal_id";
if(!empty($journal_id) && isset($journal_id)){
$journalQuery = "UPDATE journal SET paper_title = '$paper_title', author_name = '$author_name',department_of_teacher = '$department_of_teacher',teacher_name = '$teacher_name', journal_name = '$journal_name',year_of_publication = '$year_of_publication', issn_no = '$issn_no',website_link = '$website_link', upload_date = '$upload_date',update_at = '$update_at', updated_by = '$updated_by' WHERE id = $journal_id";
}else{
	$journalQuery = "INSERT INTO journal(paper_title, author_name, department_of_teacher,teacher_name, journal_name, year_of_publication, issn_no, website_link, article_link, upload_date, created_at, created_by) values('".$paper_title."','".$author_name."','".$department_of_teacher."','".$teacher_name."','".$journal_name."','".$year_of_publication."','".$issn_no."','".$website_link."','".$article_link."','".$upload_date."','".$created_at."','".$created_by."');" ; 
}


$statusarr =array();
		
		$result =$dbConn->query($journalQuery); 
		
	 
		$dbConn= NULL;
		
		
		if($result) {
			
			$statusarr["status"]=1;
			$statusarr["msg"]="Successfully inserted ";
			
			echo json_encode($statusarr); 
		}
		else
		{
			$statusarr["status"]=0;
		//	$statusarr["msg"]=checkforMobleNo();
			
			$statusarr["msg"]="There is some problem with the data. Please Try again";
			
			echo json_encode($statusarr); 
		}

		
		
?>