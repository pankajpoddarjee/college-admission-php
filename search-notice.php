<?php include('settings.php');
include("connection.php");
include("function.php");
$logoImgPath = "https://static.vecteezy.com/system/resources/thumbnails/007/688/840/small/education-logo-free-vector.jpg";
$headerTitle = "Latest Updates";
$headerTitleType1 = "Get all updates";
$headerTitleType2 = "Session: " . ACADEMIC_SESSION;
//GET ALL UNIVERSITY
$universityRecords = [];
$activeStatus = 1;
$strsql="select id,university_name from universities where is_active = :is_active order by university_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$universityRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

//GET ALL COLLEGE
$collegeRecords = [];
$strsql="select id,college_name from colleges where is_active = :is_active order by college_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$collegeRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

//GET ALL EXAM
$examRecords = [];
$activeStatus = 1;
$strsql="select id,exam_name from exams where is_active = :is_active order by exam_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$examRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

$suggestions = [];
$collegeResult =[];
$universityResult =[];
$examResult =[];
$is_active = 1;
//NOTICE COLLEGE
$stmt_notices_college = $dbConn->prepare("SELECT notice_colleges.notice_title as name,notice_colleges.slug, notice_colleges.url_link, notice_colleges.notice_date, notice_colleges.is_new ,'College Notice' as type, colleges.college_name As college_name , colleges.logo_img as college_logo_img FROM notice_colleges LEFT JOIN colleges ON notice_colleges.college_id = colleges.id WHERE  notice_colleges.is_active= :is_active");

$stmt_notices_college->bindParam(':is_active',$is_active);   
$stmt_notices_college->execute();
$collegeResult = $stmt_notices_college->fetchAll(PDO::FETCH_ASSOC);

$suggestions = array_merge($suggestions, $collegeResult);

//NOTICE UNIVERSITY
$stmt_notices_university = $dbConn->prepare("SELECT notice_universities.notice_title as name,notice_universities.slug, notice_universities.url_link, notice_universities.notice_date, notice_universities.is_new ,'University Notice' as type,  universities.university_name As university_name , universities.logo_img as university_logo_img FROM notice_universities  LEFT JOIN universities ON notice_universities.university_id = universities.id  WHERE notice_universities.is_active= :is_active");
$stmt_notices_university->bindParam(':is_active',$is_active);  
$stmt_notices_university->execute();
$universityResult = $stmt_notices_university->fetchAll(PDO::FETCH_ASSOC);
$suggestions = array_merge($suggestions, $universityResult);

//NOTICE EXAMS
$stmt_notices_exam = $dbConn->prepare("SELECT notice_exams.notice_title as name,notice_exams.slug, notice_exams.url_link , notice_exams.notice_date,notice_exams.is_new, 'Exam Notice' as type, exams.exam_name As exam_name, exams.logo_img as exam_logo_img FROM notice_exams  LEFT JOIN exams ON notice_exams.exam_id = exams.id WHERE  notice_exams.is_active= :is_active");
$stmt_notices_exam->bindParam(':is_active',$is_active);  
$stmt_notices_exam->execute();
$examResult = $stmt_notices_exam->fetchAll(PDO::FETCH_ASSOC);
$suggestions = array_merge($suggestions, $examResult);

