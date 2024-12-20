<?php include('settings.php'); include("connection.php");include("function.php"); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo SITE_NAME;?> - <?php echo SITE_TAGLINE;?></title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta property="og:title" content="">
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta property="og:url" content="">
<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>

<style>
    /* Hide the loading GIF by default */
    #loadingGif {
        display: none;
    }

    .shimmer-container {
            width: 100%;
            /* max-width: 600px; */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .shimmer {
            position: relative;
            height: 100px;
            margin-bottom: 20px;
            background: #c0c0c0;;
            border-radius: 4px;
            overflow: hidden;
        }

        .shimmer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 100%);
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }

        /* Additional styles for loading content */
        .shimmer-title {
            height: 20px;
            /* width: 60%; */
            margin-bottom: 10px;
        }
        .shimmer-img {
            height: 40px;
            width: 40px;
            margin-bottom: 10px;
            margin-right: 10px;
        }

        .shimmer-text {
            height: 15px;
            width: 100%;
            margin-bottom: 10px;
        }

        .shimmer-listing {
            height: 20px;
            margin-bottom: 10px;
            margin-left: auto; /* Push this element to the far right */
        }

        .shimmer-list-control {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Distribute space */
            padding: 0 10px; /* Add some padding for spacing */
        }

</style>
<style>
        .search-container {
            position: relative;
            width: 100%;
        }

        .search-input {
            width: 100%;
            padding: 10px 30px 10px 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .clear-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            visibility: hidden;
            font-size: 18px;
        }

        .search-input:not(:placeholder-shown) + .clear-icon {
            visibility: visible;
        }
    </style>
</head>
<body>

<!--===== TOP LINK AREA START =====-->
<?php include("top_link_area.php");?>
<!--===== TOP LINK AREA END =======-->
      
<?php include("header.php");?>

<!--===== TOP MENU AREA START =====-->
<?php include("menu.php");?>
<!--===== TOP MENU AREA END =====-->


<style>
    #suggestions {
            position: absolute;
            z-index: 9999;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 1);
            border-radius: 4px;
            width: -webkit-fill-available;
            box-sizing: border-box;
        }
</style>


<!--===== SEARCH AREA START =====-->
<section style="background:#ecf0f1 url(images/slider1.jpg) center top no-repeat; padding-top:50px; padding-bottom:50px">
    <div class="container pt-5 pb-5">
        <div class="row m-0 p-0">
            <div class="col-md-12 m-0 p-0 text-center">
                <h2 class="text-light" style="font-family:Abel; font-weight:bold; font-size:24px; letter-spacing:1px">
                    SEARCH: COLLEGES, EXAM, RESULTS, MERIT LIST, ADMISSION NOTIFICATIONS ETC.
                </h2>
            </div>
            <div class="col-md-12 m-0 p-0">
                <div class="input-group mb-2 search-container">
                    <input type="text" class="search-input rounded p-3 bg-opacity-5 border border-light" id="searchQuery" name="search_query" placeholder="&#128269; Search for colleges, universities, courses, notices..." style="font-family:Rubik">
                    <span class="clear-icon" onclick="clearSearch()">&#10006;</span>
                </div>
            </div>
            <div class="col-md-12 m-0 p-0">
                <script>
                    function clearSearch() {
                    const input = document.getElementById('searchQuery');
                    input.value = '';
                    $('#suggestions').html('');
                    input.focus();
                    }
                </script>
            </div>
            <div class="col-md-12 m-0 p-0">
                <div class="shadow" id="loadingGif">
                    <div class="row shimmer-list-control align-items-center m-0 p-2">
                        <div class="shimmer shimmer-img rounded-circle col-2 col-md-1"></div>
                        <div class="shimmer shimmer-title col-8 col-md-9"></div>                        
                        <div class="shimmer shimmer-listing col-2 col-md-1"></div>
                    </div>
                    <div class="row shimmer-list-control align-items-center m-0 p-2">
                        <div class="shimmer shimmer-img rounded-circle col-2 col-md-1"></div>
                        <div class="shimmer shimmer-title col-8 col-md-9"></div>                        
                        <div class="shimmer shimmer-listing col-2 col-md-1"></div>
                    </div>
                    <div class="row shimmer-list-control align-items-center m-0 p-2">
                        <div class="shimmer shimmer-img rounded-circle col-2 col-md-1"></div>
                        <div class="shimmer shimmer-title col-8 col-md-9"></div>                        
                        <div class="shimmer shimmer-listing col-2 col-md-1"></div>
                    </div>
                    <div class="row shimmer-list-control align-items-center m-0 p-2">
                        <div class="shimmer shimmer-img rounded-circle col-2 col-md-1"></div>
                        <div class="shimmer shimmer-title col-8 col-md-9"></div>                        
                        <div class="shimmer shimmer-listing col-2 col-md-1"></div>
                    </div>
                    <div class="row shimmer-list-control align-items-center m-0 p-2">
                        <div class="shimmer shimmer-img rounded-circle col-2 col-md-1"></div>
                        <div class="shimmer shimmer-title col-8 col-md-9"></div>                        
                        <div class="shimmer shimmer-listing col-2 col-md-1"></div>
                    </div>
                    <div class="row shimmer-list-control align-items-center m-0 p-2">
                        <div class="shimmer shimmer-img rounded-circle col-2 col-md-1"></div>
                        <div class="shimmer shimmer-title col-8 col-md-9"></div>                        
                        <div class="shimmer shimmer-listing col-2 col-md-1"></div>
                    </div>
                </div>                       
            </div>

            <div class="col-md-12 m-0 p-0 bg-danger justify-content-center position-relative">
                <div id="suggestions" class="mb-1"></div>                      
            </div>
            
            <div class="col-md-12 m-0 p-0">                
                <a href="<?php echo BASE_URL;?>/latest-updates" class="btn btn-sm btn-outline-light" style="opacity:0.7">Latest Updates <?php echo CURRENT_YEAR;?></a> 
                <a href="" class="btn btn-sm btn-outline-light" style="opacity:0.7">Admission Info <?php echo CURRENT_YEAR;?></a> 
                <a href="" class="btn btn-sm btn-outline-light" style="opacity:0.7">Exam Info <?php echo CURRENT_YEAR;?></a>
            </div>
        </div>
    </div>
</section>
<!--===== SEARCH AREA END =====-->

    
<!--===== GOOGLE LINK AD START =====-->
<?php include("header.php");?>
<!--===== GOOGLE LINK AD END =====-->


