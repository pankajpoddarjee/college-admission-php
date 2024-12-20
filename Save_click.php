<?php
include_once "connection.php"; // Ensure this file is included
include_once "function.php"; // Ensure this file is included
include_once "configuration.php"; // Ensure this file is included

// Get device details
$devideDetails = getBrowserAndPlatform();
$browser = $devideDetails['browser'];
$platform = $devideDetails['platform'];
$device = getDeviceType();
$ip_address = getUserIP();
$city = getUserCity($ip_address);
$clicked_at = date("Y-m-d H:i:s");

// Sanitize ad_id from GET request
$ad_id = isset($_GET['ad_id']) ? intval($_GET['ad_id']) : null;

if ($ad_id) {
    // Prepare the SQL statement
    $insert_sql = "INSERT INTO ad_clicks (ad_id, browser, platform, device, ip_address, city, clicked_at) 
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
            echo "New ad click recorded";
        } else {
            echo "Error inserting record: " . implode(", ", $stmt->errorInfo());
        }
    } catch (PDOException $e) {
        echo "Error preparing statement: " . $e->getMessage(); // Provide specific error
    }
} else {
    echo "Invalid ad_id"; // Improved error message
}

// Close connection (optional, PDO will close the connection automatically when the script ends)
$dbConn = null; 
?>
