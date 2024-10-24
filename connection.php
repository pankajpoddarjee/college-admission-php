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
   // echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>