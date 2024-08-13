<?php include('settings.php');?>
<?php include("connection.php");include("function.php");

$record = array();

$fetchallqry = "SELECT c.ID, college_name, ISNULL(c.short_name,'') AS shortName, college_type_id, c.country_id, co.country_name, c.state_id, s.state_name, c.city_id, ci.city_name, c.banner_img, c.logo_img, c.folder_name, c.file_name FROM colleges c 
JOIN countries co ON c.country_id=co.ID 
JOIN [states] s ON c.state_id=s.ID 
JOIN cities ci ON c.city_id=ci.ID 
WHERE c.city_id='1' AND c.is_active=1 order by c.college_name";
$qryresult = $dbConn->query($fetchallqry);if($qryresult) {while ($row=$qryresult->fetch(PDO::FETCH_ASSOC)) {$record[] =$row;}} 
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>Colleges in Kolkata, list of colleges in kolkata | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="colleges in kolkata, kolkata colleges, list of colleges in kolkata, colleges in calcutta, calcutta colleges, ba / bsc colleges in kolkata, ba / bsc colleges in calcutta, ug colleges, ug colleges kolkata, ug colleges in kolkata, pg colleges, pg colleges kolkata, pg colleges in kolkata, under graduate colleges, under graduate colleges kolkata, under graduate colleges in kolkata, under graduate colleges, under graduate colleges kolkata, under graduate colleges in kolkata, post graduate colleges, post graduate colleges kolkata, post graduate colleges in kolkata, post graduate college in kolkata, post graduate college, post graduate college kolkata, under graduate college in kolkata, under graduate college, under graduate college kolkata, kolkata colleges list">
<meta name="description" content="List of Under Graduate (UG) and Post Graduate (PG) Colleges in Kolkata, List of Colleges in Kolkata, kolkata college list.">
<meta property="og:title" content="Colleges in Kolkata, list of colleges in kolkata | <?php echo SITE_NAME;?>">
<meta property="og:description" content="List of Under Graduate (UG) and Post Graduate (PG) Colleges in Kolkata, List of Colleges in Kolkata, kolkata college list.">
<meta property="og:image" content="<?php echo BASE_URL;?>/images/kolkata-colleges.jpg">
<meta property="og:url" content="<?php echo BASE_URL;?>/kolkata-colleges.php">
<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>

<script>
$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        // User has reached the bottom of the page
    }
});
</script>

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
            /* height: 100px; */
            margin-bottom: 20px;
            background: #c0c0c0;;
            border-radius: 4px;
            overflow: hidden;
            flex-flow: row wrap;
            flex-direction: row;
            flex-wrap: wrap;
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
        }
</style>

</head>
<body>

	<?php include("header.php");?>
    <?php include("menu.php");?>    
    <section class="bg-light">
        <div class="container-fluid page_header">
            <div class="row">
                <div class="col-md-10">
                    <img class="rounded" src="images/kolkata-colleges.png" alt="logo" title="logo">
                    <a href="<?php echo BASE_URL;?>/kolkata-colleges.php" title="colleges in kolkata">
                        <h1 style="font-family:Oswald">List of Colleges in Kolkata</h1>
                    </a>
                    <span class="subType1">
                        <i class="fa fa-map-marker"></i> <a href="<?php echo BASE_URL;?>/kolkata-colleges.php" title="kolkata colleges list">Kolkata</a>, <a href="" title="">West Bengal</a>, <a href="" title="">India</a>
                    </span>
                    <span class="subType2">
                        <i class="fas fa-university"></i> <a href="" title="list">All Universities</a>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                	<div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert alert-info p-3" style="font-family:Oswald"><i class="fas fa-building"></i> List of Colleges in Kolkata</h4>
                        </div>
                    </div>

                    <div class="row align-items-center m-0 p-2" id="shimmerLoading">
                        <div class="col-md-3 mb-4">
                            <div class="img-thumbnail">
                                <div class="row">
                                    <div class="col-12">
                                        <a>
                                            <div class="shimmer listing_banner"><img class="img-fluid border p-1" alt="" /></div>

                                            <div class="shimmer ms-2 listing_logo" style="margin-top:-50px; margin-bottom:7px; width: 45px; height: 45px;"><img class="img-fluid border p-1 rounded" alt="" /></div>
                                            <div class="border-bottom pb-1">
                                                <div class="shimmer text-danger m-0 mb-1" style="width:85%">&nbsp;</div>
                                                <div class="shimmer text-dark m-0" style="width:40%">&nbsp;</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-12 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-1">
                                            &nbsp;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <div class="img-thumbnail">
                                <div class="row">
                                    <div class="col-12">
                                        <a>
                                            <div class="shimmer listing_banner"><img class="img-fluid border p-1" alt="" /></div>

                                            <div class="shimmer ms-2 listing_logo" style="margin-top:-50px; margin-bottom:7px; width: 45px; height: 45px;"><img class="img-fluid border p-1 rounded" alt="" /></div>
                                            <div class="border-bottom pb-1">
                                                <div class="shimmer text-danger m-0 mb-1" style="width:85%">&nbsp;</div>
                                                <div class="shimmer text-dark m-0" style="width:40%">&nbsp;</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-12 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-1">
                                            &nbsp;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <div class="img-thumbnail">
                                <div class="row">
                                    <div class="col-12">
                                        <a>
                                            <div class="shimmer listing_banner"><img class="img-fluid border p-1" alt="" /></div>

                                            <div class="shimmer ms-2 listing_logo" style="margin-top:-50px; margin-bottom:7px; width: 45px; height: 45px;"><img class="img-fluid border p-1 rounded" alt="" /></div>
                                            <div class="border-bottom pb-1">
                                                <div class="shimmer text-danger m-0 mb-1" style="width:85%">&nbsp;</div>
                                                <div class="shimmer text-dark m-0" style="width:40%">&nbsp;</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-12 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-1">
                                            &nbsp;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <div class="img-thumbnail">
                                <div class="row">
                                    <div class="col-12">
                                        <a>
                                            <div class="shimmer listing_banner"><img class="img-fluid border p-1" alt="" /></div>

                                            <div class="shimmer ms-2 listing_logo" style="margin-top:-50px; margin-bottom:7px; width: 45px; height: 45px;"><img class="img-fluid border p-1 rounded" alt="" /></div>
                                            <div class="border-bottom pb-1">
                                                <div class="shimmer text-danger m-0 mb-1" style="width:85%">&nbsp;</div>
                                                <div class="shimmer text-dark m-0" style="width:40%">&nbsp;</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-6 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-2">
                                            &nbsp;
                                        </a>
                                    </div>
                                    <div class="col-12 listing_links">
                                        <a class="shimmer btn border btn-sm w-100 mb-1">
                                            &nbsp;
                                        </a>
                                    </div>
                                </div>
                            </div>
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
    
	
    <?php include("footer_includes.php");?>
     <script src="<?php echo BASE_URL;?>/js/college.js"></script>
    <?php $dbConn =NULL; ?>
</body>
</html>