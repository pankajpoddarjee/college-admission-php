<?php 
global $dbConn;

// Database connection details
$dbHost = '169.38.84.125';
$dbName = 'CollegeAdmissionPortal';
$dbUser = 'CA_SIPL';      
$dbPassword = 'Surya@2016'; 

try {  
    // Create a new PDO instance
    $dbConn = new PDO("sqlsrv:server=$dbHost;Database=$dbName", $dbUser, $dbPassword);
    
    // Set error mode to exception for better error handling
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Optional, depending on your needs

    // If connection is successful, show a success message
   // echo "Database connected successfully!";

} catch (PDOException $e) {  
    // Catch any PDO exceptions and display the error message
    echo "Connection failed: " . $e->getMessage();  
}
?>
