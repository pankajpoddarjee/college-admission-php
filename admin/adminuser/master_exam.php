<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
session_start();
include_once("../session.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");

$countryRecords = [];
$activeStatus = 1;
$strsql="select id,country_name from countries where is_active = :is_active order by country_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$countryRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

$examCategoryRecords = [];
$strsql="select id,exam_category_name,short_name,is_active from exam_categories where is_active = 1 order by exam_category_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$examCategoryRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

$examTypeRecords = [];
$strsql="select id,exam_type_name,short_name,is_active from exam_types where is_active = 1 order by exam_type_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$examTypeRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

$examLevelRecords = [];
$strsql="select id,exam_level_name,short_name,is_active from exam_levels where is_active = 1 order by exam_level_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$examLevelRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

$records = [];
$strsql="select * from exams  order by exam_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Add / Modify Exam | Admin - <?php echo COLLEGE_NAME; ?></title>
        <?php include("../head_includes.php");?>
    </head>
    <body>
    <?php include("headermenu_left.php");?>
    	<div id="content">
        
        <?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        <input type="hidden" value="<?php echo BASE_URL ?>" id="base_url">
        <input type="hidden" value="<?php echo BASE_URL_UPLOADS ?>" id="base_url_upload">
        	<div class="pl-3 pr-3 pt-0">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="row m-0 border-bottom pb-2">
                        	<div class="col-md-8 text-center text-sm-left mb-3 mb-sm-0">
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-pen-to-square"></i> Add / Modify <span class="text-danger">Exam</span></h3>
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
                                        <td class="align-middle">Exam Name</td>
                                        <td class="align-middle">Level</td>
                                        <td class="align-middle">Type</td>
                                        <td class="align-middle">Category</td>
                                        <td class="align-middle">Country</td>
                                        <td class="align-middle">State</td>
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
                                    <tr>
                                        <td class="align-middle text-center"><?php echo $i; ?></td>
                                        <td class="align-middle text-left"><?php echo $row['exam_name'];?></td>
                                        <td class="align-middle text-left"><?php echo $row['exam_level'];?></td>
                                        <td class="align-middle text-left"><?php echo $row['exam_type_name'];?></td>
                                        <td class="align-middle text-left"><?php echo $row['exam_category_name'];?></td>
                                        <td class="align-middle text-left"><?php echo $row['country_name'];?></td>
                                        <td class="align-middle text-left"><?php echo $row['state_name'];?></td>

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
                                <i class="fa-solid fa-pen-to-square"></i> Add / Edit <span class="text-danger">Exam</span>
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
                                    <div class="col-md-8 mb-3">
                                        <div class="form-group">
                                            <label for="exam_name">Exam Name</label>
                                            <input type="text" class="form-control" id="exam_name" name="exam_name" placeholder="Enter Exam Name" autocomplete="off" maxlength="75" tabindex="2" onload="convertToSlug();" onkeyup="convertToSlug();" onblur="convertToTags();">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="short_name">Short Name</label>
                                            <input type="text" class="form-control" id="short_name" name="short_name" placeholder="Enter Exam Short Name" autocomplete="off" maxlength="75" tabindex="2" onload="convertToSlug();" onkeyup="convertToSlug();" onblur="convertToTags();">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="exam_level">Exam Level</label>
                                            <select id="exam_level" name="exam_level" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
                                                <?php if($examLevelRecords){ 
                                                    foreach ($examLevelRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['exam_level_name'] ?>"><?php echo $value['exam_level_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="exam_type_name">Exam Type</label>
                                            <select id="exam_type_name" name="exam_type_name" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
                                                <?php if($examTypeRecords){ 
                                                    foreach ($examTypeRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['exam_type_name'] ?>"><?php echo $value['exam_type_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="exam_category_name">Exam Category</label>
                                            <select id="exam_category_name" name="exam_category_name" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
                                                <?php if($examCategoryRecords){ 
                                                    foreach ($examCategoryRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['exam_category_name'] ?>"><?php echo $value['exam_category_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="html_page">HTML Page</label>
                                            <input type="file" accept=".html, .htm" class="form-control-file rounded" id="html_page" name="html_page">
                                            <a id="html_page_path" target="_blank" style="display:none">View</a>
                                            <a id="html_page_path_download" target="_blank" style="display:none">Download</a>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="country_name">Country Name</label>
                                            <select id="country_name" name="country_name" class="form-control"  onchange="convertToTags();getState(this.value);">
                                                <option value="">Select</option>
                                                <?php if($countryRecords){ 
                                                    foreach ($countryRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['country_name'] ?>"><?php echo $value['country_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="state_name">State Name</label>            
                                            <select id="state_name" name="state_name" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="slug">URL Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" autocomplete="off" >
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="about_exam">About Exam</label>
                                            <textarea name="about_exam" id="about_exam" class="form-control" placeholder="Write something about the Exam"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="logo_img">Logo Image</label>
                                            <input type="file" class="form-control-file" id="logo_img" name="logo_img">
                                            <img id="logo_img_path" alt="Logo Image" width="70" height="70" class="img-fluid img-thumbnail mt-2">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="banner_img">Banner Image</label>
                                            <input type="file" class="form-control-file rounded" id="banner_img" name="banner_img">
                                            <img id="banner_img_path" alt="Banner Image" width="120" height="60" class="img-fluid img-thumbnail mt-2">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="tags">Tags</label>
                                            <input type="text" class="form-control" id="tags" name="tags" value="" data-role="tagsinput" autocomplete="off" >
                                            <a href="javascript:void(0)"  onclick="clearTag()">Clear</a>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">                                       
                                        <button class="btn btn-danger btn-sm align-middle" id="save-exam-button" name="submit">Save Data</button>
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
        <script src="<?php echo BASE_URL_ADMIN;?>/adminuser/js/exam.js"></script>
    </body>
</html>