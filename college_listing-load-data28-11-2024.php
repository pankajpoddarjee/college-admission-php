<?php
include('settings.php');
include("connection.php");

//$fetch_query = mysqli_query($connection, "select * from colleges where is_active = 1 limit $page_start, $limit_page");
$slug_url = isset($_GET['slug']) ? $_GET['slug'] : ""; 

$masterSlugRecord = [];
$stmt = $dbConn->prepare("SELECT * FROM slug_master WHERE slug= :slug_url ");
$stmt->execute(['slug_url' => $slug_url]);
$masterSlugRecord = $stmt->fetch(PDO::FETCH_ASSOC);



$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 500;
$offset = ($page - 1) * $limit;


$records = [];
$activeStatus = 1;
//$strsql="select * from colleges where is_active = :is_active limit $page_start, $limit_page";
// $strsql="SELECT c.id, c.college_name, c.short_name, c.college_type_id, c.country_id, co.country_name, c.state_id, s.state_name, c.city_id, ci.city_name, c.banner_img, c.logo_img, c.folder_name, c.file_name,c.slug FROM colleges c 
// JOIN countries co ON c.country_id=co.id 
// JOIN states s ON c.state_id=s.id 
// JOIN cities ci ON c.city_id=ci.id 
// WHERE  c.is_active=:is_active order by c.college_name OFFSET $offset ROWS
// FETCH NEXT $limit ROWS ONLY";
// $stmt = $dbConn->prepare($strsql);
// $stmt->bindParam(':is_active',$activeStatus);
// $stmt->execute();
// $records = $stmt->fetchAll(PDO::FETCH_ASSOC);


// $sql = "SELECT colleges.*, countries.country_name, states.state_name, cities.city_name, college_course_details.stream_id, college_course_details.course_type_id FROM colleges 
// Left JOIN college_course_details on college_course_details.college_id = colleges.id 
// Left JOIN countries  ON colleges.country_id=countries.id 
// Left JOIN states  ON colleges.state_id=states.id 
// Left JOIN cities  ON colleges.city_id=cities.id 
// WHERE colleges.is_active=1 ";

$sql="WITH UniqueCourseDetails AS (
    SELECT 
        college_id,
        MAX(stream_id) AS stream_id,  -- or another suitable aggregation
        MAX(course_type_id) AS course_type_id
    FROM college_course_details
    GROUP BY college_id
) SELECT
    colleges.*,
    countries.country_name,
    states.state_name,
    cities.city_name,
    UniqueCourseDetails.stream_id,
    UniqueCourseDetails.course_type_id
FROM colleges
LEFT JOIN UniqueCourseDetails ON UniqueCourseDetails.college_id = colleges.id
LEFT JOIN countries ON colleges.country_id = countries.id
LEFT JOIN states ON colleges.state_id = states.id
LEFT JOIN cities ON colleges.city_id = cities.id
WHERE colleges.is_active = 1
";

        if (!empty($masterSlugRecord['country_id'])) {
            $sql .= " AND colleges.country_id = :country_id";
        }
        if (!empty($masterSlugRecord['state_id'])) {
            $sql .= " AND colleges.state_id = :state_id";
        }
        if (!empty($masterSlugRecord['city_id'])) {
            $sql .= " AND colleges.city_id = :city_id";
        }
        if (!empty($masterSlugRecord['district_id'])) {
            $sql .= " AND colleges.district_id = :district_id";
        }
        if (!empty($masterSlugRecord['undertaking_id'])) {
            $sql .= " AND colleges.undertaking_id = :undertaking_id";
        }
        if (!empty($masterSlugRecord['university_id'])) {
            $sql .= " AND colleges.university_id = :university_id";
        }
        if (!empty($masterSlugRecord['college_type_id'])) {
            $sql .= " AND colleges.college_type_id = :college_type_id";
        }
        if (!empty($masterSlugRecord['stream_id'])) {
            $sql .= " AND UniqueCourseDetails.stream_id = :stream_id";
        }
        if (!empty($masterSlugRecord['course_type_id'])) {
            $sql .= " AND UniqueCourseDetails.course_type_id = :course_type_id";
        }
        // if (!empty($masterSlugRecord['tags'])) {
        //     $sql .= " AND colleges.tags IN :tags";
        // }
        $sql .= " order by colleges.college_name OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
        // Prepare and bind parameters
        $stmt = $dbConn->prepare($sql);

        if (!empty($masterSlugRecord['country_id'])) {
            $stmt->bindParam(':country_id', $masterSlugRecord['country_id'], PDO::PARAM_INT);
        }
        if (!empty($masterSlugRecord['state_id'])) {
            $stmt->bindParam(':state_id', $masterSlugRecord['state_id'], PDO::PARAM_INT);
        }
        if (!empty($masterSlugRecord['city_id'])) {
            $stmt->bindParam(':city_id', $masterSlugRecord['city_id'], PDO::PARAM_INT);
        }
        if (!empty($masterSlugRecord['district_id'])) {
            $stmt->bindParam(':district_id', $masterSlugRecord['district_id'], PDO::PARAM_INT);
        }
        if (!empty($masterSlugRecord['undertaking_id'])) {
            $stmt->bindParam(':undertaking_id', $masterSlugRecord['undertaking_id'], PDO::PARAM_INT);
        }
        if (!empty($masterSlugRecord['university_id'])) {
            $stmt->bindParam(':university_id', $masterSlugRecord['university_id'], PDO::PARAM_INT);
        }
        if (!empty($masterSlugRecord['college_type_id'])) {
            $stmt->bindParam(':college_type_id', $masterSlugRecord['college_type_id'], PDO::PARAM_INT);
        }
        if (!empty($masterSlugRecord['stream_id'])) {
            $stmt->bindParam(':stream_id', $masterSlugRecord['stream_id'], PDO::PARAM_INT);
        }
        if (!empty($masterSlugRecord['course_type_id'])) {
            $stmt->bindParam(':course_type_id', $masterSlugRecord['course_type_id'], PDO::PARAM_INT);
        }
        // if (!empty($masterSlugRecord['tags'])) {
        //     $stmt->bindParam(':tags', $masterSlugRecord['tags'], PDO::PARAM_STR);
        // }

        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
