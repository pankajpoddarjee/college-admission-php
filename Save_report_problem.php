<?php
include_once "connection.php";
include_once "configuration.php";


function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // Check if the IP is passed from a shared Internet service
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Check if the IP is passed from a proxy
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Return the remote address
        return $_SERVER['REMOTE_ADDR'];
    }
}

$ip_address = getUserIP();



// Get the User-Agent string
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Parse the User-Agent string for more details
function getBrowserDetails($userAgent) {
    $browser = "Unknown Browser";
    
    // Check the User-Agent string for different browsers
    if (preg_match('/MSIE/i', $userAgent) && !preg_match('/Opera/i', $userAgent)) {
        $browser = "Internet Explorer";
    } elseif (preg_match('/Firefox/i', $userAgent)) {
        $browser = "Mozilla Firefox";
    } elseif (preg_match('/Chrome/i', $userAgent)) {
        $browser = "Google Chrome";
    } elseif (preg_match('/Safari/i', $userAgent)) {
        $browser = "Apple Safari";
    } elseif (preg_match('/Opera/i', $userAgent)) {
        $browser = "Opera";
    } elseif (preg_match('/Netscape/i', $userAgent)) {
        $browser = "Netscape";
    }

    return $browser;
}

$browser = getBrowserDetails($userAgent);

function sanitize_string($str) {
    $str = trim($str); // Remove whitespace from both sides
    $str = stripslashes($str); // Remove backslashes
	$str = strip_tags($str);
    $str = htmlspecialchars($str); // Convert special characters to HTML entities
    return $str;
} 
session_start();
$statusarr = [];
// Check if the form is submitted
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the CAPTCHA value from the session
    $captcha = $_SESSION['captcha'];

    // Get the CAPTCHA input from the user
    $userInput = $_POST['captcha'];

    // Validate the CAPTCHA
    if ($userInput === $captcha) {
        $status = "pending";
        $name = sanitize_string($_POST["name"]);
        $email = sanitize_string($_POST["email"]);
        $mobile = sanitize_string($_POST["mobile"]);
        $report_problem_url = sanitize_string($_POST["report_problem_url"]);
        $report_problem_description = sanitize_string($_POST["report_problem_description"]);  
        $created_at = date("Y-m-d H:i:s"); 

        // $ip_address = $_SERVER['REMOTE_ADDR'];
        // $browser = $_SERVER['HTTP_USER_AGENT'];
        $sql = "INSERT INTO report_problem (name,email,mobile,report_problem_url,report_problem_description,ip_address,browser,status, created_at) 
                VALUES (:name, :email, :mobile, :report_problem_url, :report_problem_description, :ip_address, :browser, :status, :created_at)";

        // Log or print the query for debugging
        error_log("Executing query: $sql");

        // Bind parameters and execute
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":mobile", $mobile, PDO::PARAM_STR);
        $stmt->bindParam(":report_problem_url", $report_problem_url, PDO::PARAM_STR);
        $stmt->bindParam(":report_problem_description", $report_problem_description, PDO::PARAM_STR);
        $stmt->bindParam(":ip_address", $ip_address, PDO::PARAM_STR);
        $stmt->bindParam(":browser", $browser, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Data inserted successfully";
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] = "There is some problem with the data. Please try again.";
            
            // Log the error
            $errorInfo = $stmt->errorInfo();
            error_log("SQLSTATE: " . $errorInfo[0]);
            error_log("SQL Error: " . $errorInfo[2]);
        }
       // echo "CAPTCHA verification passed. Process the form data.";
        // Continue processing the form (e.g., save data, send email, etc.)
    } else {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "CAPTCHA verification failed. Please try again.";
        //echo "CAPTCHA verification failed. Please try again.";
    }
//}
// Proceed with the form data processing


echo json_encode($statusarr);
return;
?>
