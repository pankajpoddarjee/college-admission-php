<?php $slug_url = isset($_GET['slug']) ? "college/".$_GET['slug'] : '';  ?>
<?php include('settings.php');
include("function.php");
include("connection.php");
include("QRY_CAcollegeMainPage.php");
$collegeRecord = [];
$fetchallqry = "SELECT id,college_name  FROM colleges WHERE slug='".$slug_url."'";
$stmt = $dbConn->prepare($fetchallqry);
$stmt->execute();
$collegeRecord = $stmt->fetch(PDO::FETCH_ASSOC);

if(count($collegeRecord)>0){
    $college_id = $collegeRecord['id'];
    $college_name = $collegeRecord['college_name'];
    $records = [];
    $fetchallqry = "SELECT ccd.*, s.stream_name, s.short_name, ct.course_type_name, ct.course_code FROM college_course_details as ccd LEFT JOIN streams as s On s.id = ccd.stream_id JOIN course_types as ct ON ct.id = ccd.course_type_id WHERE ccd.college_id=$college_id AND ccd.is_active=1  order by  ct.course_type_name desc, s.stream_name asc" ;
    $stmt = $dbConn->prepare($fetchallqry);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//echo "<pre>"; print_r($records); 

$groupedData = [];
if(count($records)){
    foreach ($records as $item) {
        $courseType = $item['course_type_id'];
        if (!isset($groupedData[$courseType])) {
            $groupedData[$courseType] = [];
        }
        $groupedData[$courseType][] = $item;
    }
}
//echo "<pre>"; print_r($groupedData); 

// foreach ($groupedData as $courseTypeId => $courses) {
//     // Display the course type name
//     $courseTypeName = $courses[0]['course_type_name'];
//     echo "<h2>Course Type: $courseTypeName</h2>";

//     // Display the courses under this course type
//     foreach ($courses as $course) {
//         echo "<p>";
//         echo "Stream Name: " . $course['stream_name'] . "<br>";
//         echo "Subjects: " . getSubjectNameById($course['subject_id']) . "<br>";
//         echo "Created At: " . $course['created_at'] . "<br>";
//         echo "Is Active: " . ($course['is_active'] ? 'Yes' : 'No') . "<br>";
//         echo "</p>";
//     }
// }
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $record['college_name'];?> - Courses Offered | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo $college_name;?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, <?php echo $college_name;?> merit list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, <?php echo $college_name;?> contact">
<meta name="description" content="<?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta property="og:title" content="<?php echo $record['college_name'];?> - Courses Offered | <?php echo SITE_NAME;?>">
<meta property="og:description" content="<?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">

<meta property="og:image" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $banner_img;?>">
<meta property="og:url" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $file_name;?>">

<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>

<style type="text/css">
    .notice_list{list-style-type:none; padding:0 0 0 15px; margin:0}
    .notice_list li{font-family:Nunito; font-size:14px; font-weight:bold; border-bottom:1px dashed #d2d2d2; padding:7px 2px;}
    .notice_list li a{color:#004ecc}
    .notice_list li a img{width:45px}
    .notice_list li .p_date{font-family:Montserrat; font-size:12px; font-weight:600; color:#444}
    .notice_list li .new_tag{font-size:9px; vertical-align:top}
</style>

</head>
<body>
	<?php include("header.php");?>
    <?php include("menu.php");?>
    
    <?php include("college_page_header.php");?>
    <?php include("college_page_menu.php");?>
    <style type="text/css">
	.active_courses{color:#FC0 !important;}
	</style>
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
					<?php include("google_ads_horizontal.php");?>
                </div>
            </div>
        </div>
    </section>
    
    <section class="mt-4">
        <div class="container-xxl">
            <div class="row">
                <div class="col-md-9">
                	<div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert alert-info" style="font-family:Oswald"><i class="fa-solid fa-book-open-reader"></i> Courses Offered</h4>
                        </div>
                    </div>

                	<div class="row m-0">
                        <div class="col-md-12 mt-2">
                            <?php 
                                if($groupedData){
                                foreach ($groupedData as $courseTypeId => $courses) {
                                    $courseTypeName = $courses[0]['course_type_name'];
                                    $courseShortName = $courses[0]['course_code'];
                                ?>
                                    <h4 class="mt-4 bg-secondary bg-gradient p-3 shadow-sm border border-secondary border-opacity-10" style="font-family:Oswald; --bs-bg-opacity: .2;"><i class="fa-solid fa-book"></i> <?php echo $courseTypeName ?> <?php echo "(". $courseShortName .")";?></h4>
                                    <?php
                                    
                                    foreach ($courses as $course) {  
                                        $strSubject = getSubjectNameById($course['subject_id']);
                                        $arrSubject = explode(',',$strSubject);
                                    ?>
                                        

                                        <h5 class="border-bottom p-2 text-danger mt-3" style="font-family:Oswald">
                                            <?php if($course['stream_name'] !=0){?>
                                                <i class="fa fa-hand-o-right"></i> <?php echo $course['stream_name']; ?> <?php echo "(" . $course['short_name'] . ")"; ?>
                                            <?php } else { ?>
                                                <i class="fa fa-hand-o-right"></i> Subjects Offered
                                            <?php } ?>
                                        </h5>

                                        <div class="row">
                                            <?php foreach ($arrSubject as $subject) { ?>

                                            <div class="col-md-4 mb-1">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><i class="fa-solid fa-book-open-reader text-secondary"></i> <?php echo $subject; ?></li>
                                                </ul>
                                            </div>
                                            
                                            <?php  } ?>
                                        </div>
                                    <?php  } ?>                                    

                                <?php } 

                                }
                            ?>
                        </div>
                    </div>
                    
                    <?php include("college_page_admission_links_H.php");?>
                    
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                        	<?php include("google_ads_contextual.php");?>
                        </div>
                    </div>                    
                </div>
                <div class="col-md-3">
                	<?php include("c_right_panel.php");?>
                </div>
            </div>
        </div>
    </section>
    
	<?php include("footer.php");?>
    <?php include("footer_includes.php");?>
    
    <?php $dbConn =NULL; ?>
</body>
</html>