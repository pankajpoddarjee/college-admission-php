<?php

include_once "connection.php";

function sanitize_string($str) {
    $str = trim($str); // Remove whitespace from both sides
    $str = stripslashes($str); // Remove backslashes
	$str = strip_tags($str);
    $str = htmlspecialchars($str); // Convert special characters to HTML entities
    return $str;
} 
function generateSlug($string) {
    // Convert the string to lowercase
    $slug = strtolower($string);

    // Replace non-alphanumeric characters with hyphens
    $slug = preg_replace('/[^a-z0-9]+/i', '-', trim($slug));

    // Remove leading and trailing hyphens
    $slug = trim($slug, '-');
    return $slug;
}

function validateBannerImage($file) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    $errors = [];

    // Check if the file was uploaded
    if (!isset($file) || $file['error'] != UPLOAD_ERR_OK) {
        $errors[] = 'File upload error.';
        return $errors;
    }

    if ($file['size'] > $maxFileSize) {
        $errors[] = 'File size should be less than 2MB';
        return $errors;
    }

    // Validate file type
    $fileType = mime_content_type($file['tmp_name']);
    if (!in_array($fileType, $allowedTypes)) {
        $errors[] = 'Invalid file type. Only images are allowed.';
    }

    return $errors;
}

function validateLogoImage($file) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    $errors = [];

    // Check if the file was uploaded
    if (!isset($file) || $file['error'] != UPLOAD_ERR_OK) {
        $errors[] = 'File upload error.';
        return $errors;
    }

    if ($file['size'] > $maxFileSize) {
        $errors[] = 'File size should be less than 2MB';
        return $errors;
    }

    // Validate file type
    $fileType = mime_content_type($file['tmp_name']);
    if (!in_array($fileType, $allowedTypes)) {
        $errors[] = 'Invalid file type. Only images are allowed.';
    }

    return $errors;
}

function getCourseTypeNameById($course_type_id){
    global $dbConn;
    $sql = "select course_type_name from course_types WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $course_type_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    return $course_type_name = !empty($records['course_type_name'])?$records['course_type_name']:"N/A";     
}
function getStreamNameById($stream_id){
    global $dbConn;
    $sql = "select stream_name,short_name from streams WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $stream_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    $short_name = !empty($records['short_name'])?" (".$records['short_name'].") ":"";  
    return $course_type_name = !empty($records['stream_name'])?$records['stream_name'].$short_name:"N/A";     
}
function getSubjectNameById($subject_id){
    $records = [];
    $subjectArr = [];
    global $dbConn;
    $sql = "select subject_name from subjects WHERE id IN ($subject_id)";
    $stmt = $dbConn->prepare($sql);
    //$stmt->bindParam(":id", $subject_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($records)>0){
        foreach ($records as  $value) {
            $subjectArr[] =  $value['subject_name'];
        }
    }
    return $subject_name = (count($subjectArr)>0)?implode(", ",$subjectArr):"N/A";     
}

?>

