<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
include_once("../authentication.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");

//GET ALL college
$collegeRecords = [];
$activeStatus = 1;
$strsql="select id,college_name from colleges where is_active = :is_active order by college_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$collegeRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

$records = [];
$strsql="select * from page_colleges  order by page_title";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Add / Modify College Page | Admin - <?php echo COLLEGE_NAME; ?></title>
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
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-pen-to-square"></i> Add / Modify <span class="text-danger">College Page</span></h3>
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
                                        <td class="align-middle">Page Title </td>
                                        <td class="align-middle">Page For</td>
                                        <td class="align-middle">Page Path</td>
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
                                        <td class="align-middle text-left"><?php echo $row['page_title'];?></td>
                                        <td class="align-middle text-left"> <?php echo getCollegeNameById($row['college_id']); ?></td>
                                        <td class="align-middle text-left"><?php echo $row['html_page'];?></td>

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
                                <i class="fa-solid fa-pen-to-square"></i> Add / Edit <span class="text-danger">College Page</span>
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
                                            <label for="page_title">Page Title Name</label>
                                            <input type="text" class="form-control" id="page_title" name="page_title" placeholder="Enter Page Title Name" autocomplete="off" maxlength="75" tabindex="2" onload="convertToSlug();" onkeyup="convertToSlug();" onblur="convertToTags();" >
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3" >
                                        <div class="form-group">
                                            <label for="college_id">college</label>                                            
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
                                            <label for="slug">URL Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" autocomplete="off" >
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                        <label for="description">Description</label>                                            
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="tags">Tags</label>
                                            <input type="text" class="form-control" id="tags" name="tags" value="" data-role="tagsinput" autocomplete="off">
                                            <a class="btn btn-outline-danger btn-sm mt-2 float-right" href="javascript:void(0)" onclick="clearTag()"><i class="fa-regular fa-circle-xmark"></i> Clear Tags</a>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">                                       
                                        <button class="btn btn-danger btn-sm align-middle" id="save-college-page-button" name="submit">Save Data</button>
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
        <script src="<?php echo BASE_URL_ADMIN;?>/adminuser/js/page_college.js"></script>
    </body>
</html>