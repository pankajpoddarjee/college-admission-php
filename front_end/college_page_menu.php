<style type="text/css">
.page_menu a{color:#b5b5b5}
.page_menu a:hover{color:#d9d9d9}
</style>
<section class="bg-light">    
    <nav class="navbar navbar-expand-lg bg-dark page_menu">
      <div class="container-fluid">
        <a class="navbar-brand d-md-none d-lg-none" href="javascript:void(0)"><i class="fa-solid fa-graduation-cap"></i> College Menu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item me-5 ms-2">
                <a class="nav-link active_overview" href="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $file_name;?>" title="<?php echo strtolower($college_name);?>, <?php echo strtolower($city_name);?>"><i class="fa fa-building-o"></i> OVERVIEW</a>
            </li>
            <li class="nav-item me-5">
                <a class="nav-link active_courses" href="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/courses.php" title="<?php echo strtolower($college_name);?> courses <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>"><i class="fas fa-book-reader"></i> COURSES OFFERED</a>
            </li>                
            <li class="nav-item me-5">
                <a class="nav-link active_admission" href="<?php echo BASE_URL;?>/<?php echo $collegeSlug;?>/notice" title="<?php echo strtolower($college_name);?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>"><i class="fas fa-desktop"></i> COLLEGE ADMISSION <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> <sup><span class="badge bg-danger faa-flash animated">New</span></sup></a>
            </li>
            <li class="nav-item me-5">
                <a class="nav-link active_apply" href="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/apply.php" title="apply to <?php echo strtolower($college_name);?> <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>"><i class="fas fa-edit"></i> APPLY NOW <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> <sup><span class="badge bg-danger faa-flash animated">New</span></sup></a>
            </li>
            <li class="nav-item me-5">
                <a class="nav-link active_list" href="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/meritlist.php" title="<?php echo strtolower($college_name);?> merit list / admission list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>"><i class="fas fa-list-ol"></i> MERIT / ADMISSION LIST <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> <sup><span class="badge bg-danger faa-flash animated">New</span></sup></a>
            </li>
            <li class="nav-item me-5">
                <a class="nav-link active_contact" href="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/contact.php" title="<?php echo strtolower($college_name);?> contact details <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>"><i class="fas fa-globe"></i> CONTACT</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
</section>