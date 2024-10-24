<?php include('../settings.php');?>
<?php include("../connection.php");include("../function.php");

$fetchallExamqry = "SELECT ID, examType, examCourseType, examName, ISNULL(examFullName,'') AS examFullName, folderName, fileName, ogImage FROM MasterExams WHERE examType='Entrance Exam' AND IsActive='1' order by examName";
$qryExamResult = $dbConn->query($fetchallExamqry);if($qryExamResult) {while ($row=$qryExamResult->fetch(PDO::FETCH_ASSOC)) {$recordExam[] =$row;}} 
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>Entrance Exams in India | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="">
<meta name="description" content="List of Entrance Exams in India">
<meta property="og:title" content="Entrance Exams in India | <?php echo SITE_NAME;?>">
<meta property="og:description" content="List of Entrance Exams in India">
<meta property="og:image" content="<?php echo BASE_URL;?>/images/entrance_exam.jpg">
<meta property="og:url" content="<?php echo BASE_URL;?>/Exam/entrance_exam.php">
<?php echo OTHER_META_TAGS;?>
<?php include("../head_includes.php");?>
<style type="text/css">
.listing_links a{color:rgba(51,51,51,0.7); font-size:12px}
</style>
</head>
<body>
	<?php include("../header.php");?>
    <?php include("../menu.php");?>    
    <section class="bg-light">
        <div class="container-fluid page_header">
            <div class="row">
                <div class="col-md-10">
                    <img class="rounded" src="<?php echo BASE_URL;?>/images/exam.png" alt="logo" title="logo">
                    <a href="<?php echo BASE_URL;?>/Exam/entrance_exam.php" title="entrance exams in india">
                        <h1>Entrance Exams in India</h1>
                    </a>
                    <span class="subType1">
                        <i class="fa fa-leanpub"></i> <a href="" title="">Engineering</a>, <a href="" title="">IIM</a>, <a href="" title="">Law</a>, <a href="" title="">Medical</a>, Etc.
                    </span>
                    <span class="subType2">
                        <i class="fa fa-pencil-square-o"></i> <a href="" title="">AIEEE</a>, <a href="" title="">BITSAT</a>, <a href="" title="">CAT</a>, <a href="" title="">CLAT</a>, <a href="" title="">GATE</a>, Etc.
                    </span>
                </div>
                <div class="col-md-2">
                    <?php if(SHOW_C_PAGE_HEADER_ADM_LINK==1) {?>
                    <a class="btn btn-danger btn-block p-2 pb-2 mt-4" href="">
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
					<?php include("../google_ads_horizontal.php");?>
                </div>
                <?php include("../college_page_social_share_button.php");?>
            </div>
        </div>
    </section>
    
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                	<div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert-info p-3" style="font-family:Rubik"><i class="fa fa-pencil-square-o"></i> List of Entrance Exams in India</h4>
                        </div>
                    </div>
                    
                	<div class="row ml-0 mr-0 mt-4 pt-3 pb-3 bg-light" style="font-family:'Viga'">                        
                        
						<?php ?>
						<?php 
							$i=0;
							foreach($recordExam as $rec){
							$i=$i+1;
                        ?>
                        
                        <div class="col-md-3 mb-4">
                            <div class="img-thumbnail">
                                <div class="row">
                                	<div class="col-12">
                                    	<a href="<?php echo BASE_URL;?>/Exam/<?php echo $rec["folderName"];?>/<?php echo $rec["fileName"];?>" title="<?php echo $rec["examFullName"];?> [<?php echo $rec["examName"];?>]">
                                            <img class="img-fluid border p-1" src="<?php echo BASE_URL;?>/Exam/<?php echo $rec["folderName"];?>/<?php echo $rec["ogImage"];?>" alt="">
                                            <div class="ml-2" style="margin-top:-35px; position:relative">
                                                <img class="img-fluid bg-white p-1 rounded d-block" src="<?php echo BASE_URL;?>/Exam/<?php echo $rec["folderName"];?>/logo.jpg" width="45" alt=""> 
                                            </div>
                                            <div class="">
                                                <span class="text-danger">
													<?php echo $rec["examFullName"];?> [<?php echo $rec["examName"];?>]
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <?php ?>                        
                    </div>
                    
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                        	<?php include("../google_ads_contextual.php");?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
	<?php include("../footer.php");?>
    <?php include("../footer_includes.php");?>
    
    <?php $dbConn =NULL; ?>
</body>
</html>