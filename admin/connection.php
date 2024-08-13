<?php 
global $dbConn ;
$dbHost='169.38.84.125';
$dbName='CollegeAdmissionPortal';
$dbUser='CA_SIPL';      //by default root is user name.  
$dbPassword='Surya@2016';     //password is blank by default  
try{  
        $dbConn= new PDO("sqlsrv:server=$dbHost;Database=$dbName",$dbUser,$dbPassword); 
		//$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$dbConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);		
      
    } catch(Exception $e){  
    Echo "Connection failed" . $e->getMessage();  
    }

?>