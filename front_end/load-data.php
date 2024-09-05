<?php
include('settings.php');
include("connection.php");

//$fetch_query = mysqli_query($connection, "select * from colleges where is_active = 1 limit $page_start, $limit_page");
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 4;
$offset = ($page - 1) * $limit;


$records = [];
$activeStatus = 1;
//$strsql="select * from colleges where is_active = :is_active limit $page_start, $limit_page";
$strsql="SELECT c.id, c.college_name, c.short_name, c.college_type_id, c.country_id, co.country_name, c.state_id, s.state_name, c.city_id, ci.city_name, c.banner_img, c.logo_img, c.folder_name, c.file_name,c.slug FROM colleges c 
JOIN countries co ON c.country_id=co.id 
JOIN states s ON c.state_id=s.id 
JOIN cities ci ON c.city_id=ci.id 
WHERE  c.is_active=:is_active order by c.college_name OFFSET $offset ROWS
FETCH NEXT $limit ROWS ONLY";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output="";
$adFrequency = 2;
if(count($records) > 0){

    if (($page + 1) % $adFrequency == 0) {
        // Display the ad
        $output .= '<div class="text-center page_headerIcon" data-sr-id="2" style="; visibility: visible;  -webkit-transform: translateX(0) scale(1) rotateX(0); opacity: 1;transform: translateX(0) scale(1) rotateX(0); opacity: 1;-webkit-transition: all, -webkit-transform 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; transition: all, transform 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; ">
        <img class="img-fluid" src="http://192.168.1.5/college-admission/front_end/images/google_AD_2.jpg" alt="">
        </div>';
    }
    
    foreach ($records as  $rec) {
        $college_url = BASE_URL.'/'.$rec["slug"];
        $college_name = !empty($rec["college_name"])?$rec["college_name"]:"";
        $banner_img = !empty($rec["banner_img"])?BASE_URL_UPLOADS."/college/banner_image/".$rec["banner_img"]:BASE_URL."/images/no-image.jpg";
        $logo_img = !empty($rec["logo_img"])?BASE_URL_UPLOADS."/college/logo_image/".$rec["logo_img"]:BASE_URL."/images/no-logo.jpg";
        $city_name = !empty($rec["city_name"])?$rec["city_name"]:"";
        $state_name = !empty($rec["state_name"])?$rec["state_name"]:"";
        $output .='<div class="col-md-3 mb-4"><div class="img-thumbnail"><div class="row"><div class="col-12"><a href="'.$college_url.'" title="'.strtolower($college_name).', Kolkata"><div class="listing_banner"><img class="img-fluid border p-1" src="'.$banner_img.'" alt="" ></div><div class="ms-2 listing_logo"><img class="bg-white p-1 rounded d-block" src="'.$logo_img.'" alt="" ></div><div class="border-bottom pb-1"><span class="text-danger">'.$college_name.'</span><br><span class="text-dark">'.$city_name.', '.$state_name.'</span></div></a></div></div><div class="row mt-2"><div class="col-6 listing_links"><a class="btn border btn-sm w-100 mb-2" href="'.$college_url.'" title="'.strtolower($college_name).' courses offered"><i class="fas fa-book-reader"></i> Courses Offered</a></div><div class="col-6 listing_links"><a class="btn border btn-sm w-100 mb-2" href="http://office-5/college-admission/front_end/asutosh-college/admission_notice.php" title="'.strtolower($college_name).' admission '.CURRENT_YEAR_DISPLAY_C_PAGE.'"><i class="fas fa-desktop"></i> Admission '.CURRENT_YEAR_DISPLAY_C_PAGE.'</a></div><div class="col-6 listing_links"><a class="btn border btn-sm w-100 mb-2" href="http://office-5/college-admission/front_end/asutosh-college/applynow.php" title="apply online for '.strtolower($college_name).' admission '.CURRENT_YEAR_DISPLAY_C_PAGE.'"><i class="fas fa-edit"></i> Apply Now '.CURRENT_YEAR_DISPLAY_C_PAGE.'</a></div><div class="col-6 listing_links"><a class="btn border btn-sm w-100 mb-2" href="http://office-5/college-admission/front_end/asutosh-college/meritlist.php" title="'.strtolower($college_name).' merit list '.CURRENT_YEAR_DISPLAY_C_PAGE.'"><i class="fa fa-list-ol"></i> Merit List '.CURRENT_YEAR_DISPLAY_C_PAGE.'</a></div><div class="col-12 listing_links"><a class="btn border btn-sm w-100 mb-1" href="'.$college_url.'" title="'.strtolower($college_name).' kolkata"><i class="fas fa-file-alt"></i> View Details</a></div></div></div></div>';
    }
}

echo $output;

?>