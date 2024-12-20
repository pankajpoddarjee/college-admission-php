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
$uri = $path_parts[0];

if($uri == 'university')

?>


<?php 
$qry = "SELECT u.*, ut.university_type_name, co.country_name, s.state_name, ci.city_name FROM universities u 
JOIN countries co ON u.country_id=co.id 
JOIN states s ON u.state_id=s.id 
JOIN cities ci ON u.city_id=ci.id 
LEFT JOIN university_types ut ON u.university_type_id=ut.id "; 
if($uri == 'university'){
   $qry .= " WHERE u.slug='".$slug_url."' AND u.is_active=1";
}
if($uri == 'pages'){
    $pageRecord = [];
    $fetchallqry = "SELECT university_id  FROM page_universities WHERE slug='".$slug_url."'";
    $stmt = $dbConn->prepare($fetchallqry);
    $stmt->execute();
    $pageRecord = $stmt->fetch(PDO::FETCH_ASSOC);
   
    $university_id=$pageRecord['university_id'];
    $qry .= " WHERE u.id='".$university_id."' AND u.is_active=1";
 }
if($uri == 'notice'){
    $noticeRecord = [];
    $fetchallqry = "SELECT university_id  FROM notice_universities WHERE slug='".$slug_url."'";
    $stmt = $dbConn->prepare($fetchallqry);
    $stmt->execute();
    $noticeRecord = $stmt->fetch(PDO::FETCH_ASSOC);
   
    $university_id=$noticeRecord['university_id'];
    $qry .= " WHERE u.id='".$university_id."' AND u.is_active=1";
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
$university_id = $record["id"];
$university_name = $record["university_name"];
$short_name = $record["short_name"];
$eshtablish = $record["eshtablish"];
$university_type_name = $record["university_type_name"];
$other_name = $record["other_name"];
$country_name = $record["country_name"];
$state_name = $record["state_name"];
$city_name = $record["city_name"];
$landmark = $record["landmark"];
$address = $record["address"];
$websiteURL = $record["website_url"];
$websiteDisplay = $record["website_display"];
$email = $record["email"];
$email2 = $record["email2"];
$phone = $record["phone"];
$universitySlug = $record["slug"];
$logo_img = !empty($record["logo_img"])?$record["logo_img"]:"";
$banner_img = !empty($record["banner_img"])?$record["banner_img"]:"";
$html_page = !empty($record["html_page"])?$record["html_page"]:"";

$logoImgPath = BASE_URL_UPLOADS.'/university/logo_image/'.$record['logo_img'];
$bannerImgPath = BASE_URL_UPLOADS.'/university/banner_image/'.$record['banner_img'];
?>