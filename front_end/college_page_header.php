<section class="bg-light">
    <div class="container-fluid c_page_header">
        <div class="row">
            <div class="col-md-10">
                <img src="<?php echo BASE_URL_UPLOADS;?>/college/logo_image/<?php echo $logo_img;?>" alt="college logo" title="<?php echo strtolower ($college_name);?> logo">
                <a href="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $file_name;?>" title="<?php echo strtolower ($record['college_name']);?>, <?php echo strtolower ($city_name);?>">
                    <h1><?php echo $record['college_name'];?> <?php if($short_name!='') {?>[<?php echo $short_name;?>]<?php } ?></h1>
                </a>
                <span class="college_location">
                    <i class="fa fa-map-marker"></i> <a href="" title="list of colleges in <?php echo strtolower ($city_name);?>"><?php echo $city_name;?></a>, <a href="" title="list of colleges in <?php echo strtolower ($state_name);?>"><?php echo $state_name;?></a>
                </span>
                <span class="college_affiliation">
                    <i class="fas fa-university"></i> <a href="" title="list of colleges affiliated under <?php echo strtolower ($university_name);?> (<?php echo strtolower ($university_short_name);?>)"><?php echo $university_name;?> (<?php echo $university_short_name;?>)</a>
                </span>
            </div>
            <div class="col-md-2">
                <?php if(SHOW_C_PAGE_HEADER_ADM_LINK==1) {?>
                <a class="btn btn-danger w-100 p-2 pb-2 mt-4" title="<?php echo strtolower ($college_name);?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>" href="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/admission_notice.php">
                    <i class="fas fa-desktop"></i> <span class="faa-flash animated text-uppercase text-light">Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></span>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>