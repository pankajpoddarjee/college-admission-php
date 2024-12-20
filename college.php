<?php
// Adjusting slug URL for IIS/Windows environment
$slug_url = isset($_GET['slug']) ? "college/" . $_GET['slug'] : '';  

// Includes necessary configuration files
include_once('settings.php');
include_once('connection.php');
include_once('function.php');
include_once('QRY_CAcollegeMainPage.php');
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT; ?>">
<title><?php echo $record['college_name']; ?>, <?php echo $city_name; ?> - Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?> | <?php echo SITE_NAME; ?></title>
<meta name="keywords" content="<?php echo $college_name; ?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, <?php echo $college_name; ?> merit list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, <?php echo $college_name; ?> contact">
<meta name="description" content="<?php echo $college_name; ?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, Admission / Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, Courses <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, Contact">
<meta property="og:title" content="<?php echo $college_name; ?>, <?php echo $city_name; ?> - Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?> | <?php echo SITE_NAME; ?>">
<meta property="og:description" content="<?php echo $college_name; ?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, Admission / Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, Courses <?php echo CURRENT_YEAR_DISPLAY_C_PAGE; ?>, Contact">
<meta property="og:image" content="<?php echo BASE_URL . '/' . $folder_name . '/' . $banner_img; ?>">
<meta property="og:url" content="<?php echo BASE_URL . '/' . $folder_name . '/' . $file_name; ?>">
<?php echo OTHER_META_TAGS; ?>
<?php include('head_includes.php'); ?>
</head>
<body>
    <?php include('header.php'); ?>
    <?php include('menu.php'); ?>
    
    <?php include('college_page_header.php'); ?>
    <?php include('college_page_menu.php'); ?>
    <style type="text/css">
        .active_overview { color: #FC0 !important; }
    </style>
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <?php include('google_ads_horizontal.php'); ?>
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
                            <h4 class="alert alert-info" style="font-family:Oswald"><i class="fas fa-building"></i> College Info</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <?php include('collegeInfoMainTable.php'); ?>
                        </div>
                    </div>
                    
                    <?php include('college_page_admission_links_H.php'); ?>
                    
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                            <?php include('google_ads_contextual.php'); ?>
                        </div>
                    </div>                    
                </div>
                <div class="col-md-3">
                    <?php include('c_right_panel.php'); ?>
                </div>
            </div>
        </div>
    </section>
    
    <?php include('footer.php'); ?>
    <?php include('footer_includes.php'); ?>
    
    <?php $dbConn = null; ?>
</body>
</html>
