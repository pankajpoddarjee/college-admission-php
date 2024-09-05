<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";


if (isset($_GET["getCourseDetail"])) {  
    $record_id = $_GET["getCourseDetail"];

    $sql = "select * from college_course_details WHERE college_id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
    $stmt->execute();

    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $output="";
    if(count($records) > 0){
        
        foreach ($records as  $rec) {
             $course_type_name = getCourseTypeNameById($rec["course_type_id"]);
             $stream_name = getStreamNameById($rec["stream_id"]);
             $subject_name = getSubjectNameById($rec["subject_id"]);             
             $college_course_detail_id =  $rec["id"];

            $output .='<tr><td>1</td><td>'.$course_type_name.'</td><td>'.$stream_name.'</td><td>'.$subject_name.'</td><td class="align-middle text-center text-nowrap"><a eid="12" class="btn btn-dark btn-sm " href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" onclick="getSingleCourseDetail('.$college_course_detail_id.')" data-original-title="Assign Courses" aria-describedby="tooltip840455"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a eid="12" class="btn btn-danger btn-sm " href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" onclick="removeSingleCourseDetail('.$college_course_detail_id.')" data-original-title="Assign Courses" aria-describedby="tooltip840455"><i class="fa-solid fa-trash"></i></i></a>
            </td></tr>';
        }
    }else{
        $output .='<tr><td>No Data Found</td></tr>';
    }
    echo $output;

}

if (isset($_GET["getTagsOfCollege"])) {
    $qryresult = [];
    $college_id = $_GET["getTagsOfCollege"];
	$is_active = 1;
    $sql = "select tags from colleges WHERE id=:college_id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":college_id", $college_id, PDO::PARAM_INT);
    $stmt->execute();

    $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);
    $statusarr["status"] = 1;
    $statusarr["record"] = $qryresult;
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}



if (isset($_GET["getStream"])) {
    $qryresult = [];
    $course_type_id = $_GET["getStream"];
	$is_active = 1;
    $sql = "select id,stream_name from streams WHERE course_type_id=:course_type_id AND is_active=:is_active";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":course_type_id", $course_type_id, PDO::PARAM_INT);
    $stmt->bindParam(":is_active", $is_active, PDO::PARAM_INT);
    $stmt->execute();

    $qryresult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $statusarr["status"] = 1;
    $statusarr["record"] = $qryresult;
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}

if (isset($_GET["getSingleCourseDetail"])) {
    $qryresult = [];
    $college_course_detail_id = $_GET["getSingleCourseDetail"];
    $sql = "select college_course_details.*, colleges.course_complete_status from college_course_details JOIN colleges ON college_course_details.college_id = colleges.id WHERE college_course_details.id=:college_course_detail_id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":college_course_detail_id", $college_course_detail_id, PDO::PARAM_INT);
    $stmt->execute();

    $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);
    $statusarr["status"] = 1;
    $statusarr["record"] = $qryresult;
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;  
}

if (isset($_GET["removeSingleCourseDetail"])) {
    $qryresult = [];
    $college_course_id = $_GET["removeSingleCourseDetail"];
	$is_active = 1;
    $sql = "select * from college_course_details WHERE id=:college_course_id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":college_course_id", $college_course_id, PDO::PARAM_INT);
    $stmt->execute();
    $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);
    $college_id = $qryresult['college_id'];
    $college_name = getCollegeNameById($college_id);

    $sql = "delete from college_course_details WHERE id=:college_course_id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":college_course_id", $college_course_id, PDO::PARAM_INT);
    $stmt->execute();

    $statusarr["status"] = 1;
    $statusarr["college_name"] = $college_name;
    $statusarr["college_id"] = $college_id;
    $statusarr["msg"] = "Record deleted successfully";
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}

$statusarr = [];
$action = sanitize_string($_POST["action"]);
$record_id = sanitize_string($_POST["record_id"]);
$college_id = sanitize_string($_POST["college_id"]);
$course_type_id = sanitize_string($_POST["course_type_id"]);
$stream_id = sanitize_string($_POST["stream_id"]);
$course_complete_status = sanitize_string($_POST["course_complete_status"]);
$tags = sanitize_string($_POST["tags"]);
if(empty($_POST["subject_id"]) || !isset($_POST["subject_id"])){
    $statusarr["status"] = 0;
    $statusarr["msg"] = "Please select subject";
    echo json_encode($statusarr);
    return;
}

$subject_id = !empty($_POST["subject_id"])?implode(",",$_POST["subject_id"]):'';


