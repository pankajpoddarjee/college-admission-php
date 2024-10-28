<?php

include_once "connection.php";


function getAdImageByAdId($ad_id){
    global $dbConn;
    $sql = "select ad_image from ads WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $ad_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    return $exam_name = !empty($records['ad_image'])?$records['ad_image']:"NA";     
}
?>