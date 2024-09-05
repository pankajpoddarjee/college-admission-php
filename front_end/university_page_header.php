<section class="bg-light">
    <div class="container-fluid c_page_header">
        <div class="row">
            <div class="col-md-10">
                <img src="<?php echo $logoImgPath;?>" alt="<?php echo strtolower ($university_name);?> logo" title="<?php echo strtolower ($university_name);?> logo">
                <h1><?php echo $record['university_name'];?> <?php if($short_name!='') {?>[<?php echo $short_name;?>]<?php } ?></h1>
                <span class="college_location">
                    <i class="fa fa-map-marker"></i> <?php echo $city_name;?>, <?php echo $state_name;?>
                </span>
                <span class="college_affiliation">
                    <i class="fas fa-university"></i> <?php echo $university_name;?> (<?php echo $short_name;?>)
                </span>
            </div>
            <div class="col-md-2">
                <?php if(SHOW_C_PAGE_HEADER_ADM_LINK==1) {?>
                <a class="btn btn-danger w-100 p-2 pb-2 mt-4" href="<?php echo BASE_URL;?>/<?php echo $universitySlug;?>/notice">
                    <i class="fas fa-desktop"></i> <span class="faa-flash animated text-uppercase text-light">Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></span>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>