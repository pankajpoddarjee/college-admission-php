<?php $slug_url = isset($_GET['slug']) ? "exams/".$_GET['slug'] : '';  ?>

<?php include('settings.php');
include("connection.php");
include("function.php");
include("QRY_CAexamMainPage.php");


    $records = [];
    $current_year = CURRENT_YEAR_DISPLAY_C_PAGE;
    $fetchallqry = "SELECT * FROM notice_exams WHERE exam_id=$exam_id AND is_active=1 order by notice_date desc, id desc" ;
    $stmt = $dbConn->prepare($fetchallqry);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $record['exam_name'];?> | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo $exam_name;?>">
<meta name="description" content="<?php echo $exam_name;?>">
<meta property="og:title" content="<?php echo $exam_name;?>">
<meta property="og:description" content="<?php echo $exam_name;?>">
<meta property="og:image" content="">
<meta property="og:url" content="">
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
    
    <?php include("exam_page_header.php");?>
    <?php include("exam_page_menu.php");?>
    <style type="text/css">
	.active_overview{color:#FC0 !important;}
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                	<div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert alert-info" style="font-family:Oswald"><?php echo $record['exam_name'];?></h4>
                        </div>
                    </div>

                	<div class="row">
                        
                        <div class="col-md-12 mt-2">
                            <?php if(isset($html_page)  && !empty($html_page) ){ 
                                include("uploads/exam/html_page/".$html_page);                                
                            }
                            ?>
                        </div>

                        <div class="col-md-12 mt-2">                        
                        	<h2>Notice</h2>
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
</body>
</html>