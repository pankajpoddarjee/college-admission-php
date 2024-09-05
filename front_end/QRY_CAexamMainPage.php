<?php
// Get the full URL path
$full_url = $_SERVER['REQUEST_URI'];

// Parse the URL and get the path
$parsed_url = parse_url($full_url);
$path = $parsed_url['path'];

// Split the path into parts
$path_parts = explode('/', trim($path, '/'));

// Print all parts of the path for debugging
// echo '<pre>';
// print_r($path_parts);
// echo '</pre>';
$uri = $path_parts[2];

if($uri == 'exams')

?>


<?php 
$qry = "SELECT e.* FROM exams e ";
if($uri == 'exams'){
   $qry .= " WHERE e.slug='".$slug_url."' AND e.is_active=1";
}
if($uri == 'notice'){
    $noticeRecord = [];
    $fetchallqry = "SELECT exam_id  FROM notices WHERE slug='".$slug_url."'";
    $stmt = $dbConn->prepare($fetchallqry);
    $stmt->execute();
    $noticeRecord = $stmt->fetch(PDO::FETCH_ASSOC);
   
    $exam_id=$noticeRecord['exam_id'];
    $qry .= " WHERE e.id='".$exam_id."' AND e.is_active=1";
 }

$record = [];
$stmt = $dbConn->prepare($qry);
$stmt->execute();
$record = $stmt->fetch(PDO::FETCH_ASSOC);
//$qryresult = $dbConn->query($fetchallqry);if($qryresult)
    /*{
        while ($row=$qryresult->fetch(PDO::FETCH_ASSOC))
        {
            foreach ($row as $colNum=>$value) {$record[$colNum] = trim($value);}
        }
    } */

    // echo "<pre>";
    // print_r($record); die;
    //print_r($record);
// $university_id = $record["id"];
 $exam_name = $record["exam_name"];
// $short_name = $record["short_name"];
// $eshtablish = $record["eshtablish"];
// $university_type_name = $record["university_type_name"];
// $other_name = $record["other_name"];
// $country_name = $record["country_name"];
// $state_name = $record["state_name"];
// $city_name = $record["city_name"];
// $landmark = $record["landmark"];
// $address = $record["address"];
// $websiteURL = $record["website_url"];
// $websiteDisplay = $record["website_display"];
// $email = $record["email"];
// $email2 = $record["email2"];
// $phone = $record["phone"];
 $examSlug = $record["slug"];
// $logo_img = !empty($record["logo_img"])?$record["logo_img"]:"";
// $banner_img = !empty($record["banner_img"])?$record["banner_img"]:"";

// $logoImgPath = BASE_URL_UPLOADS.'/university/logo_image/'.$record['logo_img'];
// $bannerImgPath = BASE_URL_UPLOADS.'/university/banner_image/'.$record['banner_img'];
?>