$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
    $existQuery = $dbConn->prepare(
        "select * from college_course_details WHERE college_id = :college_id AND course_type_id=:course_type_id AND stream_id = :stream_id AND id!=:id"
    );
    
    $existQuery->bindParam(":college_id", $college_id, PDO::PARAM_INT);
    $existQuery->bindParam(":course_type_id", $course_type_id, PDO::PARAM_INT);
    $existQuery->bindParam(":stream_id", $stream_id, PDO::PARAM_INT);
    $existQuery->bindParam(":id", $record_id, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This Course already exist";
        echo json_encode($statusarr);
        return;
    } else {
        $sql =
            "UPDATE college_course_details SET college_id = :college_id, course_type_id = :course_type_id, stream_id = :stream_id , subject_id = :subject_id, updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":college_id", $college_id, PDO::PARAM_INT);
        $stmt->bindParam(":course_type_id", $course_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":stream_id", $stream_id, PDO::PARAM_STR);
        $stmt->bindParam(":subject_id", $subject_id, PDO::PARAM_STR);
        $stmt->bindParam(":updated_at", $updated_at, PDO::PARAM_STR);
        $stmt->bindParam(":updated_by", $updated_by, PDO::PARAM_STR);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
        // $stmt->execute();

        if ($stmt->execute()) {

            $sqltags = "UPDATE colleges SET tags = :tags WHERE id = :id";
            
            $stmt_tags = $dbConn->prepare($sqltags);
            $stmt_tags->bindParam(":tags", $tags, PDO::PARAM_STR);
            $stmt_tags->bindParam(":id", $college_id, PDO::PARAM_INT);
            $stmt_tags->execute();

            $sqlCourseCompleteStatus = "UPDATE colleges SET course_complete_status = :course_complete_status WHERE id = :id";
            $stmt_course_complete_status = $dbConn->prepare($sqlCourseCompleteStatus);
            $stmt_course_complete_status->bindParam(":course_complete_status", $course_complete_status, PDO::PARAM_STR);
            $stmt_course_complete_status->bindParam(":id", $college_id, PDO::PARAM_INT);
            $stmt_course_complete_status->execute();
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Record updated successfully  ";
            echo json_encode($statusarr);
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
            echo json_encode($statusarr);
        }
    }
    $dbConn= NULL;
} else {
    $existQuery = $dbConn->prepare(
        "select * from college_course_details WHERE college_id = :college_id AND course_type_id=:course_type_id AND stream_id = :stream_id"
    );
    $existQuery->bindParam(":college_id", $college_id, PDO::PARAM_INT);
    $existQuery->bindParam(":course_type_id", $course_type_id, PDO::PARAM_INT);
    $existQuery->bindParam(":stream_id", $stream_id, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This course already exist";
        echo json_encode($statusarr);
        return;
    } else {        
        $active_status = 1;
        $sql =
            "INSERT INTO college_course_details (college_id, course_type_id, stream_id, subject_id, created_at, created_by, is_active) VALUES (:college_id, :course_type_id, :stream_id, :subject_id, :created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":college_id", $college_id, PDO::PARAM_INT);
        $stmt->bindParam(":course_type_id", $course_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":stream_id", $stream_id, PDO::PARAM_STR);
        $stmt->bindParam(":subject_id", $subject_id, PDO::PARAM_STR);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $active_status, PDO::PARAM_INT);
        //$stmt->execute();

        if ($stmt->execute()) {
            $sqltags = "UPDATE colleges SET tags = :tags WHERE id = :id";
            $stmt_tags = $dbConn->prepare($sqltags);
            $stmt_tags->bindParam(":tags", $tags, PDO::PARAM_STR);
            $stmt_tags->bindParam(":id", $college_id, PDO::PARAM_INT);
            $stmt_tags->execute();

            $sqlCourseCompleteStatus = "UPDATE colleges SET course_complete_status = :course_complete_status WHERE id = :id";
            $stmt_course_complete_status = $dbConn->prepare($sqlCourseCompleteStatus);
            $stmt_course_complete_status->bindParam(":course_complete_status", $course_complete_status, PDO::PARAM_STR);
            $stmt_course_complete_status->bindParam(":id", $college_id, PDO::PARAM_INT);
            $stmt_course_complete_status->execute();

            $statusarr["status"] = 1;
            $statusarr["msg"] = "Data inserted successfully";
            echo json_encode($statusarr);
            return;
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
            echo json_encode($statusarr);
            return;
        }
    }
    $dbConn= NULL;
}



