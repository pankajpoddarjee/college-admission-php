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

function validateAdImage($file) {
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
function getCollegeNameById($college_id){
    global $dbConn;
    $sql = "select college_name from colleges WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $college_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    return $college_name = !empty($records['college_name'])?$records['college_name']:"NA";     
}
function getUniversityNameById($university_id){
    global $dbConn;
    $sql = "select university_name from universities WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $university_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    return $university_name = !empty($records['university_name'])?$records['university_name']:"NA";     
}

function getExamNameById($exam_id){
    global $dbConn;
    $sql = "select exam_name from exams WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $exam_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    return $exam_name = !empty($records['exam_name'])?$records['exam_name']:"NA";     
}

function validateNoticePage($file) {
    $errors = [];
    $allowedExtensions = ['html', 'htm'];
    $allowedMimeTypes = ['text/html', 'text/plain'];
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    // Check if the file was uploaded
    if (!isset($file) || $file['error'] != UPLOAD_ERR_OK) {
        $errors[] = 'File upload error.';
        return $errors;
    }
// echo mime_content_type($file['tmp_name']);
//     print_r($file);
//     print_r($allowedExtensions);
//     print_r($allowedMimeTypes);
// die;
    //$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    // Validate file type
    $fileMimeType = mime_content_type($file['tmp_name']);
    if (in_array(strtolower($fileExtension), $allowedExtensions) && in_array($fileMimeType, $allowedMimeTypes)) {
       
    } else {
       $errors[] = "Invalid file type. Only HTML files are allowed.";
    }

    return $errors;
}

function timeAgo($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = [
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


?>

