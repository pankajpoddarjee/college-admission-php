<?php

include_once("../session.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");

$records = [];
$strsql="select * from ad_clicks ";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>"; print_r($records);
?>