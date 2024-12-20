<?php
include_once "../connection.php";
$file_name = [];
$from = $_GET["from"];
$notice_id = $_GET["notice_id"];
$id = $_GET["id"];
$year_directory = $_GET["year_directory"];
$dir = $_GET["dir"];


if($from == 'college'){
    $sql = "select * from notice_college_attachments WHERE college_id=:college_id AND notice_year=:notice_year AND directory_name=:directory_name";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":college_id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":notice_year", $year_directory, PDO::PARAM_INT);
    $stmt->bindParam(":directory_name", $dir, PDO::PARAM_INT);
    $stmt->execute();
    $file_name = $stmt->fetchAll(PDO::FETCH_ASSOC);

}

if($from == 'university'){
    $sql = "select * from notice_university_attachments WHERE university_id=:university_id AND notice_year=:notice_year AND directory_name=:directory_name";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":university_id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":notice_year", $year_directory, PDO::PARAM_INT);
    $stmt->bindParam(":directory_name", $dir, PDO::PARAM_INT);
    $stmt->execute();
    $file_name = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

header('Content-Type: application/json');
echo json_encode($file_name);
?>
