<?php 
// include("configuration.php");

$suggestions = [];
$collegeResult =[];
$universityResult =[];
$examResult =[];
$is_active = 1;
$is_new = 1;
//NOTICE COLLEGE
$stmt_notices_college = $dbConn->prepare("SELECT TOP 5  notice_colleges.notice_title as name,notice_colleges.slug, notice_colleges.url_link, notice_colleges.notice_date, notice_colleges.is_new ,'College Notice' as type, colleges.college_name As college_name , colleges.logo_img as college_logo_img FROM notice_colleges LEFT JOIN colleges ON notice_colleges.college_id = colleges.id WHERE  notice_colleges.is_active= :is_active AND notice_colleges.is_new= :is_new ORDER BY notice_colleges.notice_date DESC, notice_colleges.id DESC ");

$stmt_notices_college->bindParam(':is_active',$is_active);   
$stmt_notices_college->bindParam(':is_new',$is_new);
$stmt_notices_college->execute();
$collegeResult = $stmt_notices_college->fetchAll(PDO::FETCH_ASSOC);

$suggestions = array_merge($suggestions, $collegeResult);

//NOTICE UNIVERSITY
$stmt_notices_university = $dbConn->prepare("SELECT TOP 5 notice_universities.notice_title as name,notice_universities.slug, notice_universities.url_link, notice_universities.notice_date, notice_universities.is_new ,'University Notice' as type,  universities.university_name As university_name , universities.logo_img as university_logo_img FROM notice_universities  LEFT JOIN universities ON notice_universities.university_id = universities.id  WHERE notice_universities.is_active= :is_active AND notice_universities.is_new= :is_new ORDER BY notice_universities.notice_date DESC");
$stmt_notices_university->bindParam(':is_active',$is_active);  
$stmt_notices_university->bindParam(':is_new',$is_new);  
$stmt_notices_university->execute();
$universityResult = $stmt_notices_university->fetchAll(PDO::FETCH_ASSOC);
$suggestions = array_merge($suggestions, $universityResult);

//NOTICE EXAMS
$stmt_notices_exam = $dbConn->prepare("SELECT TOP 5 notice_exams.notice_title as name,notice_exams.slug, notice_exams.url_link , notice_exams.notice_date,notice_exams.is_new, 'Exam Notice' as type, exams.exam_name As exam_name, exams.logo_img as exam_logo_img FROM notice_exams  LEFT JOIN exams ON notice_exams.exam_id = exams.id WHERE  notice_exams.is_active= :is_active AND notice_exams.is_new= :is_new ORDER BY notice_exams.notice_date DESC");
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


<div class="card border" style="border-radius:5px; box-shadow:none">
    <div class="card-header border-light-subtle border-bottom" style="font-family:Abel !important; font-size:16px; padding-top:10px; padding-bottom:10px; font-weight:bold; background:#242d3e; color:#FFF">
    	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/></svg> &nbsp;LATEST UPDATES <?php echo CURRENT_YEAR;?>
    </div>
    <div class="card-body LatestUpdates_Height">
        <style type="text/css">
        .LatestUpdates_Height{height:322px; max-height:322px; overflow:auto; overflow-x: hidden;}
        .LatestUpdates {list-style:none; padding:0; margin:0; text-align:left; font-family:Rubik}
        .LatestUpdates li {padding:7px 0 7px 40px; margin:0; border-bottom:1px dashed #CCCCCC; background: url(<?php echo BASE_URL;?>/images/institution.png) left no-repeat; transition:300ms ease-in-out}
		.LatestUpdates li:hover {background: #f5f5f5 url(<?php echo BASE_URL;?>/images/institution.png) left no-repeat;}
		.LatestUpdates li a { font-weight: bold }
        .LatestUpdates .PDate{color:#C00}
        .LatestUpdates .instituteName{color:#000}
		
		button.active { font-weight: bold }
        </style>
        
        <style>
			.nav-tabs button { font-family:Rubik; text-transform:uppercase }
			a.btnView { color:#ccc; text-decoration:none; transition:300ms ease-in-out; font-family:Abel; font-size:16px; text-decoration:none }
			a.btnView:hover { color:#fff }
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
					<button class="nav-link" id="exam-tab" data-bs-toggle="tab" data-bs-target="#exam" type="button" role="tab" aria-controls="exam" aria-selected="false">Examination</button>
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
    <div class="card-footer border-light-subtle border-top text-end" style="background:#242d3e; color:#FFF">
    	<a href="<?php echo BASE_URL."/latest-updates" ?>" title="Click here to view all updates." class="btnView">
			View all updates <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/></svg>
        </a>
    </div>
</div>
<!--
<br />

<div class="card">
    <div class="card-header bg-dark text-white" style="font-family:Abel !important; font-size:16px; padding-top:10px; padding-bottom:10px">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/></svg> LATEST UPDATES <?php echo CURRENT_YEAR;?>
    </div>
    <div class="card-body border border-dark p-2 LatestUpdates_Height">
        <style type="text/css">
        .LatestUpdates_Height{height:322px; max-height:322px; overflow:auto; overflow-x: hidden;}
        .LatestUpdates {list-style:none; padding:0; margin:0; text-align:left; font-family:Rubik}
        .LatestUpdates li {padding:7px 0 7px 40px; margin:0; border-bottom:1px dashed #CCCCCC; background: url(<?php echo BASE_URL;?>/images/institution.png) left no-repeat; transition:300ms ease-in-out}
		.LatestUpdates li:hover {background: #f5f5f5 url(<?php echo BASE_URL;?>/images/institution.png) left no-repeat;}
        .LatestUpdates .PDate{color:#C00}
        .LatestUpdates .instituteName{color:#000}
        </style>
        
        <style>
			.nav-tabs button { font-family:Rubik; font-weight:bold }
			a.btnView { color:#666; text-decoration:none; transition:300ms ease-in-out; font-family:Abel; font-size:16px; text-decoration:none }
			a.btnView:hover { color:#000 }
		</style>
        
        <div class="container-fluid">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="college-tab" data-bs-toggle="tab" data-bs-target="#college" type="button" role="tab" aria-controls="college" aria-selected="true">College</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="university-tab" data-bs-toggle="tab" data-bs-target="#university" type="button" role="tab" aria-controls="university" aria-selected="false">University</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="exam-tab" data-bs-toggle="tab" data-bs-target="#exam" type="button" role="tab" aria-controls="exam" aria-selected="false">Examination</button>
				</li>
			</ul>

			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="college" role="tabpanel" aria-labelledby="college-tab">
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
    <div class="card-footer bg-dark text-end">

        <a href="<?php echo BASE_URL."/latest-updates" ?>" title="Click here to view all updates." class="btnView">
			View all updates <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/></svg>
        </a>
    </div>
</div>-->