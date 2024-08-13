<?php
/*header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
session_start();*/
include_once("../session.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");

//GET ALL COLLEGE
$records = [];
$strsql="select * from colleges  order by college_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

$courseTypeRecords = [];
$strsql="select id,course_type_name from course_types where is_active=1 order by course_type_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$courseTypeRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

$subjectRecords = [];
$strsql="select id,subject_name from subjects where is_active=1 order by subject_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$subjectRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Assign Courses | Admin - <?php echo COLLEGE_NAME; ?></title>
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
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-pen-to-square"></i> Assign <span class="text-danger">Courses</span></h3>
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
                                        <td class="align-middle">College Name</td>
                                        <td class="align-middle">Status</td>
                                        <td class="align-middle">Action</td>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                <?php 
                                if(count($records)>0){
                                $i=1;
                                foreach ($records as $row) {
                                ?>
                                        <td class="align-middle text-center"><?php echo $i; ?></td>
                                        <td class="align-middle text-left"><?php echo $row['college_name'];?></td>
                                        <td class="align-middle text-center text-nowrap" style="font-family:Rubik">                                        	
                                            <span class="text-success"><i class="fa-regular fa-circle-check"></i> Assigned</span>
                                            <span class="text-warning"><i class="fa-solid fa-triangle-exclamation"></i> Pending</span>
                                        </td>
                                        <td class="align-middle text-center text-nowrap">                                            
                                            <a eid="<?php echo $row['id']; ?>" cname="<?php echo $row['college_name'];?>" class="btn btn-dark btn-sm get-record" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Assign Courses" onclick="getCourseDetail('<?php echo $row['id']; ?>','<?php echo $row['college_name'];?>')"><i class="fa fa-pencil-square-o"></i>
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
                            <h4 class="modal-title" id="addModalLongTitle" style="font-family:Oswald">
                                <i class="fa-solid fa-pen-to-square"></i> Assign <span class="text-danger">Courses</span> <span class="text-primary" id="edit-college-name"></span>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetdata()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <form id="frm1" name="frm1" method="post"  enctype="multipart/form-data">
                                <input type="hidden" name="action" id="action">
                                <input type="hidden" name="college_id" id="college_id">
                                <input type="hidden" name="record_id" id="record_id">
                                
                                <div class="row">    
                                	<div class="col-md-12 mb-1">
                                        <h4 class="alert alert-secondary" style="font-family:Oswald">
                                            <i class="fa-solid fa-book"></i> Course Info
                                        </h4>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="course_type_id">Courses Type</label>                                            
                                            <select id="course_type_id" name="course_type_id" class="form-control" onChange="getStream(this.value);convertToTags();">
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
                                            <label for="stream_id">Stream <span class="text-danger">[Selected Course Type Value]</span></label>                                            
                                            <select id="stream_id" name="stream_id" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
                                              
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="subject_id">Subjcts Offered <span class="text-danger">[Selected Stream Value]</span></label>                                            
                                            <select id="subject_id" name="subject_id[]" class="form-control" multiple onchange="convertToTags();">
                                                <?php if($subjectRecords){
                                                    foreach ($subjectRecords as $value) {
                                                ?>
                                                 <option value="<?php echo $value['id'] ?>"><?php echo $value['subject_name'] ?></option>    
                                                <?php } } ?>  
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row" id="tag-div">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="tags">Tags</label>
                                            <input type="text" class="form-control" id="tags" name="tags" value="" data-role="tagsinput" autocomplete="off" >
                                            <a href="javascript:void(0)"  onclick="clearTag()">Clear</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-danger btn-sm align-middle" id="save-course-assign-button" name="submit">Save Data</button>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="resetdata()">Reset Data</button>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-12 text-center">
                                        <table class="table table-bordered" style="font-family:Inter">
                                            <thead>
                                                <tr>
                                                    <td>Srl</td>
                                                    <td>Course Type</td>
                                                    <td>Stream</td>
                                                    <td>Subjects Offered</td>
                                                    <td>Action</td>
                                                </tr>
                                            </thead>
                                            <tbody id="course-edit-table">
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="resetdata()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
         
            <!--MODAL END-->
          <?php include("../footer.php");?>
        </div> 
        <?php include("../footer_includes.php");?> 
        
        <script src="<?php echo BASE_URL_ADMIN;?>/adminuser/js/assign_courses.js"></script>
    </body>
</html>