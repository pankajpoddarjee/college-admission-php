<?php 
// include("configuration.php");

$suggestions = [];
$collegeResult =[];
$universityResult =[];
$examResult =[];
$is_active = 1;
$is_new = 1;
//NOTICE COLLEGE
$stmt_notices_college = $dbConn->prepare("SELECT TOP 2  notice_colleges.notice_title as name,notice_colleges.slug, notice_colleges.url_link, notice_colleges.notice_date, notice_colleges.is_new ,'College Notice' as type, colleges.college_name As college_name , colleges.logo_img as college_logo_img FROM notice_colleges LEFT JOIN colleges ON notice_colleges.college_id = colleges.id WHERE  notice_colleges.is_active= :is_active AND notice_colleges.is_new= :is_new ORDER BY notice_colleges.notice_date DESC ");

$stmt_notices_college->bindParam(':is_active',$is_active);   
$stmt_notices_college->bindParam(':is_new',$is_new);
$stmt_notices_college->execute();
$collegeResult = $stmt_notices_college->fetchAll(PDO::FETCH_ASSOC);

$suggestions = array_merge($suggestions, $collegeResult);

//NOTICE UNIVERSITY
$stmt_notices_university = $dbConn->prepare("SELECT TOP 2 notice_universities.notice_title as name,notice_universities.slug, notice_universities.url_link, notice_universities.notice_date, notice_universities.is_new ,'University Notice' as type,  universities.university_name As university_name , universities.logo_img as university_logo_img FROM notice_universities  LEFT JOIN universities ON notice_universities.university_id = universities.id  WHERE notice_universities.is_active= :is_active AND notice_universities.is_new= :is_new ORDER BY notice_universities.notice_date DESC");
$stmt_notices_university->bindParam(':is_active',$is_active);  
$stmt_notices_university->bindParam(':is_new',$is_new);  
$stmt_notices_university->execute();
$universityResult = $stmt_notices_university->fetchAll(PDO::FETCH_ASSOC);
$suggestions = array_merge($suggestions, $universityResult);

//NOTICE EXAMS
$stmt_notices_exam = $dbConn->prepare("SELECT TOP 2 notice_exams.notice_title as name,notice_exams.slug, notice_exams.url_link , notice_exams.notice_date,notice_exams.is_new, 'Exam Notice' as type, exams.exam_name As exam_name, exams.logo_img as exam_logo_img FROM notice_exams  LEFT JOIN exams ON notice_exams.exam_id = exams.id WHERE  notice_exams.is_active= :is_active AND notice_exams.is_new= :is_new ORDER BY notice_exams.notice_date DESC");
$stmt_notices_exam->bindParam(':is_active',$is_active);
$stmt_notices_exam->bindParam(':is_new',$is_new);    
$stmt_notices_exam->execute();
$examResult = $stmt_notices_exam->fetchAll(PDO::FETCH_ASSOC);
$suggestions = array_merge($suggestions, $examResult);



// Shuffle the array
shuffle($suggestions);
// Sort the array by 'notice_date'
usort($suggestions, function($a, $b) {
  return strtotime($b['notice_date']) - strtotime($a['notice_date']);
});


// Print the shuffled and sorted array
//print_r($suggestions);
?>

