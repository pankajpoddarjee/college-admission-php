<?php

$ip_address = $_SERVER['REMOTE_ADDR'];  // Get user's IP address
$max_requests = 10;
$time_window = 60;  // 1 minute
$current_time = time();

// Connect to database (assuming $dbConn is your PDO connection object)

// Check if the IP address exists in the database
$query = $dbConn->prepare("SELECT * FROM throttle_logs WHERE ip_address = :ip");
$query->execute([':ip' => $ip_address]);
$record = $query->fetch(PDO::FETCH_ASSOC);

if ($record) {
    // Calculate time difference
    $time_difference = $current_time - $record['start_time'];

    if ($time_difference > $time_window) {
        // Reset if time window has passed
        $query = $dbConn->prepare("UPDATE throttle_logs SET request_count = 1, start_time = :start_time WHERE ip_address = :ip");
        $query->execute([':start_time' => $current_time, ':ip' => $ip_address]);
    } else {
        // Increment the request count
        if ($record['request_count'] >= $max_requests) {
            http_response_code(429);  // Too Many Requests
            echo "Rate limit exceeded. Please try again later.";
            exit();
        } else {
            $query = $dbConn->prepare("UPDATE throttle_logs SET request_count = request_count + 1 WHERE ip_address = :ip");
            $query->execute([':ip' => $ip_address]);
        }
    }
} else {
    // Insert new record for this IP address
    $query = $dbConn->prepare("INSERT INTO throttle_logs (ip_address, request_count, start_time) VALUES (:ip, 1, :start_time)");
    $query->execute([':ip' => $ip_address, ':start_time' => $current_time]);
}

// Your page logic here
//echo "Welcome to the page!";


?>