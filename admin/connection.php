<?php 
// global $dbConn ;
// $dbHost='169.38.84.125';
// $dbName='CollegeAdmissionPortal';
// $dbUser='pankaj';      //by default root is user name.  
// $dbPassword='pankaj@123#';     //password is blank by default  
// try{  
//         $dbConn= new PDO("sqlsrv:server=$dbHost;Database=$dbName",$dbUser,$dbPassword); 
// 		//$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 		//$dbConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);		
      
//     } catch(Exception $e){  
//     Echo "Connection failed" . $e->getMessage();  
//     }

?>
<?php

$serverName = "169.38.84.125"; // or your server's IP or name
$connectionOptions = array(
"Database" => "CollegeAdmissionPortal",
"Uid" => "CA_SIPL",
"PWD" => "Surya@2016",
"TrustServerCertificate" => true // Disable certificate validation
);

try {
$dbConn = new PDO("sqlsrv:server=$serverName;Database=" . $connectionOptions['Database'] . ";TrustServerCertificate=true", $connectionOptions['Uid'], $connectionOptions['PWD']);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "Connection successful!";
} catch (PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}
?>
