<style type="text/css">
.page_menu a{color:#b5b5b5; font-size:13px; font-family:Archivo}
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
                <a class="nav-link active_overview" href="<?php echo BASE_URL;?>/<?php echo $collegeSlug;?>"><i class="fa fa-building-o"></i> OVERVIEW</a>
            </li>
            <li class="nav-item me-5">
                <a class="nav-link active_courses" href="<?php echo BASE_URL;?>/<?php echo $collegeSlug;?>/courses"><i class="fas fa-book-reader"></i> COURSES OFFERED</a>
            </li>                
            <li class="nav-item me-5">
                <a class="nav-link active_notice" href="<?php echo BASE_URL;?>/<?php echo $collegeSlug;?>/notice"><i class="fas fa-desktop"></i> ADMISSION / NOTICES <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> <sup><span class="badge bg-danger faa-flash animated">New</span></sup></a>
            </li>
            <li class="nav-item me-5">
                <a class="nav-link active_apply" href="javascript:void(0)"><i class="fas fa-edit"></i> APPLY NOW <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> <sup><span class="badge bg-danger faa-flash animated">New</span></sup></a>
            </li>
            <li class="nav-item me-5">
                <a class="nav-link active_list" href="<?php echo BASE_URL;?>/<?php echo $collegeSlug;?>/meritlist"><i class="fas fa-list-ol"></i> MERIT / ADMISSION LIST <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> <sup><span class="badge bg-danger faa-flash animated">New</span></sup></a>
            </li>
            <li class="nav-item me-5">
                <a class="nav-link active_contact" href="<?php echo BASE_URL;?>/<?php echo $collegeSlug;?>/contact"><i class="fas fa-globe"></i> CONTACT</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
</section>