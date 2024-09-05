<?php $slug_url = isset($_GET['slug']) ? "university/".$_GET['slug'] : '';  ?>
<?php include('settings.php');
include("connection.php");
include("QRY_CAuniversityMainPage.php");
$universityRecord = [];
$fetchallqry = "SELECT id,university_name  FROM universities WHERE slug='".$slug_url."'";
$stmt = $dbConn->prepare($fetchallqry);
$stmt->execute();
$universityRecord = $stmt->fetch(PDO::FETCH_ASSOC);

if(count($universityRecord)>0){
    $university_id = $universityRecord['id'];
    $university_name = $universityRecord['university_name'];
    $records = [];
    $current_year = CURRENT_YEAR_DISPLAY_C_PAGE;
    $fetchallqry = "SELECT * FROM notices WHERE university_id=$university_id AND notice_year = $current_year AND is_active=1 order by notice_date desc, id desc" ;
    $stmt = $dbConn->prepare($fetchallqry);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $record['university_name'];?> Notice <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo $university_name;?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, <?php echo $university_name;?> merit list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, <?php echo $university_name;?> contact">
<meta name="description" content="<?php echo $university_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta property="og:title" content="<?php echo $record['university_name'];?> Notice <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?>">
<meta property="og:description" content="<?php echo $university_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">

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
    
    <?php include("university_page_header.php");?>
    <?php include("university_page_menu.php");?>
    <style type="text/css">
	.active_notice{color:#FC0 !important;}
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
                            <h4 class="alert alert-info" title="<?php echo strtolower($university_name);?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>" style="font-family:Oswald"><i class="fa-solid fa-bullhorn"></i> Notices <strong id="notice-archived-year"><?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?><strong></h4>

                        </div>
                    </div>
                	<div class="row">


                        <?php 
                                $sql = "select distinct notice_year from notices where university_id = $university_id AND is_active=1 order by notice_year desc";
                                $stmt = $dbConn->prepare($sql);
                                $stmt->execute();
                                $qryresult = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                if($qryresult) {
                        ?>
                        <div class="col-md-4 float-end">
                            <form action="../">

                                
                                <select class="custom-select" onchange="showArchiveData(this.value)" style="padding:3px; width:100%" id="archived-year">
                                    <?php if(count($qryresult)==1){ ?>
                                    <option value="">Select</option>
                                    <?php } ?>
                                    <?php 
                                            foreach ($qryresult as $row) {
                                    ?>
                                    <option value="<?php echo $row['notice_year']; ?>"><?php echo $row['notice_year']; ?></option>
                                    <?php }  ?>
                                </select>
                            </form>
                        </div>
                        <?php }  ?>
                        <div class="col-md-12 mt-2">
                            <ul class="notice_list" id="university-notice-list">
                                <?php if(count($records)>0){
                                    foreach ($records as  $record) { 
                                        $custom_link = "";
                                        $target = "";
                                        if($record['notice_type'] == 'page'){
                                            $custom_link = BASE_URL."/".$record['slug'];
                                            $target = "_self";
                                        }
                                        if($record['notice_type'] == 'url'){
                                            $custom_link = $record['url_link']; 
                                            $target = "_blank";
                                        }
                                        
                                        ?>
                                    <li>
                                        <a target="<?php echo $target; ?>" href="<?php echo $custom_link ?>" title="<?php echo strtolower($university_name); ?> <?php echo strtolower($record['notice_title']); ?>">
                                            <img src="<?php echo BASE_URL;?>/<?php echo SITE_LOGO;?>" alt="" class="float-start me-2 rounded-circle">
                                            <?php echo $record['notice_title']; ?>
                                            <?php if($record['is_new']==1){ ?>
                                                <span class="new_tag badge text-bg-danger fa-fade">New</span>
                                            <?php } ?>

                                            <br>
                                            <span class="p_date">
                                                <i class="fa-solid fa-calendar-days"></i> <?php echo date('d M Y', strtotime($record['notice_date'])); ?>
                                            </span>
                                        </a>
                                    </li>
                                <?php    }
                                } ?>
                            </ul>
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

    <script>
        function showArchiveData(year){
            $('#dvLoading').show();
            $.ajax({
                    type: "get",
                   // async: false,
                   url: "<?php echo BASE_URL;?>/Get_archived_notice.php?year=" + year +'&type=university&university_id='+ '<?php echo $university_id?>',
                    success: function(data) {
                            console.log(data);

                                $('#university-notice-list').html(data);
                                $('#notice-archived-year').text(year);
                        
                    }
                });
        }
    </script>
</body>
</html>