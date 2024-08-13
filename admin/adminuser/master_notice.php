<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
session_start();
include_once("../session.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");



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

//GET ALL NOTICE
$records = [];
$strsql="select * from notices  order by created_at desc";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Add / Modify Notices | Admin - <?php echo COLLEGE_NAME; ?></title>
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
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-pen-to-square"></i> Add / Modify <span class="text-danger">Notice</span></h3>
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
                                        <td class="align-middle">Notice Title</td>
                                        <td class="align-middle">Status</td>
                                        <td class="align-middle">Action</td>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
									<?php 
                                    if(count($records)>0){
                                    $i=1;
                                    foreach ($records as $row) {
                                        // $uniqueSlug = generateSlug($row['college_name']);
                                        // $slug = "college/".$uniqueSlug;
                                        // if(!empty($row['short_name']) && $row['short_name']!="" && isset($row['short_name'])){
                                        //     $slug= $slug."-".generateSlug($row['short_name']);
                                        // }
                                        // // if(!empty($city_name) && $city_name!=""){
                                        // //     $slug= $slug."-".generateSlug($city_name);
                                        // // }
                                        // $slug= $slug."-".$row['id'];

                                        // //$slug = "college/".$row['college_name'];
                                        // $id = $row['id'];
                                        // $sql = "UPDATE colleges SET slug = :slug WHERE id = :id";
                                        // $stmt = $dbConn->prepare($sql);
                                        // $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
                                        // $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                                        // $stmt->execute();
                                    ?>
                                    <tr>
                                        <td class="align-middle text-center"><?php echo $i; ?></td>
                                        <td class="align-middle text-left"><?php echo $row['notice_title'];?></td>
                                        <td class="align-middle text-center text-nowrap" style="font-family:Rubik">
                                        	<?php if($row['is_active'] == 1){ ?>
                                            <span class="text-success"><i class="fa-regular fa-circle-check"></i> Active</span>
											<?php } else{ ?>
                                            <span class="text-danger"><i class="fa-regular fa-circle-xmark"></i> Inactive</span>
                                            <?php } ?>
                                        </td>
                                        <td class="align-middle text-center text-nowrap">
                                            <?php if($row['is_active'] == 1){ ?>
                                            <a status="<?php echo $row['is_active']; ?>" rid="
                                            <?php echo $row['id']; ?>" class="btn btn-success btn-sm status-change" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Record is Active."><i class="fa fa-check-square-o"></i>
                                            </a>
                                            <?php } else{ ?>
                                            <a status="<?php echo $row['is_active']; ?>" rid="
                                            <?php echo $row['id']; ?>" class="btn btn-warning btn-sm status-change" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Record is Inacctive."><i class="fa fa-exclamation-triangle"></i>
                                            </a>
                                            <?php } ?>
                                            
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
                                <i class="fa-solid fa-pen-to-square"></i> Add / Edit <span class="text-danger">Notice</span>
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

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="notice_for">Notice For</label>                                            
                                            <select id="notice_for" name="notice_for" class="form-control" onchange="showHideInput()">
                                                <option value="">Select</option>
                                                <option value="1">College</option>
                                                <option value="2">University</option>
                                                <option value="3">Exam</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                	
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="notice_title">Notice Title <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="notice_title" name="notice_title" placeholder="Enter Notice Title" autocomplete="off" maxlength="150" onload="convertToSlug();" onkeyup="convertToSlug();" onblur="convertToTags();">
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-md-4 mb-3" id="college_id_div" style="display:none">
                                        <div class="form-group">
                                            <label for="college_id">College</label>                                            
                                            <select id="college_id" name="college_id" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
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
                                            <select id="university_id" name="university_id" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
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
                                            <select id="exam_id" name="exam_id" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
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
                                            <label for="notice_date">Notice Date</label>
                                            <input type="date" class="form-control" id="notice_date" name="notice_date"  >
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="folder_name">URL Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" autocomplete="off" >
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="is_new">Is New</label>                                            
                                            <select id="is_new" name="is_new" class="form-control" >
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="description">Description</label>                                            
                                            <textarea name="description" id="description" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="tags">Tags</label>
                                        <input type="text" class="form-control" id="tags" name="tags" value="" data-role="tagsinput" autocomplete="off" >
                                        <a href="javascript:void(0)"  onclick="clearTag()">Clear</a>
                                    </div>
                                </div>
                            

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-danger btn-sm align-middle" id="save-notice-button" name="submit">Save Data</button>
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
        
        <script src="<?php echo BASE_URL_ADMIN;?>/adminuser/js/notice.js"></script>
    </body>
</html>