<div class="card">
    <div class="card-header bg-danger text-white">
        <i class="far fa-clock"></i> LATEST UPDATES <?php echo CURRENT_YEAR;?>
    </div>
    <div class="card-body border border-danger p-2 LatestUpdates_Height">
        <style type="text/css">
        .LatestUpdates_Height{height:200px; max-height:200px; overflow:auto; overflow-x: hidden;}
        .LatestUpdates {list-style:none; padding:0; margin:0; text-align:left; font-family:Rubik}
        .LatestUpdates li {padding:0 0 0 40px; margin:10px 0; border-bottom:1px dashed #CCCCCC; background: url(<?php echo BASE_URL;?>/images/institution.png) left top no-repeat;}
        .LatestUpdates .PDate{color:#C00}
        .LatestUpdates .instituteName{color:#000}
        </style>
        
        <div class="container-fluid">
			<!-- Tabs Navigation -->
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="college-tab" data-bs-toggle="tab" data-bs-target="#college" type="button" role="tab" aria-controls="college" aria-selected="true">College</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="university-tab" data-bs-toggle="tab" data-bs-target="#university" type="button" role="tab" aria-controls="university" aria-selected="false">University</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="exam-tab" data-bs-toggle="tab" data-bs-target="#exam" type="button" role="tab" aria-controls="exam" aria-selected="false">Exam</button>
				</li>
			</ul>

			<!-- Tabs Content -->
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="college" role="tabpanel" aria-labelledby="college-tab">
					<!-- <h3>College Notices</h3> -->
					<ul class="LatestUpdates">
					<?php if(count($collegeResult) > 0){
							  foreach ($collegeResult as $value) {
							  $from = "";
							  $link = "";                                         
							  $from = $value['college_name'];                                         
							  if(isset($value['url_link']) && $value['url_link'] !=''){
								$link = $value['url_link'];
							  }else{
								$link = BASE_URL.'/'.$value['slug'];
							  }
						?>
					<li>
					  <span class="PDate"><?php echo isset($value['notice_date'])?date('d M Y', strtotime($value['notice_date'])):""; ?> -</span>
					  <span class="instituteName"><?php echo $from; ?></span> <?php echo ($value['is_new'] == 1)?"<span class='new_tag badge text-bg-danger fa-fade'>New</span>":""; ?><br>
					  <a target="_blank" href="<?php echo $link; ?>"><?php echo isset($value['name'])?$value['name']:""; ?></a>
					</li>

					<?php } } ?>
					</ul>
				</div>
				<div class="tab-pane fade" id="university" role="tabpanel" aria-labelledby="university-tab">
					<!-- <h3>University Notices</h3> -->
					<ul class="LatestUpdates">
					<?php if(count($universityResult) > 0){
							  foreach ($universityResult as $value) {
							  $from = "";
							  $link = "";                                         
							  $from = $value['university_name'];                                         
							  if(isset($value['url_link']) && $value['url_link'] !=''){
								$link = $value['url_link'];
							  }else{
								$link = BASE_URL.'/'.$value['slug'];
							  }
						?>
					<li>
					  <span class="PDate"><?php echo isset($value['notice_date'])?date('d M Y', strtotime($value['notice_date'])):""; ?> -</span>
					  <span class="instituteName"><?php echo $from; ?></span> <?php echo ($value['is_new'] == 1)?"<span class='new_tag badge text-bg-danger fa-fade'>New</span>":""; ?><br>
					  <a target="_blank" href="<?php echo $link; ?>"><?php echo isset($value['name'])?$value['name']:""; ?></a>
					</li>

					<?php } } ?>
					</ul>
				</div>
				<div class="tab-pane fade" id="exam" role="tabpanel" aria-labelledby="exam-tab">
					<!-- <h3>Exam Notices</h3> -->
					<ul class="LatestUpdates">
					<?php if(count($examResult) > 0){
							  foreach ($examResult as $value) {
							  $from = "";
							  $link = "";                                         
							  $from = $value['exam_name'];                                         
							  if(isset($value['url_link']) && $value['url_link'] !=''){
								$link = $value['url_link'];
							  }else{
								$link = BASE_URL.'/'.$value['slug'];
							  }
						?>
					<li>
					  <span class="PDate"><?php echo isset($value['notice_date'])?date('d M Y', strtotime($value['notice_date'])):""; ?> -</span>
					  <span class="instituteName"><?php echo $from; ?></span> <?php echo ($value['is_new'] == 1)?"<span class='new_tag badge text-bg-danger fa-fade'>New</span>":""; ?><br>
					  <a target="_blank" href="<?php echo $link; ?>"><?php echo isset($value['name'])?$value['name']:""; ?></a>
					</li>

					<?php } } ?>
					</ul>
				</div>
			</div>
		</div>
    </div>
    <div class="card-footer bg-danger text-white text-right">
        <!-- <a href="javascript:void(0)" title="Click here to view all updates." class="btn-link text-light">
            <i class="fas fa-angle-double-right"></i> VIEW ALL UPDATES
        </a> -->

        <a href="<?php echo BASE_URL."/latest-updates" ?>" title="Click here to view all updates." class="btn-link text-light">
            <i class="fas fa-angle-double-right"></i> VIEW ALL UPDATES
        </a>
    </div>
</div>