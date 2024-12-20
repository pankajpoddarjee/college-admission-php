<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "connection.php"; // Ensure this file is included
include_once "function.php"; // Ensure this file is included
include_once "configuration.php"; // Ensure this file is included

// Get the parameters (e.g., ad_id, browser, platform, etc.) passed via query string or request body
$ad_id = $_GET['ad_id'] ?? null;

$deviceDetails = getBrowserAndPlatform();  // Fixed typo
$browser = $deviceDetails['browser'] ?? 'unknown';
$platform = $deviceDetails['platform'] ?? 'unknown';
$device = getDeviceType() ?? 'unknown';
$ip_address = getUserIP() ?? 'unknown';
$city = getUserCity($ip_address) ?? 'unknown';
$clicked_at = date("Y-m-d H:i:s");

if ($ad_id) {
    // Prepare SQL query for inserting ad impression
    $insert_sql = "INSERT INTO ad_impressions (ad_id, browser, platform, device, ip_address, city, clicked_at) 
                   VALUES (:ad_id, :browser, :platform, :device, :ip_address, :city, :clicked_at)";
    
    try {
        // Prepare statement
        $stmt = $dbConn->prepare($insert_sql);

        // Bind parameters
        $stmt->bindValue(':ad_id', $ad_id, PDO::PARAM_INT);
        $stmt->bindValue(':browser', $browser, PDO::PARAM_STR);
        $stmt->bindValue(':platform', $platform, PDO::PARAM_STR);
        $stmt->bindValue(':device', $device, PDO::PARAM_STR);
        $stmt->bindValue(':ip_address', $ip_address, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':clicked_at', $clicked_at, PDO::PARAM_STR);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Ad impression logged successfully!";
        } else {
            error_log("Error executing the SQL query.");
        }
    } catch (PDOException $e) {
        // Handle errors and provide more context if needed
        error_log("Error preparing statement: " . $e->getMessage());
    }
} else {
    // If ad_id is missing
    echo "Ad ID is required!";
}
?>
