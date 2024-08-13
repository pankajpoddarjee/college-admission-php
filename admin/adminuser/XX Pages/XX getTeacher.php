<?php
include("../../connection.php");
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

if(isset($_GET['dep_id']))
{
	$department_id =$_GET['dep_id'];

	$staterecord =array();
    $user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";

    $stateqry = "select * from users WHERE department=$department_id";

    if( $_SESSION['usertype'] == 2 && $_SESSION['department_id'] != 0){ 
        $stateqry .= " and id = $user_id";
    }

    $stateresult = $dbConn->query($stateqry);

    if($stateresult) {
        while ($staterow=$stateresult->fetch(PDO::FETCH_ASSOC)){
            
                    $staterecord[] = $staterow;
                }
    }

    $stateresult =NULL;
    $dbConn =NULL;

    echo json_encode($staterecord);
}	



?>