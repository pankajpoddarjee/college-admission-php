
<?php include('settings.php');?>
<?php include("connection.php");
include("function.php"); 

  $suggestions = [];
  $is_active = 1;
  //NOTICE COLLEGE
  $stmt_notices_college = $dbConn->prepare("SELECT notice_colleges.notice_title as name,notice_colleges.slug, notice_colleges.url_link, notice_colleges.notice_date, notice_colleges.is_new ,'College Notice' as type, colleges.college_name As college_name , colleges.logo_img as college_logo_img FROM notice_colleges LEFT JOIN colleges ON notice_colleges.college_id = colleges.id WHERE  notice_colleges.is_active= :is_active");
  
  $stmt_notices_college->bindParam(':is_active',$is_active);   
  $stmt_notices_college->execute();
  $suggestions = array_merge($suggestions, $stmt_notices_college->fetchAll(PDO::FETCH_ASSOC));

  //NOTICE UNIVERSITY
  $stmt_notices_university = $dbConn->prepare("SELECT notice_universities.notice_title as name,notice_universities.slug, notice_universities.url_link, notice_universities.notice_date, notice_universities.is_new ,'University Notice' as type,  universities.university_name As university_name , universities.logo_img as university_logo_img FROM notice_universities  LEFT JOIN universities ON notice_universities.university_id = universities.id  WHERE notice_universities.is_active= :is_active");
  $stmt_notices_university->bindParam(':is_active',$is_active);  
  $stmt_notices_university->execute();
  $suggestions = array_merge($suggestions, $stmt_notices_university->fetchAll(PDO::FETCH_ASSOC));

  //NOTICE EXAMS
  $stmt_notices_exam = $dbConn->prepare("SELECT notice_exams.notice_title as name,notice_exams.slug, notice_exams.url_link , notice_exams.notice_date,notice_exams.is_new, 'Exam Notice' as type, exams.exam_name As exam_name, exams.logo_img as exam_logo_img FROM notice_exams  LEFT JOIN exams ON notice_exams.exam_id = exams.id WHERE  notice_exams.is_active= :is_active");
  $stmt_notices_exam->bindParam(':is_active',$is_active);  
  $stmt_notices_exam->execute();
  $suggestions = array_merge($suggestions, $stmt_notices_exam->fetchAll(PDO::FETCH_ASSOC));
 // echo "<pre>";
  //print_r($suggestions);

  // Shuffle the array
  shuffle($suggestions);

  // Sort the array by 'notice_date'
  usort($suggestions, function($a, $b) {
    return strtotime($b['notice_date']) - strtotime($a['notice_date']);
  });


  // Print the shuffled and sorted array
  //print_r($suggestions);

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>| <?php echo SITE_NAME;?></title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta property="og:title" content="">
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta property="og:url" content="">
<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>
<style>
.lds-roller {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  margin: -4px 0 0 -4px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s; background:#F00;
}
.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px; background: #007bff;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px; background: #6c757d;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px; background: #F36;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px; background: #28a745;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px; background: #dc3545;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px; background: #ffc107;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px; background: #17a2b8;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px; background: #B68F49;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
<!-- LOADER START-->    
<div id="dvLoading" style="display:none; position:fixed; top:0; left:0; background:rgba(0,0,0,0.8); width:100%; height:100%; padding:0; margin:0 auto; z-index:9999999999">
    <div class="lds-roller" style="padding:5px; border-radius:5px;height:100px;width:100px; position:absolute; top:50%; left:50%;margin-left:-50px;    margin-top:-50px; display:block;">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="text-white" style="padding:5px; border-radius:5px;height:100px;width:100px; position:absolute; top:50%; left:50%;margin-left:-50px; margin-top:30px; display:block;">Please wait...</div>
</div>
<!-- LOADER ENDS-->
</head>


<body>
	<?php include("header.php");?>
    <?php include("menu.php");?>    

   
    <table>
      <?php if(count($suggestions) > 0){
            foreach ($suggestions as $value) {
            $from = "";
            $link = "";
            if(isset($value['college_name'])){
              $from = $value['college_name'];
            }
            if(isset($value['exam_name'])){
              $from = $value['exam_name'];
            }
            if(isset($value['university_name'])){
              $from = $value['university_name'];
            }
            if(isset($value['url_link']) && $value['url_link'] !=''){
              $link = $value['url_link'];
            }else{
              $link = BASE_URL.'/'.$value['slug'];
            }


      ?>
      <tr>
        <td>Date : </td> <td><?php echo isset($value['notice_date'])?date('d M Y', strtotime($value['notice_date'])):""; ?></td>
        <td> From : </td><td><?php echo $from; ?></td>
        <td>Title :</td><td><a target="_blank" href="<?php echo $link; ?>"><?php echo isset($value['name'])?$value['name']:""; ?></a></td>
        <td>New :</td><td><?php echo ($value['is_new'] == 1)?"New":""; ?></td>
      </tr>
      <?php } } ?>
    </table>


-------------------------




    <table>
      <?php if(count($suggestions) > 0){
            foreach ($suggestions as $value) {
            $from = "";
            $link = "";
            if(isset($value['college_name'])){
              $from = $value['college_name'];
            }
            if(isset($value['exam_name'])){
              $from = $value['exam_name'];
            }
            if(isset($value['university_name'])){
              $from = $value['university_name'];
            }
            if(isset($value['url_link']) && $value['url_link'] !=''){
              $link = $value['url_link'];
            }else{
              $link = BASE_URL.'/'.$value['slug'];
            }


      ?>
      <tr>
        <td>Date : </td> <td><?php echo isset($value['notice_date'])?date('d M Y', strtotime($value['notice_date'])):""; ?></td>
        <td> From : </td><td><?php echo $from; ?></td>
        <td>Title :</td><td><a target="_blank" href="<?php echo $link; ?>"><?php echo isset($value['name'])?$value['name']:""; ?></a></td>
        <td>New :</td><td><?php echo ($value['is_new'] == 1)?"New":""; ?></td>
      </tr>
      <?php } } ?>
    </table>

    <?php include("footer_includes.php");?>
    <?php $dbConn =NULL; ?>
</body>
</html>