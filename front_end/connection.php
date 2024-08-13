<?php /*?><?php 
global $dbConn ;
$dbHost='169.62.151.211';
$dbName='CollegeAdmission';
$dbUser='sa';
$dbPassword='Sipl@2016';
try{  
	$dbConn= new PDO("sqlsrv:server=$dbHost;Database=$dbName",$dbUser,$dbPassword); 
} catch(Exception $e){  
Echo "Connection failed" . $e->getMessage();  
}
?><?php */?>

<?php 
global $dbConn ;
$dbHost='169.38.84.125';
$dbName='CollegeAdmissionPortal';
$dbUser='CA_SIPL';      //by default root is user name.  
$dbPassword='Surya@2016';     //password is blank by default  
try{  
        $dbConn= new PDO("sqlsrv:server=$dbHost;Database=$dbName",$dbUser,$dbPassword); 
    } catch(Exception $e){  
    Echo "Connection failed" . $e->getMessage();  
    }
?>