$output="";
$adFrequency = 1;
if(count($records) > 0){
    if (($page + 1) % $adFrequency == 0 && $page!=1) {
        // Display the ad
        $output .= '<div class="mb-4 row justify-content-center"><div class="col-10 text-center">
        <img class="img-thumbnail" src="https://www.indianfestivaldiary.com/images/header.jpg" alt=""><br><span class="text-muted" style="font-family:Roboto">Sponsored | www.indianfestivaldiary.com</span>
        </div></div>';
    }
    foreach ($records as  $rec) {
        $college_url = BASE_URL.'/'.$rec["slug"];
        $college_name = !empty($rec["college_name"])?$rec["college_name"]:"";
        $short_name = !empty($rec["short_name"])?'['.$rec["short_name"].']':"";
        $banner_img = !empty($rec["banner_img"])?BASE_URL_UPLOADS."/college/banner_image/".$rec["banner_img"]:BASE_URL."/images/no-image.jpg";
        $logo_img = !empty($rec["logo_img"])?BASE_URL_UPLOADS."/college/logo_image/".$rec["logo_img"]:BASE_URL."/images/no-logo.jpg";
        $city_name = !empty($rec["city_name"])?$rec["city_name"]:"";
        $state_name = !empty($rec["state_name"])?$rec["state_name"]:"";
        $output .='<div class="col-md-3 mb-4"><div class="img-thumbnail"><div class="row"><div class="col-12"><a href="'.$college_url.'"><div class="listing_banner"><img class="img-fluid border p-1" src="'.$banner_img.'" alt="" ></div><div class="ms-2 listing_logo"><img class="bg-white p-1 rounded d-block" src="'.$logo_img.'" alt="" ></div><div class="border-bottom pb-1"><span class="text-danger">'.$college_name.' '.$short_name.'</span><br><span class="text-dark">'.$city_name.', '.$state_name.'</span></div></a></div></div><div class="row mt-2"><div class="col-6 listing_links"><a class="btn border btn-sm w-100 mb-2" href="'.$college_url.'"><i class="fas fa-book-reader"></i> Courses Offered</a></div><div class="col-6 listing_links"><a class="btn border btn-sm w-100 mb-2" href="http://office-5/college-admission/front_end/asutosh-college/admission_notice.php"><i class="fas fa-desktop"></i> Admission '.CURRENT_YEAR_DISPLAY_C_PAGE.'</a></div><div class="col-6 listing_links"><a class="btn border btn-sm w-100 mb-2" href="http://office-5/college-admission/front_end/asutosh-college/applynow.php"><i class="fas fa-edit"></i> Apply Now '.CURRENT_YEAR_DISPLAY_C_PAGE.'</a></div><div class="col-6 listing_links"><a class="btn border btn-sm w-100 mb-2" href="http://office-5/college-admission/front_end/asutosh-college/meritlist.php"><i class="fa fa-list-ol"></i> Merit List '.CURRENT_YEAR_DISPLAY_C_PAGE.'</a></div><div class="col-12 listing_links"><a class="btn border btn-sm w-100 mb-1" href="'.$college_url.'"><i class="fas fa-file-alt"></i> View Details</a></div></div></div></div>';
    }
}

echo $output;

?>