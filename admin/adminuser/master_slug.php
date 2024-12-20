<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
include_once("../authentication.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");

//GET ALL UNDERTAKING
$undertakingRecords = [];
$activeStatus = 1;
$strsql="select id,undertaking_name from undertakings where is_active = :is_active order by undertaking_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$undertakingRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
//GET ALL UNIVERSITY
$universityRecords = [];
$activeStatus = 1;
$strsql="select id,university_name from universities where is_active = :is_active order by university_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$universityRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
//GET ALL COURSE TYPE
$courseTypeRecords = [];
$activeStatus = 1;
$strsql="select id,course_type_name from course_types where is_active = :is_active order by course_type_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$courseTypeRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
//GET ALL COLLEGE TYPE
$collegeTypeRecords = [];
$activeStatus = 1;
$strsql="select id,college_type_name from college_types where is_active = :is_active order by college_type_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$collegeTypeRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

//GET ALL COURSE
$streamRecords = [];
$activeStatus = 1;
$strsql="select * from streams where is_active = :is_active order by stream_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$streamRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
//GET ALL COUNTRY
$countryRecords = [];
$activeStatus = 1;
$strsql="select id,country_name from countries where is_active = :is_active order by country_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$countryRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
//GET ALL COLLEGE
$records = [];
$strsql="select * from slug_master  order by title";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
//GET ALL EXAM CATEGORY
$examCategoryRecords = [];
$strsql="select id,exam_category_name,short_name,is_active from exam_categories where is_active = 1 order by exam_category_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$examCategoryRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
//GET ALL EXAM TYPE
$examTypeRecords = [];
$strsql="select id,exam_type_name,short_name,is_active from exam_types where is_active = 1 order by exam_type_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$examTypeRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
//GET ALL EXAM LEVEL
$examLevelRecords = [];
$strsql="select id,exam_level_name,short_name,is_active from exam_levels where is_active = 1 order by exam_level_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$examLevelRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Add / Modify Slug  | Admin - <?php echo COLLEGE_NAME; ?></title>
        <?php include("../head_includes.php");?>
    </head>
    <body>
    <?php include("headermenu_left.php");?>
    	<div id="content">
        
        <?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
            <input type="hidden" value="<?php echo BASE_URL ?>" id="base_url">
        	<div class="pl-3 pr-3 pt-0">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="row m-0 border-bottom pb-2">
                        	<div class="col-md-8 text-center text-sm-left mb-3 mb-sm-0">
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-pen-to-square"></i> Add / Modify <span class="text-danger">Slug</span></h3>
                            </div>
                        	<div class="col-md-4 text-center text-sm-right mb-3 mb-sm-0">
                            	<a class="btn btn-danger" href="javascript:void(0)" onclick="openModalForm()"><i class="fa-regular fa-pen-to-square"></i> Add New Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-4">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="master-table" class="table table-bordered order-table" style="font-family:Rubik">
                                <thead class="bg-light text-center font-weight-bold">
                                    <tr>
                                        <td class="align-middle">Srl</td>
                                        <td class="align-middle">Type</td>
                                        <td class="align-middle">Title</td>
                                        <td class="align-middle">Slug</td>
                                        <td class="align-middle">Action</td>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
									<?php 
                                    if(count($records)>0){
                                    $i=1;
                                    foreach ($records as $row) {
                                    ?>
                                    <tr>
                                        <td class="align-middle text-center"><?php echo $i; ?></td>
                                        <td class="align-middle text-left"><?php echo ucfirst($row['response_from']);?></td>
                                        <td class="align-middle text-left"><?php echo $row['title'];?></td>
                                        
                                        <td class="align-middle text-left"><?php echo $row['slug'];?></td>
                                        <td class="align-middle text-center text-nowrap">
                                          
                                            <a class="btn btn-info btn-sm" href="<?php echo BASE_URL.'/'.$row['slug']; ?>" target="_blank" title="<?php echo $row['title'];?>"><i class="fa fa-external-link" aria-hidden="true"></i>
                                            </a>
                                            <a eid="<?php echo $row['id']; ?>" class="btn btn-dark btn-sm get-record" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Edit Record"><i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        </td>
                                    </tr><?php $i = $i+1; } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--MODAL START-->
            <div class="modal fade" id="add_edit_form" tabindex="-1" role="dialog" aria-labelledby="add_edit_formTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addJournalModalLongTitle" style="font-family:Oswald">
                                <i class="fa-solid fa-pen-to-square"></i> Add / Edit <span class="text-danger">Slug</span>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <form id="frm1" name="frm1" method="post"  enctype="multipart/form-data">
                                <input type="hidden" name="action" id="action">
                                <input type="hidden" name="record_id" id="record_id">
                                <div class="row">
                                	<div class="col-md-12 mb-1">
                                        <h4 class="alert alert-secondary" style="font-family:Oswald">
                                            <i class="fa-solid fa-graduation-cap"></i> Generate Slug Using Given Fields
                                        </h4>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="response_from">Type <span class="required">*</span> <span class="text-danger">(Get Response from Selected Section)</span></label>                                            
                                            <select id="response_from" name="response_from" class="form-control">
                                                <option value="">Select</option>
                                                <option value="colleges">College</option>
                                                <option value="universities">University</option>
                                                <option value="streams">Stream</option>
                                                <option value="notices">Notice</option>
                                                <option value="exams">Exam</option>
                                                <option value="pages">Pages</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="title">Slug Title <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title Name" autocomplete="off" maxlength="150"  onload="convertToSlug();" onkeyup="convertToSlug();" onblur="convertToTags();">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="course_type_id">Courses Type</label>                                            
                                            <select id="course_type_id" name="course_type_id" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
                                                <?php if($courseTypeRecords){
                                                    foreach ($courseTypeRecords as $value) {
                                                ?>
                                                 <option value="<?php echo $value['id'] ?>"><?php echo $value['course_type_name'] ?></option>    
                                                <?php } } ?>                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="stream_id">Stream</label>                                            
                                            <select id="stream_id" multiple="multiple" name="stream_id[]" class="form-control">
                                                <!-- <option value="">Select</option> -->
                                                <?php if($streamRecords){ 
                                                    foreach ($streamRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['stream_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="college_type_id">College Type</label>                                            
                                            <select id="college_type_id" name="college_type_id" class="form-control">
                                                <option value="">Select</option>
                                                <?php if($collegeTypeRecords){ 
                                                    foreach ($collegeTypeRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['college_type_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="undertaking_id">Undertaking</label>                                            
                                            <select id="undertaking_id" name="undertaking_id" class="form-control" >
                                                <option value="">Select</option>
                                                <?php if($undertakingRecords){ 
                                                    foreach ($undertakingRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['undertaking_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="university_id">University</label>                                            
                                            <select id="university_id" name="university_id" class="form-control select-2-dropdown">
                                                <option value="">Select</option>
                                                <?php if($universityRecords){ 
                                                    foreach ($universityRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['university_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="exam_level_id">Exam Level</label>
                                            <select id="exam_level_id" name="exam_level_id" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
                                                <?php if($examLevelRecords){ 
                                                    foreach ($examLevelRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['exam_level_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="exam_type_id">Exam Type</label>
                                            <select id="exam_type_id" name="exam_type_id" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
                                                <?php if($examTypeRecords){ 
                                                    foreach ($examTypeRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['exam_type_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="exam_category_id">Exam Category</label>
                                            <select id="exam_category_id" name="exam_category_id" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
                                                <?php if($examCategoryRecords){ 
                                                    foreach ($examCategoryRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['exam_category_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="country_id">Country Name</label>                                            
                                            <select id="country_id" name="country_id" class="form-control select-2-dropdown" onchange="convertToTags();">
                                                <option value="">Select</option>
                                                <?php if($countryRecords){ 
                                                    foreach ($countryRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['country_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="state_id">State Name</label>                                            
                                            <select id="state_id" name="state_id" class="form-control select-2-dropdown" onchange="convertToTags();">
                                                <option value="">Select</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="city_id">City Name</label>
                                            <select id="city_id" name="city_id" class="form-control select-2-dropdown" onchange="convertToTags();">
                                                <option value="">Select</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                        
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="district_id">District Name</label>
                                            <select id="district_id" name="district_id" class="form-control select-2-dropdown" onchange="convertToTags();">
                                                <option value="">Select</option>                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="folder_name">URL Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" autocomplete="off" >
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="tags">Tags</label>
                                            <input type="text" class="form-control" id="tags" name="tags" value="" data-role="tagsinput" autocomplete="off" >
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-danger btn-sm align-middle" id="save-slug-button" name="submit">Save Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
         
            <!--MODAL END-->
          <?php include("../footer.php");?>
        </div> 
        <?php include("../footer_includes.php");?> 
        
        <script src="<?php echo BASE_URL_ADMIN;?>/adminuser/js/master_slug.js"></script>
    </body>
</html>