<?php $slug_url = isset($_GET['slug']) ? "college/".$_GET['slug'] : '';  ?>
<?php include('settings.php');
include("connection.php");
include("QRY_CAcollegeMainPage.php");
$collegeRecord = [];
$fetchallqry = "SELECT id,college_name  FROM colleges WHERE slug='".$slug_url."'";
$stmt = $dbConn->prepare($fetchallqry);
$stmt->execute();
$collegeRecord = $stmt->fetch(PDO::FETCH_ASSOC);

if(count($collegeRecord)>0){
    $college_id = $collegeRecord['id'];
    $college_name = $collegeRecord['college_name'];
    $records = [];
    $current_year = CURRENT_YEAR_DISPLAY_C_PAGE;
    $fetchallqry = "SELECT * FROM notice_colleges WHERE college_id=$college_id AND notice_year = $current_year AND is_active=1 order by notice_date desc, id desc" ;
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
<title ><?php echo $record['college_name'];?> Notice <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo $college_name;?> admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, <?php echo $college_name;?> merit list <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, <?php echo $college_name;?> contact">
<meta name="description" content="<?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">
<meta property="og:title" content="<?php echo $record['college_name'];?> Notice <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?> | <?php echo SITE_NAME;?>">
<meta property="og:description" content="<?php echo $college_name;?> Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Merit List <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Online Counselling <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>">

<meta property="og:image" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $banner_img;?>">
<meta property="og:url" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $file_name;?>">

<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>

<style type="text/css">
	.adm_Updates a {display:block; text-decoration:none; transition:200ms ease-in-out; font-family:Viga; font-size:14px}
	.adm_Updates a:hover { color:#F00}
	.publishDetails {color:#555; font-size:12px; display:block; transition:200ms ease-in-out}
	.adm_Updates a:hover .publishDetails{color:#000}
	.adm_Updates a:hover .publishDetails i{color:#000}
	.adm_Updates .new_tag{font-size:9px; vertical-align:middle}
</style>

</head>
<body>
	<?php include("header.php");?>
    <?php include("menu.php");?>
    
    <?php include("college_page_header.php");?>
    <?php include("college_page_menu.php");?>
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
                            <h4 class="alert alert-info" style="font-family:Oswald"><i class="fa-solid fa-bullhorn"></i> Notices <span id="notice-archived-year"><?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></span></h4>
                        </div>
                    </div>
                	<div class="row">
                        <?php 
                                $sql = "select distinct notice_year from notice_colleges where college_id = $college_id AND is_active=1 order by notice_year desc";
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
                        
                        	<div class="input-group mb-3 mt-2">    
                                <input type="search" class="light-table-filter form-control p-3" data-table="order-table" aria-describedby="search" placeholder="Search">
                            </div>
                            
                            <table class="table table-bordered table-hover order-table adm_Updates" id="college-notice-list" style="font-family:Viga">
                                <tbody>
                                <?php if (count($records) > 0) {
                                    foreach ($records as $record) { 
                                        $custom_link = "";
                                        $target = "";
                                        
                                        if ($record['notice_type'] == 'page') {
                                            $custom_link = BASE_URL . "/" . $record['slug'];
                                            $target = "_self";
                                        }
                                        if ($record['notice_type'] == 'url') {
                                            $custom_link = $record['url_link']; 
                                            $target = "_blank";
                                        }							
                                ?>
                                    <tr>
                                        <td>
                                            <a target="<?php echo $target; ?>" href="<?php echo $custom_link ?>">
                                                <span class="publishDetails">
                                                    <i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($record['notice_date'])); ?>
                                                    <?php if ($record["course_for"] != 'NA') { ?> 
                                                        | <i class="fa fa-graduation-cap"></i> <?php echo $record["course_for"]; ?>
                                                    <?php } ?> 
                                                    | <i class="fa fa-file-text-o"></i> <?php echo $record["notice_category"]; ?>
                                                </span>
												<?php echo $record["notice_title"]; ?>&nbsp;
                                                <?php if ($record["is_new"] == 1) { ?>
                                                    <span class="new_tag badge text-bg-danger fa-fade">New</span>
                                                <?php } ?>
                                                
                                            </a>
                                        </td>
                                    </tr>
                                <?php 
                                    } 
                                } ?> 
                                </tbody>
                            </table>
                            
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
            //$url = "http://localhost/main.php?email=$email_address&event_id=$event_id";
            $.ajax({
                    type: "get",
                   // async: false,
                    url: "<?php echo BASE_URL;?>/Get_archived_notice.php?year=" + year +'&type=college&college_id='+ '<?php echo $college_id?>',
                    success: function(data) {
                            console.log(data);

                                $('#college-notice-list').html(data);
                                $('#notice-archived-year').text(year);
                        
                    }
                });
        }
    </script>
</body>
</html>