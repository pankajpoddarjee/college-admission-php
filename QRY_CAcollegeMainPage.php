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
$uri = $path_parts[1];

if($uri == 'college')

?>


<?php 
$qry = "SELECT c.id, c.slug as collegeSlug, c.college_name, c.short_name, un.short_name AS university_short_name, ct.college_type_name, c.eshtablish, c.college_type_id, ut.undertaking_name, ct.college_type_name, c.other_name, c.country_id, co.country_name, c.state_id, s.state_name, c.city_id, ci.city_name, c.college_code, c.landmark, university_id, un.university_name, c.accreditation, c.address, c.website_url, c.website_display, c.email, c.email2, c.phone, c.folder_name, c.file_name, c.logo_img, c.banner_img FROM colleges c 
JOIN college_types ct ON c.college_type_id=ct.ID 
JOIN countries co ON c.country_id=co.ID 
JOIN states s ON c.state_id=s.ID 
JOIN cities ci ON c.city_id=ci.ID 
JOIN universities un ON c.university_id=un.ID 
JOIN undertakings ut ON c.undertaking_id=ut.ID "; 
if($uri == 'college'){
   $qry .= " WHERE c.slug='".$slug_url."' AND c.is_active=1";
}
if($uri == 'notice'){
    $noticeRecord = [];
    $fetchallqry = "SELECT college_id  FROM notice_colleges WHERE slug='".$slug_url."'";
    $stmt = $dbConn->prepare($fetchallqry);
    $stmt->execute();
    $noticeRecord = $stmt->fetch(PDO::FETCH_ASSOC);
   
    $college_id=$noticeRecord['college_id'];
    $qry .= " WHERE c.id='".$college_id."' AND c.is_active=1";
 }
 if($uri == 'pages'){
    $pageRecord = [];
    $fetchallqry = "SELECT college_id  FROM page_colleges WHERE slug='".$slug_url."'";
    $stmt = $dbConn->prepare($fetchallqry);
    $stmt->execute();
    $pageRecord = $stmt->fetch(PDO::FETCH_ASSOC);
   
    $college_id=$pageRecord['college_id'];
    $qry .= " WHERE c.id='".$college_id."' AND c.is_active=1";
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
$college_id = $record["id"];
$college_name = $record["college_name"];
$short_name = $record["short_name"];
$eshtablish = $record["eshtablish"];
$college_type_name = $record["college_type_name"];
//$courseName = $record["courseName"];
//$courseCode = $record["courseCode"];
$undertaking_name = $record["undertaking_name"];
$other_name = $record["other_name"];
$country_name = $record["country_name"];
$state_name = $record["state_name"];
$city_name = $record["city_name"];
$college_code = $record["college_code"];
$landmark = $record["landmark"];
$university_name = $record["university_name"];
$university_short_name = $record["university_short_name"];
$accreditation = $record["accreditation"];
$address = $record["address"];
$websiteURL = $record["website_url"];
$websiteDisplay = $record["website_display"];
$email = $record["email"];
$email2 = $record["email2"];
$phone = $record["phone"];
$collegeSlug = $record["collegeSlug"];
$logo_img = !empty($record["logo_img"])?$record["logo_img"]:"";
$banner_img = !empty($record["banner_img"])?$record["banner_img"]:"";

$logoImgPath = BASE_URL_UPLOADS.'/college/logo_image/'.$record['logo_img'];
$bannerImgPath = BASE_URL_UPLOADS.'/college/banner_image/'.$record['banner_img'];
?>