
<?php
 ob_start();
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
 if (!$_SESSION["clientloggedin"] ) {
 header("location: ../login.php");
 exit();
 }

include_once("../connection.php");

include_once("../configuration.php");

//$adminusername = $_SESSION['user'];

$user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";
$userQuery = $dbConn->prepare("select * from clients WHERE id=$user_id");
$userQuery->execute();
$userRecord = $userQuery->fetch(PDO::FETCH_ASSOC);
$adminusername = $userRecord['company_name'];  
$designation = "Client";
/*
    $role =$_SESSION['usertype'];

	$roleQuery = $dbConn->prepare("select * from roles WHERE id=$role");
	$roleQuery->execute();
	$roleRecord = $roleQuery->fetch(PDO::FETCH_ASSOC);
    $usertype = $roleRecord['user_type'];  
    
$qry = "SELECT page_name FROM permission where ".$usertype."=1 ;";

$record = array();
$phase = array();
$resultset = $dbConn->query($qry);
			while($row=$resultset->fetch(PDO::FETCH_ASSOC))
			{
				$record[]=$row["page_name"];
			}
			
			$resultset = NULL;
			
 
 
function createURL($urlval){
	return strtolower(trim(BASE_URL.'/admin/adminuser/'.$urlval));
}



function url_origin( $s, $use_forwarded_host = false )
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false )
{
	
	 return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}
$permissionurlarr = array();
for($i=0; $i<count($record); $i++) {
$permissionurlarr[]= createURL($record[$i]);
} 

$absolute_url =strtolower(full_url($_SERVER )); 

if(!in_array(trim($absolute_url),$permissionurlarr)){
 header("location: ../permissionDenied.php ");
}


$user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";

$userSql = "select name,email,mobile,designation,usertype FROM users_admin WHERE id = $user_id";

$userQry = $dbConn->prepare($userSql);
$userQry->execute();
$loggedInUser = $userQry->fetchAll(PDO::FETCH_ASSOC);
*/

?>