<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
<!--===== SECTION-1: LATEST UPDATE START =====-->
<style>
.section_1 { background:#fff; padding-top:10px; padding-bottom:10px }

.button_BLUE { -webkit-border-radius: 5px; -moz-border-radius: 5px;font-size:17px;font-family:'Abel', sans-serif; padding: 23px 10px 24px 65px; text-decoration:none; display:block; color: #fff; background: #0e6af3 url(images/logo_UGC.png) left center no-repeat; text-align:left; transition: 300ms ease-in-out; line-height:22px; text-shadow:1px 1px 2px #666 }
.button_BLUE:hover { background: #2d3e52 url(images/logo_UGC.png) left center no-repeat; color:#fff; text-shadow:none; text-decoration:none }

/*Extra small devices (portrait phones, less than 576px)*/
@media (max-width: 575.98px) { 
.section_1 { padding:0 }
.section-1-left { display: none }
.section-1-right { display:none }
}

/*Small devices (landscape phones, 576px and up)*/
@media (min-width: 576px) and (max-width: 767.98px) { ... }

/*Medium devices (tablets, 768px and up)*/
@media (min-width: 768px) and (max-width: 991.98px) { ... }

/*Large devices (desktops, 992px and up)*/
@media (min-width: 992px) and (max-width: 1199.98px) { ... }

/*Extra large devices (large desktops, 1200px and up)*/
@media (min-width: 1200px) { ... }
}
</style>

<style>
.button_APPLY { -webkit-border-radius: 5px; -moz-border-radius: 5px;border-radius: 5px;font-size:17px; font-family:'Abel', sans-serif; padding: 15px 10px; text-decoration:none; display:block; color:#fff; background: #e56e6e; text-align: center; transition: 300ms ease-in-out; line-height:22px; margin-bottom:5px; text-shadow:1px 1px 2px #666 }
.button_APPLY:hover { background: #2d3e52; color:#fff; text-shadow:none; text-decoration:none }

.button_MERIT { -webkit-border-radius: 5px; -moz-border-radius: 5px;font-size:17px;font-family:'Abel', sans-serif; padding: 15px 10px; text-decoration:none; display:block; color:#fff; background: #73a2e2; text-align: center; transition: 300ms ease-in-out; line-height:22px; margin-bottom:5px; text-shadow:1px 1px 2px #666 }
.button_MERIT:hover { background: #2d3e52; color:#fff; text-shadow:none; text-decoration:none }

.button_ADMISSION { -webkit-border-radius: 5px; -moz-border-radius: 5px;font-size:17px;font-family:'Abel', sans-serif; padding: 15px 10px; text-decoration:none; display:block; color: #fff; background: #54bd7e; text-align: center; transition: 300ms ease-in-out; line-height:22px; margin-bottom:5px; text-shadow:1px 1px 2px #666 }
.button_ADMISSION:hover { background: #2d3e52; color:#fff; text-shadow:none; text-decoration:none }

.button_NEWS { -webkit-border-radius: 5px; -moz-border-radius: 5px;font-size:17px;font-family:'Abel', sans-serif; padding: 15px 10px; text-decoration:none; display:block; color: #fff; background: #e1936d; text-align: center; transition: 300ms ease-in-out; line-height:22px; margin-bottom:5px; text-shadow:1px 1px 2px #666 }
.button_NEWS:hover { background: #2d3e52; color:#fff; text-shadow:none; text-decoration:none }

.button_EXSCHEDULE { -webkit-border-radius: 5px; -moz-border-radius: 5px;font-size:17px;font-family:'Abel', sans-serif; padding: 15px 10px; text-decoration:none; display:block; color: #fff; background: #58baa6; text-align: center; transition: 300ms ease-in-out; line-height:22px; margin-bottom:5px; text-shadow:1px 1px 2px #666 }
.button_EXSCHEDULE:hover { background: #2d3e52; color:#fff; text-shadow:none; text-decoration:none }

.button_EXRESULT { -webkit-border-radius: 5px; -moz-border-radius: 5px;font-size:17px;font-family:'Abel', sans-serif; padding: 15px 10px; text-decoration:none; display:block; color: #fff; background: #8a98dd; text-align: center; transition: 300ms ease-in-out; line-height:22px; margin-bottom:5px; text-shadow:1px 1px 2px #666 }
.button_EXRESULT:hover { background: #2d3e52; color:#fff; text-shadow:none; text-decoration:none }

.button_NOTIFICATION { -webkit-border-radius: 5px; -moz-border-radius: 5px;font-size:17px;font-family:'Abel', sans-serif; padding: 15px 10px; text-decoration:none; display:block; color: #fff; background: #adc178; text-align: center; transition: 300ms ease-in-out; line-height:22px; margin-bottom:5px; text-shadow:1px 1px 2px #666 }
.button_NOTIFICATION:hover { background: #2d3e52; color:#fff; text-shadow:none; text-decoration:none }

.button_STUDYABROAD { -webkit-border-radius: 5px; -moz-border-radius: 5px;font-size:17px;font-family:'Abel', sans-serif; padding: 26px 10px; text-decoration:none; display:block; color: #fff; background: #d1ca5d; text-align: center; transition: 300ms ease-in-out; line-height:22px; margin-bottom:5px; text-shadow:1px 1px 2px #666}
.button_STUDYABROAD:hover { background: #2d3e52; color:#fff; text-shadow:none; text-decoration:none }

/*Extra small devices (portrait phones, less than 576px)*/
@media (max-width: 575.98px) { 
.section-2-left { display: none }
.section-2-right { display:none }
}

/*Small devices (landscape phones, 576px and up)*/
@media (min-width: 576px) and (max-width: 767.98px) { ... }

/*Medium devices (tablets, 768px and up)*/
@media (min-width: 768px) and (max-width: 991.98px) { ... }

/*Large devices (desktops, 992px and up)*/
@media (min-width: 992px) and (max-width: 1199.98px) { ... }

/*Extra large devices (large desktops, 1200px and up)*/
@media (min-width: 1200px) { ... }
}
</style>
<div class="container-fluid pb-4" style="background:#fff">
    <div class="row">
		<div class="col-md-2 section-2-left" style="padding-right:0">
            <a class="button_APPLY" href="#">
            	<span class="blink">APPLY NOW / FORM FILLUP</span><br>for Admission <?php echo CURRENT_YEAR;?>
            </a>
            <a class="button_MERIT" href="#">
            	<span class="blink">MERIT / ADMISSION LIST</span><br>for Admission <?php echo CURRENT_YEAR;?>
            </a>
            <a class="button_ADMISSION" href="#">
            	<span class="blink">ADMISSION NOTIFICATION</span><br>for Admission <?php echo CURRENT_YEAR;?>
            </a>
            <a class="button_NEWS" href="#">
            	<span class="blink">NEWS / CIRCULAR</span><br>Updates for <?php echo CURRENT_YEAR;?>
            </a>
            <a class="button_BLUE" href="ugc_recognised_fake_universities.php">
            	UGC Recognised FAKE UNIVERSITIES
            </a>
		</div>
        <div class="col-md-8">        
            <?php include("latest_updates.php");?>
		</div>
        <div class="col-md-2 section-2-right" style="padding-left:0">
            <a class="button_EXSCHEDULE" href="#">
                EXAMINATION SCHEDULE<br>for <?php echo CURRENT_YEAR;?>
            </a>
            <a class="button_EXRESULT" href="#">
                EXAMINATION RESULTS<br>for <?php echo CURRENT_YEAR;?>
            </a>
            <a class="button_NOTIFICATION" href="#">
                NOTIFICATIONS<br>for <?php echo CURRENT_YEAR;?>
            </a>
            <a class="button_STUDYABROAD" href="#">
                STUDY ABROAD
            </a>
            <a class="button_BLUE" href="ugc_recognised_colleges.php">
            	UGC Recognised LIST OF COLLEGES
            </a>
		</div>
	</div>
</div>
<!--===== SECTION-1: LATEST UPDATE END =====-->


<!--===== SECTION-2: ADMISSION/APPLY/MERIT LIST LINKS START =====-->
<style type="text/css">
.adm_info_sec { padding:0 }
.adm_info_sec a{ background: url(images/Index_college_adm.png) no-repeat top right #c16979; background-size:cover; padding:40px 0; text-align:center; transition:500ms ease-in-out; cursor:pointer; display:block; text-decoration:none; color:#fff; text-transform:uppercase;font-size:20px; font-family:'Abel', sans-serif; line-height:22px }
.adm_info_sec a:hover{background: url(images/Index_college_adm.png) no-repeat center left #9d4555; background-size:cover; color:#fff; text-decoration:none; text-shadow:0 1px 1px #333 }

.apply_now_sec { padding:0 }
.apply_now_sec a{ background: url(images/Index_college_adm.png) no-repeat top right #3aa7a7; background-size:cover; padding:40px 0; text-align:center; transition:500ms ease-in-out; cursor:pointer; display:block; text-decoration:none; color:#fff; text-transform:uppercase;font-size:20px; font-family:'Abel', sans-serif; line-height:22px}
.apply_now_sec a:hover{background: url(images/Index_college_adm.png) no-repeat center left #246c6c; background-size:cover; color:#fff; text-decoration:none; text-shadow:0 1px 1px #333 }

.merit_lists_sec { padding:0 }
.merit_lists_sec a{ background: url(images/Index_college_adm.png) no-repeat top right #0074b9; background-size:cover; padding:40px 0; text-align:center; transition:500ms ease-in-out; cursor:pointer; display:block; text-decoration:none; color:#fff; text-transform:uppercase; font-size:20px; font-family:'Abel', sans-serif; line-height:22px}
.merit_lists_sec a:hover{background: url(images/Index_college_adm.png) no-repeat center left #13435f; background-size:cover; color:#fff; text-decoration:none; text-shadow:0 1px 1px #333 }

@media (max-width: 575.98px) { 
.adm_info_sec a { text-transform: none; font-size:17px; font-family:'Abel', sans-serif; line-height:22px; padding:20px 0 }
.apply_now_sec a { text-transform: none; font-size:17px; font-family:'Abel', sans-serif; line-height:22px; padding:20px 0 }
.merit_lists_sec a { text-transform: none; font-size:17px; font-family:'Abel', sans-serif; line-height:22px; padding:20px 0 }
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-4 col-md-4 adm_info_sec">
            <a href="https://www.collegeadmission.in/AdmissionInformation/AdmissionInformations.shtml" target="_blank" title="college admission information 2018">
                <span style="text-transform:none; font-size:16px">Click here for</span><br>
                <strong>Admission Information</strong><br>
                <span class="blink"><?php echo CURRENT_YEAR;?></span>
            </a>
        </div>
        <div class="col-4 col-md-4 apply_now_sec">
            <a href="https://www.collegeadmission.in/apply/apply.shtml" target="_blank" title="college admission form fillup 2018, apply now 2018">
                <span style="text-transform:none; font-size:16px">Click here for</span><br>
                <strong>Apply Now / Form Fillup</strong><br>
                <span class="blink"><?php echo CURRENT_YEAR;?></span>
            </a>
        </div>
        <div class="col-4 col-md-4 merit_lists_sec">
            <a href="https://www.collegeadmission.in/Merit_List/MeritList.shtml" target="_blank" title="college admission list 2018, merit list 2018">
                <span style="text-transform:none; font-size:16px">Click here for</span><br>
                <strong>Merit / Waiting Lists</strong><br>
                <span class="blink"><?php echo CURRENT_YEAR;?></span>
            </a>
        </div>
    </div>
</div>
<!--===== SECTION-2: ADMISSION/APPLY/MERIT LIST LINKS END =====-->


<!--===== GOOGLE LINK AD START =====-->
<?php include("header.php");?>
<!--===== GOOGLE LINK AD END =====-->


<!--===== SECTION-3: INSTITUTES OF NATIONAL IMPORTANCE START =====-->
<style>
.section4 .section_heading { font-family:'Abel', sans-serif; font-size:25px; color:#000; text-align: center; padding: 0; }

hr { border:none; border-bottom:1px solid #ccc !important; padding:0; margin:5px 0 15px 0}

ul#section_4_other { padding:0; margin: 0; width:100%; text-align:left }
ul#section_4_other li { padding:0; margin: 0; display:inline-block }
ul#section_4_other li a { padding:5px 9px 3px 9px; margin:0 3px 3px 0; color:#666; text-decoration:none; font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif; text-transform:uppercase; font-size:11px; float:left; text-align: center; border-radius:3px; transition: 300ms ease-in-out; background:#eeeeee }
ul#section_4_other li a:hover { background:#239700; color:#fff }

ul#section_4_other li.link a { color:#000; font-weight:bold; border:none; background:none }
ul#section_4_other li.link a:hover { background: none; cursor:default }

ul#section_4_other li.link1 a { background:#239700; color:#fff; padding:5px 10px 3px 10px }
ul#section_4_other li.link1 a:hover { background:#eeeeee; color:#666 }

ul.link2 a { border:1px solid #0132af; color:#fff; padding:3px 10px 1px 10px }
ul.link2 a:hover { background:#fff; color:#0132af }


.thumbnail { margin:0 0 15px 0; padding:5px; background:#f1f3f4; display:block; border-radius:3px }
.thumbnail a { margin:0; padding:0; cursor: pointer; color:#1781d2; transition: 300ms ease-in-out; text-decoration:none }
.thumbnail a:hover { color:#333 }
.thumbnail a img { opacity:1.0; transition: 300ms ease-in-out; padding:0; margin:0 }
.thumbnail a:hover img { -webkit-filter: grayscale(100%); filter: grayscale(100%); }
.thumbnail a div { width:100%; margin:0; padding:5px; text-align:left; line-height:16px; font-family:'Abel', sans-serif; font-size:14px; text-decoration:none; opacity:1.0; font-weight:bold }
.thumbnail a div img { text-align:left; opacity:1.0; float:left; margin:0 7px 0 0; padding:0 5px 0 0; border-right:1px solid #ccc; width:auto}

/*Extra small devices (portrait phones, less than 576px)*/
@media (max-width: 575.98px) { 
.section_heading { font-family:'Abel', sans-serif; font-size:20px; color:#333; text-align: center; padding: 0; }

ul#section_4_other { padding:0; margin:7px 0 0 0; width:100% }
ul#section_4_other li { padding:0; margin: 0; float:left; table-layout:auto }
ul#section_4_other li a { padding:5px 10px 3px 10px; margin:0 5px 5px 0; color:#666; text-decoration:none; font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif; text-transform:uppercase; font-size:11px; float:left; text-align: center; border-radius:3px; transition: 300ms ease-in-out; background:#eeeeee }
ul#section_4_other li a:hover { background:#239700; color:#fff }
ul#section_4_other li.link a { color:#000; font-weight:bold; border:none; background: none }
ul#section_4_other li.link a:hover { background: none; cursor:default }
ul#section_4_other li.link1 a { background:#239700; color:#fff; padding:5px 10px 3px 10px; margin:0 5px 0 0 }
ul#section_4_other li.link1 a:hover { background:#eeeeee; color:#666 }

hr { border:none; border-bottom:1px solid #ccc !important; padding:0; margin:10px 0 10px 0}

.thumbnail { margin:0 0 3px 0; padding:0 }
.thumbnail a { margin:0; padding:0; cursor: pointer; color:#1781d2; transition: 300ms ease-in-out; text-decoration:none }
.thumbnail a:hover { color:#333 }
.thumbnail a img { opacity:1.0; transition: 300ms ease-in-out; padding:0; margin:0; display:none }
.thumbnail a:hover img { -webkit-filter: grayscale(100%); filter: grayscale(100%); }
.thumbnail a div { width:100%; margin:0; padding:5px; text-align:left; font-family: Verdana, Geneva, sans-serif; font-size:12px; text-decoration:none; opacity:1.0; font-weight:normal }
.thumbnail a div img { text-align:left; opacity:1.0; float:left; margin:0 7px 0 0; padding:0 5px 0 0; border-right:1px solid #ccc; width:auto; display:block}
}

/*Small devices (landscape phones, 576px and up)*/
@media (min-width: 576px) and (max-width: 767.98px) { ... }

/*Medium devices (tablets, 768px and up)*/
@media (min-width: 768px) and (max-width: 991.98px) { ... }

/*Large devices (desktops, 992px and up)*/
@media (min-width: 992px) and (max-width: 1199.98px) { ... }

/*Extra large devices (large desktops, 1200px and up)*/
@media (min-width: 1200px) { ... }
}			
</style>
<div class="section4">
<div class="container-fluid" style="background:#fff; padding-top:25px">
    <div class="container" style="padding:0">
        <div class="row">
            <div class="col-md-12">
            
                <div class="section_heading text-center">
                    Institutes of <span style="text-transform:uppercase; font-weight:bold">National Importance</span>
                    <div style="background:#000; width:80px; padding:1px; margin:15px auto 25px auto"></div>  
                </div>

                <div id="TabbedPanels1" class="TabbedPanels" align="center">
                    <ul class="TabbedPanelsTabGroup">
                        <li class="TabbedPanelsTab" tabindex="0">Management</li>
                        <li class="TabbedPanelsTab" tabindex="0">Engineering</li>
                        <li class="TabbedPanelsTab" tabindex="0">Sciences/Research</li>
                        <li class="TabbedPanelsTab" tabindex="0">Medicine</li>
                        <li class="TabbedPanelsTab" tabindex="0">Imformation Technology</li>
                        <li class="TabbedPanelsTab" tabindex="0">Pharmaceutical Science</li>
                        <li class="TabbedPanelsTab" tabindex="0">OTHERS</li>
                    </ul>
                    <div class="TabbedPanelsContentGroup">
                        <div class="TabbedPanelsContent">
                            <div class="row">
                                <div class="col-6 col-md-3 col-sm-6 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIM, Calcutta">
                                            <img src="images/Institutes_of_National_Importance/IIM_India/calcutta.jpg" alt="IIM, Calcutta" style="width:100%">
                                            <div><img src="images/Institutes_of_National_Importance/IIM_India/calcutta_logo.png" width="35"> Indian Inst. of Management<br>Calcutta<br>West Bengal</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-sm-6 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIM, Ahmedabad">
                                            <img src="images/Institutes_of_National_Importance/IIM_India/ahmedabad.jpg" alt="IIM, Ahmedabad">
                                            <div><img src="images/Institutes_of_National_Importance/IIM_India/ahmedabad_logo.png" width="35"> Indian Inst. of Management<br>Ahmedabad<br>Gujrat</div>        	
                                        </a>
                                    </div>                            
                                </div>
                                <div class="col-6 col-md-3 col-sm-6 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIM, Bangalore">
                                            <img src="images/Institutes_of_National_Importance/IIM_India/bangalore.jpg" alt="IIM, Bangalore">
                                            <div><img src="images/Institutes_of_National_Importance/IIM_India/bangalore_logo.png" width="35"> Indian Inst. of Management<br>Bangalore<br>Karnataka</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-sm-6 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIM, Lucknow">
                                            <img src="images/Institutes_of_National_Importance/IIM_India/lucknow.jpg" alt="IIM, Lucknow">
                                            <div><img src="images/Institutes_of_National_Importance/IIM_India/lucknow_logo.png" width="35"> Indian Inst. of Management<br>Lucknow<br>Uttar Pradesh</div>        	
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIM, Kozhikode">
                                            <img src="images/Institutes_of_National_Importance/IIM_India/kozhikode.jpg" alt="IIM, Kozhikode">
                                            <div><img src="images/Institutes_of_National_Importance/IIM_India/kozhikode_logo.png" width="35"> Indian Inst. of Management<br>Kozhikode<br>Kerala</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIM, Indore">
                                            <img src="images/Institutes_of_National_Importance/IIM_India/indore.jpg" alt="IIM, Indore">
                                            <div><img src="images/Institutes_of_National_Importance/IIM_India/indore_logo.png" width="35"> Indian Inst. of Management<br>Indore<br>Madhya Pradesh</div>        	
                                        </a>
                                    </div>                            
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIM, Shillong">
                                            <img src="images/Institutes_of_National_Importance/IIM_India/shillong.jpg" alt="IIM, Shillong">
                                            <div><img src="images/Institutes_of_National_Importance/IIM_India/shillong_logo.png" width="35"> Indian Inst. of Management<br>Shillong<br>Meghalaya</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIM, Rohtak">
                                            <img src="images/Institutes_of_National_Importance/IIM_India/rohtak.jpg" alt="IIM, Rohtak">
                                            <div><img src="images/Institutes_of_National_Importance/IIM_India/rohtak_logo.png" width="35"> Indian Inst. of Management<br>Rohtak<br>Haryana</div>        	
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="section_4_other">
                                        <li><a href="" title="Indian Institute of Management, Ranchi">IIM Ranchi</a></li>
                                        <li><a href="" title="Indian Institute of Management, Raipur">IIM Raipur</a></li>
                                        <li><a href="" title="Indian Institute of Management, Raipur">IIM Raipur</a></li>
                                        <li><a href="" title="Indian Institute of Management, Raipur">IIM Raipur</a></li>
                                        <li><a href="" title="Indian Institute of Management, Raipur">IIM Raipur</a></li>
                                        <li><a href="" title="Indian Institute of Management, Raipur">IIM Raipur</a></li>
                                        <li><a href="" title="Indian Institute of Management, Visakhapatnam">IIM Visakhapatnam</a></li>
                                        <li><a href="" title="Indian Institute of Management, Bodh Gaya">IIM Bodh Gaya</a></li>
                                        <!--<li><a href="" title="">IIM Amritsar</a></li>
                                        <li><a href="" title="">IIM Sambalpur</a></li>
                                        <li><a href="" title="">IIM Sirmaur</a></li>
                                        <li><a href="" title="">IIM Jammu</a></li>-->
                                        <li class="link1"><a href="">Full list of IIMs</a></li>
                                        <li class="link1"><a href="" title="" style="border:none">...Other Management Institutes</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="TabbedPanelsContent">
                        	<div class="row">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIT, Bhubaneswar">
                                            <img src="images/Institutes_of_National_Importance/IIT_India/bhubaneswar.jpg" alt="IIT, Bhubaneswar">
                                            <div><img src="images/Institutes_of_National_Importance/IIT_India/bhubaneswar_logo.png" width="35"> Indian Inst. of Technology<br>Bhubaneswar<br>Odisha</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIT, Mumbai">
                                            <img src="images/Institutes_of_National_Importance/IIT_India/mumbai.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/IIT_India/mumbai_logo.jpg" width="35"> Indian Inst. of Technology<br>Mumbai<br>Maharashtra</div>        	
                                        </a>
                                    </div>                            
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIT,Delhi ">
                                            <img src="images/Institutes_of_National_Importance/IIT_India/delhi.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/IIT_India/delhi_logo.jpg" width="35"> Indian Inst. of Technology<br>Delhi<br>Delhi</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIT, Dharwad">
                                            <img src="images/Institutes_of_National_Importance/IIT_India/dharwad.jpg" alt="NIT Bhopal">
                                            <div><img src="images/Institutes_of_National_Importance/IIT_India/dharwad_logo.jpg" width="35"> Indian Inst. of Technology<br>Dharwad<br>Karnataka</div>        	
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="section_4_other">
                                        <li><a href="" title="Indian Institute of Technology, Gandhinagar">IIT Gandhinagar</a></li>
                                        <li><a href="" title="Indian Institute of Technology, Guwahati">IIT Guwahati</a></li>
                                        <li><a href="" title="Indian Institute of Technology, Hyderabad">IIT Hyderabad</a></li>
                                        <li><a href="" title="Indian Institute of Technology, Indore">IIT Indore</a></li>
                                        <li><a href="" title="Indian Institute of Technology, Jodhpur">IIT Jodhpur</a></li>
                                        <li><a href="" title="Indian Institute of Technology, Kharagpur">IIT Kharagpur</a></li>
                                        <li><a href="" title="Indian Institute of Technology, Kanpur">IIT Kanpur</a></li>
                                        <li><a href="" title="Indian Institute of Technology, Chennai">IIT Chennai</a></li>
                                        <li><a href="" title="Indian Institute of Technology, Mandi">IIT Mandi</a></li>
                                        <li><a href="" title="Indian Institute of Technology, Patna">IIT Patna</a></li>
                                        <li class="link1"><a href="">Full list of IITs</a></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12"><hr></div>
                            </div>
                            
                            <div class="row">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="NIT, Jalandhar">
                                            <img src="images/Institutes_of_National_Importance/NIT_India/jalandhar.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/NIT_India/jalandhar_logo.jpg" width="35"> National Inst. of Technology<br>Jalandhar<br>Punjab</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="NIT, Jaipur">
                                            <img src="images/Institutes_of_National_Importance/NIT_India/jaipur.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/NIT_India/jaipur_logo.jpg" width="35"> National Inst. of Technology<br>Jaipur<br>Rajasthan</div>        	
                                        </a>
                                    </div>                            
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="NIT, Bhopal">
                                            <img src="images/Institutes_of_National_Importance/NIT_India/bhopal.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/NIT_India/bhopal_logo.jpg" width="35"> National Inst. of Technology<br>Bhopal<br>Madhya Pradesh</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="NIT, Allahabad">
                                            <img src="images/Institutes_of_National_Importance/NIT_India/allahabad.jpg" alt="NIT Bhopal">
                                            <div><img src="images/Institutes_of_National_Importance/NIT_India/allahabad_logo.jpg" width="35"> National Inst. of Technology<br>Allahabad<br>Uttar Pradesh</div>        	
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="section_4_other">
                                        <li><a href="" title="National Institute of Technology, Tadepalligudem">NIT Tadepalligudem</a></li>
                                        <li><a href="" title="National Institute of Technology, Agartala">NIT Agartala</a></li>
                                        <li><a href="" title="National Institute of Technology, Yupia">NIT Yupia</a></li>
                                        <li><a href="" title="National Institute of Technology, Kozhikode">NIT Kozhikode</a></li>
                                        <li><a href="" title="National Institute of Technology, Delhi">NIT Delhi</a></li>
                                        <li><a href="" title="National Institute of Technology, Durgapur">NIT Durgapur</a></li>
                                        <li><a href="" title="National Institute of Technology, Farmagudi">NIT Farmagudi</a></li>
                                        <li><a href="" title="National Institute of Technology, Hamirpur">NIT Hamirpur</a></li>
                                        <li class="link1"><a href="">Full list of NITs</a></li>
                                    </ul>
                                    <ul id="section_4_other">
                                        <li><a href="" title="Indian Institute of Petroleum and Energy, Visakhapatnam | Petroleum Engineering">IIPE Visakhapatnam</a></li>
                                        <li><a href="" title="Rajiv Gandhi Institute of Petroleum Technology, Amethi | Petroleum Engineering">RGIPT Amethi</a></li>
                                        <li class="link1"><a href="">...Other Engineering Institutes</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="TabbedPanelsContent">
                        	<div class="row">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="Indian Inst. of Science Education and Research (IISER), Bhopal">
                                            <img src="images/Institutes_of_National_Importance/IISER_India/bhopal.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/IISER_India/bhopal_logo.jpg" width="35"> IISER<br>Bhopal<br>Madhya Pradesh</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="Indian Inst. of Science Education and Research (IISER), Kolkata">
                                            <img src="images/Institutes_of_National_Importance/IISER_India/calcutta.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/IISER_India/calcutta_logo.jpg" width="35"> IISER<br>Kolkata<br>West Bengal</div>        	
                                        </a>
                                    </div>                            
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="Indian Inst. of Science Education and Research (IISER), Mohali">
                                            <img src="images/Institutes_of_National_Importance/IISER_India/mohali.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/IISER_India/mohali_logo.jpg" width="35"> IISER<br>Mohali<br>Punjab</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="Indian Inst. of Science Education and Research (IISER), Pune">
                                            <img src="images/Institutes_of_National_Importance/IISER_India/pune.jpg" alt="NIT Bhopal">
                                            <div><img src="images/Institutes_of_National_Importance/IISER_India/pune_logo.jpg" width="35"> IISER<br>Pune<br>Maharashtra</div>        	
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="Indian Inst. of Science Education and Research (IISER), Thiruvananthapuram">
                                            <img src="images/Institutes_of_National_Importance/IISER_India/thiruvananthapuram.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/IISER_India/thiruvananthapuram_logo.jpg" width="35"> IISER<br>Thiruvananthapuram<br>Kerala</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="Indian Inst. of Science Education and Research (IISER), Berhampur">
                                            <img src="images/Institutes_of_National_Importance/IISER_India/berhampur.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/IISER_India/berhampur_logo.jpg" width="35"> IISER<br>Berhampur<br>Odisha</div>        	
                                        </a>
                                    </div>                            
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="Indian Inst. of Science Education and Research (IISER), Tirupati">
                                            <img src="images/Institutes_of_National_Importance/IISER_India/tirupati.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/IISER_India/tirupati_logo.jpg" width="35"> IISER<br>Tirupati<br>Andhra Pradesh</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="Academy of Scientific and Innovative Research (AcSIR), Ghaziabad">
                                            <img src="images/Institutes_of_National_Importance/IISER_India/ACSIR_ghaziabad.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/IISER_India/ACSIR_ghaziabad_logo.jpg" width="35"> AcSIR<br>Ghaziabad<br>Uttar Pradesh</div>        	
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="section_4_other">                                        
                                        <li><a href="" title="Indian Institute of Engineering Science and Technology, Howrah | Science and Engineering">IIEST, Howrah</a></li>
                                        <li><a href="" title="Rani Lakshmi Bai Central Agricultural University, Jhansi | Agricultural Sciences">RLBCAU, Jhansi</a></li>
                                        <li><a href="" title="Dr. Rajendra Central Agricultural University, Samastipur | Agricultural Sciences">DRCAU, Samastipur</a></li>
                                        <li class="link1"><a href="" title="" style="border:none">...Other Science Institutes</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="TabbedPanelsContent">
                        	<div class="row">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="AIIMS, Bhopal">
                                            <img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Bhopal.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Bhopal_logo.jpg" width="35"> All India Inst. of Medical Sciences<br>Bhopal<br>Madhya Pradesh</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="AIIMS, Bhubaneswar">
                                            <img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Bhubaneswar.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Bhubaneswar_logo.jpg" width="35"> All India Inst. of Medical Sciences<br>Bhubaneswar<br>Odisha</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="AIIMS, Delhi">
                                            <img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Delhi.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Delhi_logo.jpg" width="35"> All India Inst. of Medical Sciences<br>Delhi<br>Delhi</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="AIIMS, Jodhpur">
                                            <img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Jodhpur.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Jodhpur_logo.jpg" width="35"> All India Inst. of Medical Sciences<br>Jodhpur<br>Rajasthan</div>        	
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="AIIMS, Patna">
                                            <img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Patna.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Patna_logo.jpg" width="35"> All India Inst. of Medical Sciences<br>Patna<br>Bihar</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="AIIMS, Raipur">
                                            <img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Raipur.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Raipur_logo.jpg" width="35"> All India Inst. of Medical Sciences<br>Raipur<br>Chhattisgarh</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="AIIMS, Rishikesh">
                                            <img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Rishikesh.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/Medicine/AIIMS_Rishikesh_logo.jpg" width="35"> All India Inst. of Medical Sciences<br>Rishikesh<br>Uttarakhand</div>        	
                                        </a>
                                    </div>
                                </div>
                                <!--<div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <img src="images/Institutes_of_National_Importance/Medicine/JIPMER.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/Medicine/JIPMER_logo.jpg" width="35"> All India Institute of Medical Sciences<br>Jodhpur, Rajasthan</div>        	
                                        </a>
                                    </div>
                                </div>-->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="section_4_other">
                                        <li><a href="" title="Jawaharlal Institute of Postgraduate Medical Education and Research">JIPMER, Pondicherry</a></li>
                                        <li><a href="" title="National Institute of Mental Health and Neurosciences">NIMHANS, Bangalore</a></li>
                                        <li><a href="" title="Postgraduate Institute of Medical Education and Research">PGIMER, Chandigarh</a></li>
                                        <li><a href="" title="Sree Chitra Tirunal Institute for Medical Sciences and Technology">SCTIMST, Thiruvananthapuram</a></li>                                        
                                        <li class="link1"><a href="" title="" style="border:none">...Other Medicine/Medical Institutes</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="TabbedPanelsContent">
                        	<div class="row">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIIT, Allahabad">
                                            <img src="images/Institutes_of_National_Importance/IIIT_India/allahabad.jpg" alt="IIIT, Allahabad">
                                            <div><img src="images/Institutes_of_National_Importance/IIIT_India/ahmedabad_logo.jpg" width="35"> Indian Inst. of Informtion Tech.<br>Allahabad<br>Uttar Pradesh</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIIT, Chittoor">
                                            <img src="images/Institutes_of_National_Importance/IIIT_India/chittoor.jpg" alt="IIIT, Chittoor">
                                            <div><img src="images/Institutes_of_National_Importance/IIIT_India/chittoor_logo.jpg" width="35"> Indian Inst. of Informtion Tech.<br>Chittoor<br>Andhra Pradesh</div>        	
                                        </a>
                                    </div>                            
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIIT, Dharwad">
                                            <img src="images/Institutes_of_National_Importance/IIIT_India/dharwad.jpg" alt="IIIT, Dharwad">
                                            <div><img src="images/Institutes_of_National_Importance/IIIT_India/dharwad_logo.jpg" width="35"> Indian Inst. of Informtion Tech.<br>Dharwad<br>Karnataka</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIIT, Guwahati">
                                            <img src="images/Institutes_of_National_Importance/IIIT_India/guwahati.jpg" alt="IIIT, Guwahati">
                                            <div><img src="images/Institutes_of_National_Importance/IIIT_India/guwahati_logo.jpg" width="35"> Indian Inst. of Informtion Tech.<br>Guwahati<br>Assam</div>        	
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIIT, Gwalior">
                                            <img src="images/Institutes_of_National_Importance/IIIT_India/gwalior.jpg" alt="IIIT, Gwalior">
                                            <div><img src="images/Institutes_of_National_Importance/IIIT_India/gwalior_logo.jpg" width="35"> Indian Inst. of Informtion Tech.<br>Gwalior<br>Madhya Pradesh</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIIT, Jabalpur">
                                            <img src="images/Institutes_of_National_Importance/IIIT_India/jabalpur.jpg" alt="IIIT, Jabalpur">
                                            <div><img src="images/Institutes_of_National_Importance/IIIT_India/jabalpur_logo.jpg" width="35"> Indian Inst. of Informtion Tech.<br>Jabalpur<br>Madhya Pradesh</div>        	
                                        </a>
                                    </div>                            
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIIT, Kalyani">
                                            <img src="images/Institutes_of_National_Importance/IIIT_India/kalyani.jpg" alt="IIIT, Kalyani">
                                            <div><img src="images/Institutes_of_National_Importance/IIIT_India/kalyani_logo.jpg" width="35"> Indian Inst. of Informtion Tech.<br>Kalyani<br>West Bengal</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="IIIT, Kancheepuram">
                                            <img src="images/Institutes_of_National_Importance/IIIT_India/kancheepuram.jpg" alt="IIIT, Kancheepuram">
                                            <div><img src="images/Institutes_of_National_Importance/IIIT_India/kancheepuram_logo.jpg" width="35"> Indian Inst. of Informtion Tech.<br>Kancheepuram<br>Tamil Nadu</div>        	
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="section_4_other">
                                        <li><a href="" title="Indian Institute of Information Technology, Kota">IIIT Kota</a></li>
                                        <li><a href="" title="Indian Institute of Information Technology, Kottayam">IIIT Kottayam</a></li>
                                        <li><a href="" title="Indian Institute of Information Technology, Kurnool">IIIT Kurnool</a></li>
                                        <li><a href="" title="Indian Institute of Information Technology, Lucknow">IIIT Lucknow</a></li>
                                        <li><a href="" title="Indian Institute of Information Technology, Manipur">IIIT Manipur</a></li>
                                        <li><a href="" title="Indian Institute of Information Technology, Nagpur">IIIT Nagpur</a></li>
                                        <li><a href="" title="Indian Institute of Information Technology, Pune">IIIT Pune</a></li>
                                        <li><a href="" title="Indian Institute of Information Technology, Ranchi">IIIT Ranchi</a></li>
                                        <li class="link1"><a href="">Full list of IIITs</a></li>
                                        <li class="link1"><a href="" title="" style="border:none">...Other Information Technoogy Institutes</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="TabbedPanelsContent">
                            <div class="row">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="National Institute of Pharmaceutical Education and Research, Ahmedabad">
                                            <img src="images/Institutes_of_National_Importance/Pharma/ahmedabad.jpg" alt="National Institute of Pharmaceutical Education and Research, Ahmedabad">
                                            <div><img src="images/Institutes_of_National_Importance/Pharma/ahmedabad_logo.jpg" width="35"> NIPER<br>Ahmedabad<br>Gujrat</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="National Institute of Pharmaceutical Education and Research, Guwahati">
                                            <img src="images/Institutes_of_National_Importance/Pharma/guwahati.jpg" alt="National Institute of Pharmaceutical Education and Research, Guwahati">
                                            <div><img src="images/Institutes_of_National_Importance/Pharma/guwahati_logo.jpg" width="35"> NIPER<br>Guwahati<br>Assam</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="National Institute of Pharmaceutical Education and Research, Hajipur">
                                            <img src="images/Institutes_of_National_Importance/Pharma/hajipur.jpg" alt="National Institute of Pharmaceutical Education and Research, Hajipur">
                                            <div><img src="images/Institutes_of_National_Importance/Pharma/hajipur_logo.jpg" width="35"> NIPER<br>Hajipur<br>Bihar</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="National Institute of Pharmaceutical Education and Research, Hyderabad">
                                            <img src="images/Institutes_of_National_Importance/Pharma/hyderabad.jpg" alt="National Institute of Pharmaceutical Education and Research, Hyderabad">
                                            <div><img src="images/Institutes_of_National_Importance/Pharma/hyderabad_logo.jpg" width="35"> NIPER<br>Hyderabad<br>Telengana</div>        	
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="National Institute of Pharmaceutical Education and Research, Kolkata">
                                            <img src="images/Institutes_of_National_Importance/Pharma/kolkata.jpg" alt="National Institute of Pharmaceutical Education and Research, Kolkata">
                                            <div><img src="images/Institutes_of_National_Importance/Pharma/kolkata_logo.jpg" width="35"> NIPER<br>Kolkata<br>West Bengal</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="National Institute of Pharmaceutical Education and Research, Mohali">
                                            <img src="images/Institutes_of_National_Importance/Pharma/mohali.jpg" alt="National Institute of Pharmaceutical Education and Research, Mohali">
                                            <div><img src="images/Institutes_of_National_Importance/Pharma/mohali_logo.jpg" width="35"> NIPER<br>Mohali<br>Punjab</div>        	
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#" title="National Institute of Pharmaceutical Education and Research, Raebareli">
                                            <img src="images/Institutes_of_National_Importance/Pharma/raebareli.jpg" alt="National Institute of Pharmaceutical Education and Research, Raebareli">
                                            <div><img src="images/Institutes_of_National_Importance/Pharma/raebareli_logo.jpg" width="35"> NIPER<br>Raebareli<br>Uttar Pradesh</div>        	
                                        </a>
                                    </div>
                                </div>
                                <!--<div class="col-6 col-md-3 mb-2">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <img src="images/Institutes_of_National_Importance/Medicine/JIPMER.jpg" alt="">
                                            <div><img src="images/Institutes_of_National_Importance/Medicine/JIPMER_logo.jpg" width="35"> All India Institute of Medical Sciences<br>Jodhpur, Rajasthan</div>        	
                                        </a>
                                    </div>
                                </div>-->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="section_4_other">
                                        <li class="link1"><a href="" title="" style="border:none">...Other Pharmaceutical Science Institutes</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="TabbedPanelsContent">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="section_4_other">
                                        <li><a href="" title="Dakshina Bharat Hindi Prachar Sabha, Chennai | Language Studies">DBHPS, Chennai</a></li>
                                        <li><a href="" title="Indian Statistical Institute, Kolkata | Statistics">ISI, Kolkata</a></li>
                                        <li><a href="" title="Kalakshetra Foundation, Chennai | Music and Dance">Kalakshetra Foundation, Chennai</a></li>
                                        <li><a href="" title="National Institute of Design, Ahmedabad | Design">NID, Ahmedabad</a></li>
                                        <li><a href="" title="Rajiv Gandhi National Institute of Youth Development, Sriperumbudur | Youth Affairs">RGNIYD, Sriperumbudur</a></li>
                                        <li><a href="" title="School of Planning and Architecture, Bhopal | Architecture">SPA, Bhopal</a></li>
                                        <li><a href="" title="School of Planning and Architecture, New Delhi | Architecture">SPA, New Delhi</a></li>
                                        <li><a href="" title="School of Planning and Architecture, Vijaywada | Architecture">SPA, Vijaywada</a></li>
                                        <li><a href="" title="Footwear Design and Development Institute, Gautam Budh Nagar | Footwear Design and Management">FDDI, Gautam Budh Nagar</a></li>
                                        <li><a href="" title="Regional Centre for Biotechnology, Faridabad | Bio-Technology">RCB, Faridabad</a></li>
                                        <li><a href="" title="Nalanda University, Rajgir | General">Nalanda University, Rajgir</a></li>
                                        <li><a href="" title="University of Allahabad, Allahabad | General">University of Allahabad, Allahabad</a></li>
                                        <li><a href="" title="Visva-Bharati University, Santiniketan | General">Visva-Bharati University, Santiniketan</a></li>
                                   	</ul>
                                </div>
                            </div>
                        </div>
                	</div>
				</div>

            </div>
        </div>
    </div>
</div>
</div>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
<!--===== SECTION-3: INSTITUTES OF NATIONAL IMPORTANCE END =====-->


<!--===== GOOGLE LINK AD START =====-->
<?php include("header.php");?>
<!--===== GOOGLE LINK AD END =====-->


<!--===== SECTION-4: COLLEGES/UNIVERSITIES IN INDIA START =====-->
<style>
ul.dept_button { list-style:none; padding:0; margin:0 }
ul.dept_button li { display:inline-block; margin:0 7px 10px 0; width:15.5% }
ul.dept_button li a { display:block;font-family:'Abel', sans-serif !important; cursor:pointer; text-decoration:none; font-size:18px; transition:500ms ease-in-out; border-radius:4px; text-align:center; color:#239700; padding:15px 0 1px 0 }
ul.dept_button li a:hover { background:#fff; color:#000; transition:500ms ease-in-out; filter: grayscale(100%);
  -webkit-filter: grayscale(100%);
  -moz-filter: grayscale(100%); }

@media only screen and (max-width: 767px) and (min-width: 100px){
ul.dept_button li { display:inline-block; margin:0; width:32%; text-align:center }
}
</style>
<div class="container-fluid pt-5 pb-3" style="padding:0; margin:0; background:#f8f8f8"><!--; background:#242d3e-->
    <div class="row">
        <div class="col-md-12 text-center">
            
			<div id="tabs" class="tabs">
                <nav>
                    <ul>
                        <li><a href="#section-1" class="left"><span>Colleges in India</span></a></li>
                        <li><a href="#section-2" class="right"><span>Universities in India</span></a></li>
                    </ul>
                </nav>
                <div class="content">
                    <section id="section-1">

                        <div class="container">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <ul class="dept_button" style="text-align:center">
                                        <li><a href=""><img src="images/brand/icon-management.png"><p>Management</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-engineering.png"><p>Engineering</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-medical.png"><p>Medical</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-agriculture.png"><p>Agriculture</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-architecture.png"><p>Architecture</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-arts.png"><p>Arts</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-aviation.png"><p>Aviation</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-commerce.png"><p>Commerce</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-dental.png"><p>Dental</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-design.png"><p>Design</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-education.png"><p>Education</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-law.png"><p>Law</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-paramedical.png"><p>Paramedical</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-pharmacy.png"><p>Pharmacy</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-science.png"><p>Science</p></a></li>
                                        <li><a href="" title="Computer Applications"><img src="images/brand/icon-computer.png"><p>Computer App.</p></a></li>
                                        <li><a href="" title="Mass Communications"><img src="images/brand/icon-mcoomunication.png"><p>Mass Comm.</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-veterinarysci.png"><p>Veterinary Sciences</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-hotelmanage.png"><p>Hotel Management</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-vocational.png"><p>Vocational Courses</p></a></li>
                                    </ul>
                                    
                                    <div id="mediabox1">
                                        <ul>                                
                                            <li><a href="" title="">Autonomous UG Colleges</a></li>
                                            <li><a href="" title="">Autonomous PG Colleges</a></li>
                                            <li><a href="" title="">Autonomous Institutions</a></li>
                                            <li><a href="" title="">Business Administration</a></li>
                                            <li><a href="" title="">Business Colleges</a></li>
                                            <li><a href="" title="">Engineering Colleges</a></li>
                                            <li><a href="" title="">Law Colleges</a></li>
                                            <li><a href="" title="">Management Colleges</a></li>
                                            <li><a href="" title="">Medical Sc. Colleges</a></li>
                                            <li><a href="" title="">Teachers' Training</a></li>
                                            <li><a href="" title="">Women's Colleges</a></li>
                                            <li class="link2"><a href="" title="">...Other Colleges</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    	                       
                    </section>
                    <section id="section-2">
                    	<div class="container">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <ul class="dept_button" style="text-align:center">
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Andhra Pradesh</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Arunachal Pradesh</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Assam</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Bihar</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Chhattisgarh</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Goa</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Gujarat</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Haryana</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Himachal Pradesh</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Jharkhand</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Karnataka</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Kerala</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Madhya Pradesh</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Maharashtra</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Manipur</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Meghalaya</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Mizoram</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Nagaland</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Odisha</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Punjab</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Rajasthan</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Sikkim</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Tamil Nadu</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Telangana</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Tripura</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Uttar Pradesh</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Uttarakhand</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>West Bengal</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Andaman & Nicobar (UT)</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Chandigarh (UT)</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Delhi (NCT)</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Jammu & Kashmir (UT)</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Ladakh (UT)</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Lakshadweep (UT)</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Puducherry (UT)</p></a></li>
                                        <li><a href=""><img src="images/brand/icon-university.png"><p>Dadra & Nagar Haveli and Daman & Diu (UT)</p></a></li>
                                   </ul>
                                    
                                    <div id="mediabox1">
                                        <ul>                                
                                            <li><a href="" title="">Autonomous Universities</a></li>
                                            <li><a href="" title="">Central Universities</a></li>
                                            <li><a href="" title="">Deemed Universities</a></li>
                                            <li><a href="" title="">Distance Universities</a></li>
                                            <li><a href="" title="">Islamic Universities</a></li>
                                            <li><a href="" title="">Open Universities</a></li>
                                            <li><a href="" title="">Private Universities</a></li>
                                            <li><a href="" title="">Sanskrit Universities</a></li>
                                            <li><a href="" title="">State Universities</a></li>
                                            <li><a href="" title="">Urdu Universities</a></li>
                                            <li class="link2"><a href="" title="">...Other Universities</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </section>
                </div>
            </div>           
            
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="FWTab/css/component.css" />
<script src="FWTab/js/cbpFWTabs.js"></script>
<script>new CBPFWTabs( document.getElementById( 'tabs' ) );</script>
<!--===== SECTION-4: COLLEGES/UNIVERSITIES IN INDIA END =====-->


<!--===== SECTION-5: EXAM START =====-->
<style>
ul.exam_button { list-style:none; padding:0; margin:0 }
ul.exam_button li { display:inline-block; margin:0 7px 10px 0; width:15.5% }
ul.exam_button li a { display:block; font-family:'Abel', sans-serif; font-size:15px; color:#fff; padding:10px 0; opacity:0.5; font-weight:normal; transition:300ms ease-in-out }
ul.exam_button li a:hover { text-decoration:none; opacity:1.0; text-shadow:1px 1px 2px #000 }

@media only screen and (max-width: 767px) and (min-width: 100px){
ul.exam_button li { display:inline-block; margin:0; width:32%; text-align:center }
}
</style>
<style>
.paralax .section_heading { font-family:'Abel', sans-serif; font-size:30px; color:#77b016; text-align: center; padding: 0; }
.paralax {
  position:relative;
  /*opacity:0.9;*/
  background-position: center;
  background-size:cover;
  background-repeat:no-repeat;
  background-attachment:fixed
}
.paralax{background-image:url(images/exams.jpg); padding:30px 0}

.paralaxlink img { margin-bottom:7px }


/*Extra small devices (portrait phones, less than 576px)*/
@media (max-width: 575.98px) { 
.paralax { display:block }
.paralaxlink img { margin-bottom:7px; height:35px }
}

/*Small devices (landscape phones, 576px and up)*/
@media (min-width: 576px) and (max-width: 767.98px) { ... }

/*Medium devices (tablets, 768px and up)*/
@media (min-width: 768px) and (max-width: 991.98px) { ... }

/*Large devices (desktops, 992px and up)*/
@media (min-width: 992px) and (max-width: 1199.98px) { ... }

/*Extra large devices (large desktops, 1200px and up)*/
@media (min-width: 1200px) { ... }
}			
</style>    
<div class="paralax">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            
            	<div class="section_heading text-center">
                    Entrance Exams in <span style="text-transform:uppercase; font-weight:bold">India</span>
                    <div style="background:#77b016; width:80px; padding:1px; margin:15px auto 25px auto"></div>  
                </div>
                
                <div class="row">
                    <ul class="exam_button paralaxlink" style="text-align:center">
                        <li><a href=""><img src="images/brand/engineering.png"><p>Engineering</p></a></li>
                        <li><a href=""><img src="images/brand/management.png"><p>Management</p></a></li>
                        <li><a href=""><img src="images/brand/science.png"><p>Science</p></a></li>
                        <li><a href=""><img src="images/brand/computerapplication.png"><p>Computer Application</p></a></li>
                        <li><a href=""><img src="images/brand/law.png"><p>Law</p></a></li>
                        <li><a href=""><img src="images/brand/pharmacy.png"><p>Pharmacy</p></a></li>
                        <li><a href=""><img src="images/brand/arts.png"><p>Arts</p></a></li>
                        <li><a href=""><img src="images/brand/education.png"><p>Education</p></a></li>
                        <li><a href=""><img src="images/brand/govtexam.png"><p>Government Exams</p></a></li>
                        <li><a href=""><img src="images/brand/commerce.png"><p>Commerce</p></a></li>
                        <li><a href=""><img src="images/brand/architecture.png"><p>Architecture</p></a></li>
                        <li><a href=""><img src="images/brand/medical.png"><p>Medical</p></a></li>
                        <li><a href=""><img src="images/brand/design.png"><p>Design</p></a></li>
                        <li><a href=""><img src="images/brand/agriculture.png"><p>Agriculture</p></a></li>
                        <li><a href=""><img src="images/brand/dental.png"><p>Dental</p></a></li>
                        <li><a href=""><img src="images/brand/paramedic.png"><p>Paramedical</p></a></li>
                        <li><a href=""><img src="images/brand/hotelmanagement.png"><p>Hotel Management</p></a></li>
                        <li><a href=""><img src="images/brand/veterinaryscience.png"><p>Veterinary Science</p></a></li>
                        <li><a href=""><img src="images/brand/vocational.png"><p>Vocational</p></a></li>
                        <li><a href=""><img src="images/brand/masscommunication.png"><p>Mass Communication</p></a></li>
                        <li><a href=""><img src="images/brand/studyabroad.png"><p>Study Abroad</p></a></li>
                    </ul>
                </div>
                
            </div>
        </div> 
    </div>
</div>
<!--===== SECTION-5: EXAM END =====-->



<!--===== SECTION-6: NEWS & NOTIFICATIONS START =====-->
<style>
.news { font-family:Rubik; font-size:15px }
.news .section_heading { font-family:'Abel', sans-serif; font-size:30px; color:#242d3e; text-align: center; padding: 0; }

.news .card { border-radius:5px }
.news .card a { color:#666; transition:300ms ease-in-out; text-decoration:none }
.news .card a:hover { color:#000 }
.news .date { color:#666; font-size:14px }
.news .card-title a { color:#000; text-decoration:none; transition:300ms ease-in-out }
.news .card-text { color:#666 }
</style>

<style>
.img-wrapper {
  max-width: 100%;
  height: 65vw;
  display: flex;
  justify-content: center;
  align-items: flex-start;
}
img {
  max-width: 100%;
  max-height: 100%;
}
@media screen and (min-width: 576px) {
  .carousel-inner {
    display: flex;
  }
  .carousel-item {
    display: block;
    margin-right: 0;
    flex: 0 0 calc(100% / 3);
  }
  .img-wrapper {
    height: 21vw;
  }
}
.carousel-inner {
  padding: 1em;
}
.card {
  margin: 0 0.5em;
  border-radius: 0;
  box-shadow: 2px 6px 8px 0 rgba(22, 22, 26, 0.18);
  font-size: 0.9em;
}

.carousel-control-prev,
.carousel-control-next {
  width: 6vh;
  height: 6vh;
  background-color: #e1e1e1;
  border-radius: 50%;
  top: 50%;
  transform: translateY(-50%);
  opacity: 0.5;
}
.carousel-control-prev:hover,
.carousel-control-next:hover {
  opacity: 0.8;
}
</style>

<div class="container news pt-4 pb-4">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        
        	<div class="section_heading text-center">
                Latest News & <span style="text-transform:uppercase; font-weight:bold">Notifications</span>
                <div style="background:#242d3e; width:80px; padding:1px; margin:15px auto 25px auto"></div>  
            </div>
        
<div id="carouselExampleControls" class="carousel">
	<div class="carousel-inner">
        <div class="carousel-item active">
            <div class="card">
                <!--<div class="img-wrapper">
                <img src="https://codingyaar.com/wp-content/uploads/multiple-items-carousel-slide-1-card-1.jpg" alt="...">
                </div>-->
                <div class="card-body">
                	<span class="date">November 06, 2024</span>
                    <h5 class="card-title"><a href="">Indian Oil Corporation Ltd., Chennai</a></h5>
                    <p class="card-text">Invites Online application from eligible Diploma holders in Engineering and Non Engineering Grduates.</p>
                    <hr>
                    <a href="#">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/></svg></a>
                </div>
            </div>
        </div>
    	<div class="carousel-item">
            <div class="card">
                <!--<div class="img-wrapper">
                <img src="https://codingyaar.com/wp-content/uploads/multiple-items-carousel-slide-1-card-1.jpg" alt="...">
                </div>-->
                <div class="card-body">
                    <span class="date">November 06, 2024</span>
                    <h5 class="card-title"><a href="">Indian Oil Corporation Ltd., Chennai</a></h5>
                    <p class="card-text">Invites Online application from eligible Diploma holders in Engineering and Non Engineering Grduates.</p>
                    <hr>
                    <a href="#">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/></svg></a>
                </div>
            </div>
    	</div>
        <div class="carousel-item">
            <div class="card">
                <!--<div class="img-wrapper">
                <img src="https://codingyaar.com/wp-content/uploads/multiple-items-carousel-slide-1-card-1.jpg" alt="...">
                </div>-->
                <div class="card-body">
                    <span class="date">November 06, 2024</span>
                    <h5 class="card-title"><a href="">Indian Oil Corporation Ltd., Chennai</a></h5>
                    <p class="card-text">Invites Online application from eligible Diploma holders in Engineering and Non Engineering Grduates.</p>
                    <hr>
                    <a href="#">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/></svg></a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="card">
                <!--<div class="img-wrapper">
                <img src="https://codingyaar.com/wp-content/uploads/multiple-items-carousel-slide-1-card-1.jpg" alt="...">
                </div>-->
                <div class="card-body">
                    <span class="date">November 06, 2024</span>
                    <h5 class="card-title"><a href="">Indian Oil Corporation Ltd., Chennai</a></h5>
                    <p class="card-text">Invites Online application from eligible Diploma holders in Engineering and Non Engineering Grduates.</p>
                    <hr>
                    <a href="#">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/></svg></a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="card">
                <!--<div class="img-wrapper">
                <img src="https://codingyaar.com/wp-content/uploads/multiple-items-carousel-slide-1-card-1.jpg" alt="...">
                </div>-->
                <div class="card-body">
                    <span class="date">November 06, 2024</span>
                    <h5 class="card-title"><a href="">Indian Oil Corporation Ltd., Chennai</a></h5>
                    <p class="card-text">Invites Online application from eligible Diploma holders in Engineering and Non Engineering Grduates.</p>
                    <hr>
                    <a href="#">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/></svg></a>
                </div>
            </div>
        </div>
	</div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
        
        </div>
	</div>
</div>

<script src='bootstrap/js/bootstrap.bundle.min.js'></script>
<script id="rendered-js" >
const multipleItemCarousel = document.querySelector("#carouselExampleControls");

if (window.matchMedia("(min-width:576px)").matches) {
const carousel = new bootstrap.Carousel(multipleItemCarousel, {
interval: false });


var carouselWidth = $(".carousel-inner")[0].scrollWidth;
var cardWidth = $(".carousel-item").width();

var scrollPosition = 0;

$(".carousel-control-next").on("click", function () {
if (scrollPosition < carouselWidth - cardWidth * 4) {
  scrollPosition = scrollPosition + cardWidth;
  $(".carousel-inner").animate({ scrollLeft: scrollPosition }, 600);
}
});
$(".carousel-control-prev").on("click", function () {
if (scrollPosition > 0) {
  scrollPosition = scrollPosition - cardWidth;
  $(".carousel-inner").animate({ scrollLeft: scrollPosition }, 600);
}
});
} else {
$(multipleItemCarousel).addClass("slide");
}
//# sourceURL=pen.js
</script>
<!--===== SECTION-6: NEWS & NOTIFICATIONS END =====-->


	<?php include("footer.php");?>
    <?php include("report_problem.php");?>
    <?php include("footer_includes.php");?>
    <?php $dbConn =NULL; ?>


    <script>

    // function debounce(func, wait) {
    //     let timeout;

    //     return function(...args) {
    //         const context = this;

    //         clearTimeout(timeout);
    //         timeout = setTimeout(() => func.apply(context, args), wait);
    //     };
    // }

    // $(document).ready(function() {
    //     $('#searchQuery').on('input', function() {
    //         var query = $(this).val();
    //         if (query.length >= 3) { // Trigger suggestions for queries of length 3 or more
    //             $.ajax({
    //                 url: 'suggestions.php',
    //                 method: 'GET',
    //                 data: { search_query: query },
    //                 success: function(data) {
    //                     $('#suggestions').html(data);
    //                 }
    //             });
    //         } else {
    //             $('#suggestions').empty();
    //         }
    //     });

    //     $(document).on('click', '.suggestion-item', function() {
    //         $('#searchQuery').val($(this).text());
    //         $('#suggestions').empty();
    //     });
    // });



    // Debounce function
function debounce(func, delay) {
    let debounceTimer;
    return function(...args) {
        const context = this;
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => func.apply(context, args), delay);
    };
}

// Search function
function search(query) {
    $('#loadingGif').show();

    $.ajax({
        url: 'suggestions.php',
        method: 'GET',
        data: { search_query: query },
        success: function(data) {
             $('#loadingGif').hide(); 
             $('#suggestions').html(data); 
        }
    });
}

// Attach the debounced search function to the input event
$('#searchQuery').on('input', debounce(function() {
    const query = $(this).val();
    if (query.length >= 3) { // Only search if the query length is 3 or more
        search(query);
    } else {
        $('#suggestions').empty(); // Clear results if the query is too short
    }
}, 300)); // 300ms delay

$(document).on('click', '.suggestion-item', function() {
            $('.list-type').text("");
            //$('#searchQuery').val($(this).text());
            $('#searchQuery').val('');
            $('#suggestions').empty();
        });
    </script>
</body>
</html>