// Shuffle the array
shuffle($collegeResult);
// Sort the array by 'notice_date'
usort($collegeResult, function($a, $b) {
  return strtotime($b['notice_date']) - strtotime($a['notice_date']);
});
// Shuffle the array
shuffle($universityResult);
// Sort the array by 'notice_date'
usort($universityResult, function($a, $b) {
  return strtotime($b['notice_date']) - strtotime($a['notice_date']);
});
// Shuffle the array
shuffle($examResult);
// Sort the array by 'notice_date'
usort($examResult, function($a, $b) {
  return strtotime($b['notice_date']) - strtotime($a['notice_date']);
});


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
<title><?php echo $headerTitle;?> | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo $headerTitle;?>">
<meta name="description" content="<?php echo $headerTitle;?>">
<meta property="og:title" content="<?php echo $headerTitle;?>">
<meta property="og:description" content="<?php echo $headerTitle;?>">
<meta property="og:image" content="">
<meta property="og:url" content="<?php echo BASE_URL;?>/latest-updates">
<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>
<style type="text/css">
/* .LatestUpdates_Height{height:200px; max-height:200px; overflow:auto; overflow-x: hidden;} */
.LatestUpdates {list-style:none; padding:0; margin:0; text-align:left; font-family:Rubik}
.LatestUpdates li {padding:0 0 0 40px; margin:10px 0; border-bottom:1px dashed #CCCCCC; background: url(<?php echo BASE_URL;?>/images/institution.png) left top no-repeat;}
.LatestUpdates .PDate{color:#C00}
.LatestUpdates .instituteName{color:#000}
.new_tag{font-size:9px; vertical-align:top}
</style>
</head>
<body>
	<?php include("header.php");?>
    <?php include("menu.php");?>
    
    <?php include("common_page_header.php");?>
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
                            <h4 class="alert alert-info" style="font-family:Oswald">Search Notice By Date Range</h4>
                        </div>
                    </div>
                    <div class="container mt-3">
                    
                    <form id="dateRangeForm">
                        <div class="row">
                            
                            
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="fromTable">Notice From :</label>
                                    <select name="fromTable" id="fromTable"  class="form-control" onchange="showHideInput()">
                                        <option value="">Select</option>
                                        <option value="notice_colleges">College</option>
                                        <option value="notice_universities">University</option>
                                        <option value="notice_exams">Exam</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3" id="college_id_div" style="display:none">
                                <div class="form-group">
                                    <label for="college_id">College</label>                                            
                                    <select id="college_id" name="college_id" class="form-control" >
                                        <option value="">Select</option>
                                        <option value="all">All</option>
                                        <?php if($collegeRecords){ 
                                            foreach ($collegeRecords as $value) { 
                                        ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['college_name'] ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3" id="university_id_div" style="display:none">
                                <div class="form-group">
                                    <label for="university_id">University</label>                                            
                                    <select id="university_id" name="university_id" class="form-control" >
                                        <option value="">Select</option>
                                        <option value="all">All</option>
                                        <?php if($universityRecords){ 
                                            foreach ($universityRecords as $value) { 
                                        ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['university_name'] ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3" id="exam_id_div" style="display:none">
                                <div class="form-group">
                                    <label for="exam_id">Exams</label>                                            
                                    <select id="exam_id" name="exam_id" class="form-control" >
                                        <option value="">Select</option>
                                        <option value="all">All</option>
                                        <?php if($examRecords){ 
                                            foreach ($examRecords as $value) { 
                                        ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['exam_name'] ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="fromDate">From Date:</label>
                                    <input type="date" id="fromDate" name="fromDate"  class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="toDate">To Date:</label>
                                    <input type="date" id="toDate" name="toDate"  class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="searchButton"></label>  
                                    <button type="submit" class="form-control btn btn-primary mt-2">Search</button>
                                </div>
                            </div>                           
                        </div>
                    </form>

                    <!-- Display validation error -->
                    <div id="errorMessage" class="mt-3 text-danger"></div>

                    <!-- Results Display -->
                    <div id="results" class="mt-4"></div>
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

        const fromDateInput = document.getElementById('fromDate');
        const toDateInput = document.getElementById('toDate');

        // Add an event listener to the 'from' date input
        fromDateInput.addEventListener('change', function() {
            const fromDate = new Date(this.value);
            // Set the minimum date of 'to' date input to the selected 'from' date
            toDateInput.min = this.value;
            // If the 'to' date is before the 'from' date, reset it
            if (toDateInput.value && new Date(toDateInput.value) < fromDate) {
                toDateInput.value = '';
            }
        });

    function showHideInput(){
        var id =  $('#fromTable').val();
        // $('#university_id').val('');
        // $('#college_id').val('');
        // $('#exam_id').val('');
        if(id=='notice_colleges'){
            
            $('#exam_id_div').hide();
            $('#university_id_div').hide();
            $('#college_id_div').show();
            $("#college_id").val("");
            $('#college_id').select2().val("");
            
        }
        if(id=='notice_universities'){
            $('#exam_id_div').hide();
            $('#university_id_div').show();
            $('#college_id_div').hide();
            $("#university_id").val("");
            $('#university_id').select2().val("");
            
        }
        if(id=='notice_exams'){
            $('#exam_id_div').show();
            $('#university_id_div').hide();
            $('#college_id_div').hide();           
            $("#exam_id").val("");
            $('#exam_id').select2().val("");
            
        }
    }


    // Handle form submission with AJAX
    $(document).ready(function () {
        $('#dateRangeForm').on('submit', function (e) {
            e.preventDefault(); // Prevent form submission
            let table = $('#fromTable').val();
            let fromDate = $('#fromDate').val();
            let toDate = $('#toDate').val();
            let id = '';

            if(table == 'notice_colleges'){
                id = $('#college_id').val();
            }
            if(table == 'notice_universities'){
                id = $('#university_id').val();
            }
            if(table == 'notice_exams'){
                id = $('#exam_id').val();
            }


            let errorMessage = '';
            // Validate the date range
            if (new Date(fromDate) > new Date(toDate)) {
                errorMessage = 'The "From Date" should be less than or equal to the "To Date".';
                $('#errorMessage').text(errorMessage);
                $('#results').html("");
                return false; // Stop form submission
            } else {
                $('#errorMessage').text(''); // Clear any previous error message
            // Send AJAX request
            verifyInput();
            $.ajax({
                url: 'search.php', // Backend PHP file
                type: 'POST',
                data: {table: table,id: id,fromDate: fromDate, toDate: toDate},
                success: function (response) {
                    // Display the search results
                    $('#results').html(response);
                },
                error: function () {
                    alert('Error occurred during the request.');
                }
            });
        }
        });
    });


    function verifyInput() {
        if ($.trim($("#fromTable").val()) == "") {
            toastr.error("Select notice from");
            $("#fromTable").focus();
            return false;
        }
        
        if ($.trim($("#fromTable").val()) == 'notice_colleges') {
            if ($.trim($("#college_id").val()) == "") {
                toastr.error("Select College");
                $("#college_id").focus();
                return false;
            }
        }
      
        if ($.trim($("#fromTable").val()) == 'notice_universities') {
            if ($.trim($("#university_id").val()) == "") {
                toastr.error("Select University");
                $("#university_id").focus();
                return false;
            }
        }
        if ($.trim($("#fromTable").val()) == 'notice_exams') {
            if ($.trim($("#exam_id").val()) == "") {
                toastr.error("Select Exam");
                $("#exam_id").focus();
                return false;
            }
        }


        if ($.trim($("#fromDate").val()) == "") {
            toastr.error("Select from date");
            $("#fromDate").focus();
            return false;
        }

        if ($.trim($("#toDate").val()) == "") {
            toastr.error("Select to date");
            $("#toDate").focus();
            return false;
        }
        
        
        return true;
    }
</script>
</body>
</html>