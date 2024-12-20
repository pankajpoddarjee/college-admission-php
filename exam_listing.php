<?php
include_once("connection.php");
$records = [];
$sql=" SELECT
    exams.*,
    countries.country_name,
    states.state_name
    -- cities.city_name
FROM exams
LEFT JOIN countries ON exams.country_id = countries.id
LEFT JOIN states ON exams.state_id = states.id
-- LEFT JOIN cities ON exams.city_id = cities.id
WHERE exams.is_active = 1
";

        if (!empty($masterSlugRecord['country_id'])) {
            $sql .= " AND exams.country_id = :country_id";
        }
        if (!empty($masterSlugRecord['state_id'])) {
            $sql .= " AND exams.state_id = :state_id";
        }
        // if (!empty($masterSlugRecord['city_id'])) {
        //     $sql .= " AND exams.city_id = :city_id";
        // }
        // if (!empty($masterSlugRecord['district_id'])) {
        //     $sql .= " AND exams.district_id = :district_id";
        // }
        
       
        // if (!empty($masterSlugRecord['tags'])) {
        //     $sql .= " AND universities.tags = :tags";
        // }
        
        // Prepare and bind parameters
        $stmt = $dbConn->prepare($sql);

        if (!empty($masterSlugRecord['country_id'])) {
            $stmt->bindParam(':country_id', $masterSlugRecord['country_id'], PDO::PARAM_INT);
        }
        if (!empty($masterSlugRecord['state_id'])) {
            $stmt->bindParam(':state_id', $masterSlugRecord['state_id'], PDO::PARAM_INT);
        }
        // if (!empty($masterSlugRecord['city_id'])) {
        //     $stmt->bindParam(':city_id', $masterSlugRecord['city_id'], PDO::PARAM_INT);
        // }
        // if (!empty($masterSlugRecord['district_id'])) {
        //     $stmt->bindParam(':district_id', $masterSlugRecord['district_id'], PDO::PARAM_INT);
        // }        
       
       
        // if (!empty($masterSlugRecord['tags'])) {
        //     $stmt->bindParam(':tags', $masterSlugRecord['tags'], PDO::PARAM_STR);
        // }

        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //echo "<pre>"; print_r($records);

?>

<section class="bg-light">
        <div class="container-fluid page_header">
            <div class="row">
                <div class="col-md-10">
                    <img class="rounded" src="images/kolkata-universities.png" alt="logo" title="logo">
                    <a href="<?php echo BASE_URL;?>/kolkata-universities.php" title="<?php echo strtolower($masterSlugRecord['title']);?>">
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