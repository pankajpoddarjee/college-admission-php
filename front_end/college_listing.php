<?php
include_once("connection.php");
$records = [];
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
            $sql .= " AND college_course_details.stream_id = :stream_id";
        }
        if (!empty($masterSlugRecord['course_type_id'])) {
            $sql .= " AND college_course_details.course_type_id = :course_type_id";
        }
        // if (!empty($masterSlugRecord['tags'])) {
        //     $sql .= " AND colleges.tags = :tags";
        // }
        
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

?>

<section class="bg-light">
        <div class="container-fluid page_header">
            <div class="row">
                <div class="col-md-10">
                    <img class="rounded" src="images/kolkata-colleges.png" alt="logo" title="logo">
                    <a href="<?php echo BASE_URL;?>/kolkata-colleges.php" title="<?php echo strtolower($masterSlugRecord['title']);?>">
                        <h1 style="font-family:Oswald; font-weight:normal"><?php echo ucwords($masterSlugRecord['title']);?></h1>
                    </a>
                    <?php if($masterSlugRecord['city_id']!=0 || $masterSlugRecord['state_id']!=0 || $masterSlugRecord['country_id']!=0){ ?>
                    <span class="subType1">
                        <i class="fa fa-map-marker"></i> 
                        <?php if($masterSlugRecord['city_id']!=0 && $masterSlugRecord['city_id']!=NULL){ ?>
                        <?php echo ucwords(getCityNameById($masterSlugRecord['city_id'])); ?>,
                        <?php } ?>
                        <?php if($masterSlugRecord['state_id']!=0 && $masterSlugRecord['state_id']!=NULL){ ?>
                        <a href="" title=""><?php echo ucwords(getStateNameById($masterSlugRecord['state_id'])); ?></a>, 
                        <?php } ?>
                        <?php if($masterSlugRecord['country_id']!=0 && $masterSlugRecord['country_id']!=NULL){ ?>
                        <a href="" title=""><?php echo ucwords(getCountryNameById($masterSlugRecord['country_id'])); ?></a>
                        <?php } ?>
                    </span>
                    <?php } ?>
                    <span class="subType2">
                        <i class="fa-solid fa-clipboard-list"></i> <?php echo count($records); ?> records found
                    </span>
                </div>
                <div class="col-md-2">
                    <?php if(SHOW_C_PAGE_HEADER_ADM_LINK==1) {?>
                    <a class="btn btn-danger w-100 p-2 pb-2 mt-4" href="">
                        <i class="fas fa-desktop"></i> <span class="faa-flash animated text-uppercase text-light">Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></span>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
					<?php include("google_ads_horizontal.php");?>
                </div>
                <?php include("college_page_social_share_button.php");?>
            </div>
        </div>
    </section>
    
    <section class="mt-4">
        <div class="container-xxl">
            <div class="row">
                <div class="col-md-12">
                	<div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert alert-info p-3" style="font-family:Oswald"><i class="fas fa-building"></i> <?php echo ucwords($masterSlugRecord['title']);?><!--<span class="float-end h4"><?php echo count($records); ?> Records Found</span>--></h4>
                        </div>
                    </div>
                    
                	<div class="row bg-light pt-4 pb-4 m-0 listing" style="font-family:'Viga'" id="result">                        
                        
                    </div>
                    <div id="complete-data" style="display:none">Data Not Found</div>
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                        	<?php include("google_ads_contextual.php");?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>