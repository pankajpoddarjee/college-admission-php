<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
session_start();
include_once("../session.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");



//GET ALL exam
$activeStatus = 1;
$examRecords = [];
$strsql="select id,exam_name from exams where is_active = :is_active order by exam_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$examRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

//echo "<pre>"; print_r($examRecords);

$courseTypeRecords = [];
$strsql="select id,course_type_name,course_code,is_active from course_types  order by course_type_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$courseTypeRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

//GET ALL NOTICE
$records = [];
$strsql="select * from notice_exams order by notice_date desc, id desc";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Add / Modify Exam Notices | Admin - <?php echo COLLEGE_NAME; ?></title>
        <?php include("../head_includes.php");?>
        
         <style>
		   /* body {
				font-family: Arial, sans-serif;
				margin: 20px;
			} */
			.directory-container {
				padding-left: 0;
			}
			.directory-item {
				cursor: pointer;
				margin: 4px 0;
				display: flex;
				align-items: center;
				white-space: nowrap;
				overflow: hidden;
				position: relative;
				padding: 4px 0;
			}
			.file-item {
				font-style: italic;
				color: #C03;
			}
			.directory-content {
				display: none;
				padding-left: 20px;
				margin-left: 20px;
				border-left: 1px solid #ddd;
				position: relative;
			}
			/*.directory-item:hover {
				background-color: #f9f9f9;
				border-radius: 4px;
				box-shadow: 0 2px 4px rgba(0,0,0,0.1);
			}*/
			.directory-icon {
				margin-right: 8px;
				font-size: 18px;
				color: #333;
			}
			.directory-item strong {
				margin-right: 8px;
				color: #333;
			}
			.directory-item:before {
				content: '';
				position: absolute;
				left: -20px;
				top: 50%;
				transform: translateY(-50%);
				width: 10px;
				height: 10px;
				background-color: #333;
				border-radius: 50%;
			}
			.directory-link {
				text-decoration: none;
				color: inherit; /* Use inherited color for consistency */
			}
	</style>
        
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
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-pen-to-square"></i> Add / Modify <span class="text-danger">Exam Notice</span></h3>
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
                                        <td class="align-middle">Notice Date</td>
                                        <td class="align-middle">Notice Title</td>
                                        <td class="align-middle">Published For</td>
                                        <td class="align-middle">Status</td>
                                        <td class="align-middle">Action</td>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
									<?php 
                                    if(count($records)>0){
                                    $i=1;
                                    foreach ($records as $row) {

                                        $custom_link = "";
                                        $target = "";
                                        if($row['notice_type'] == 'page'){
                                            $custom_link = BASE_URL."/".$row['slug'];
                                            $target = "_self";
                                        }
                                        if($row['notice_type'] == 'url'){
                                            $custom_link = $row['url_link']; 
                                            $target = "_blank";
                                        }

                                     
                                        $name = getexamNameById($row['exam_id']);
                                        $notice_for = "exam";
                                               
                                        

                                        $publishDate = date('d M Y', strtotime($row['notice_date']));

                                    ?>
                                    <tr>
                                        <td class="align-middle text-center"><?php echo $i; ?></td>
                                        <td class="align-middle text-left"><?php echo $publishDate;?></td>
                                        <td class="align-middle text-left">
                                            <?php echo $row['notice_title'];?>
                                            <?php if($row['is_new']==1){ ?>
                                                <span class="new_tag badge badge-danger fa-fade">New</span>
                                            <?php } ?>
                                        </td>
                                        <td class="align-middle text-left"><?php echo $name;?></td>
                                        <td class="align-middle text-center text-nowrap" style="font-family:Rubik">
                                        	<?php if($row['is_active'] == 1){ ?>
                                            <span class="text-success"><i class="fa-regular fa-circle-check"></i> Active</span>
											<?php } else{ ?>
                                            <span class="text-danger"><i class="fa-regular fa-circle-xmark"></i> Inactive</span>
                                            <?php } ?>
                                        </td>
                                        <td class="align-middle text-center text-nowrap">
                                        <?php if($row['has_attachment'] == 1){ ?>
                                            <a cname="<?php echo $name; ?>" cid="<?php echo $row['exam_id']; ?>" nid="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm get-attachment-record" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Upload Attachment"><i class="fa-solid fa-file-arrow-up"></i>
                                            </a>
                                         <?php } ?>
                                        

                                            <a class="btn btn-info btn-sm" href="<?php echo $custom_link?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Notice Link">
                                                <i class="fa-solid fa-up-right-from-square"></i>
                                            </a>
                                        
                                            <?php if($row['is_active'] == 1){ ?>
                                            <a status="<?php echo $row['is_active']; ?>" rid="
                                            <?php echo $row['id']; ?>" class="btn btn-success btn-sm status-change" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Record is Active"><i class="fa fa-check-square-o"></i>
                                            </a>
                                            <?php } else{ ?>
                                            <a status="<?php echo $row['is_active']; ?>" rid="
                                            <?php echo $row['id']; ?>" class="btn btn-warning btn-sm status-change" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Record is Inacctive"><i class="fa fa-exclamation-triangle"></i>
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
                                <i class="fa-solid fa-pen-to-square"></i> Add / Edit <span class="text-danger">Exam Notice</span>
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
                                            <label for="course_for">Course For</label>                                            
                                            <select id="course_for" name="course_for" class="form-control" >
                                                <option value="">Select</option>
                                                <?php foreach ($courseTypeRecords as $row) { ?>
                                                    <option value="<?php echo $row['course_code'];?>"><?php echo $row['course_type_name'];?> - <?php echo $row['course_code'];?></option>
                                               <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="notice_category">Notice Category</label>                                            
                                            <select id="notice_category" name="notice_category" class="form-control" >
                                                <option value="">Select</option>
                                                <option value="Merit List">Merit List</option>
                                                <option value="Admission Notice">Admission Notice</option>
                                                <option value="General Notice">General Notice</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="notice_type">Notice Type</label>                                            
                                            <select id="notice_type" name="notice_type" class="form-control" onchange="showHideAsPerNoticeType()">
                                                <option value="">Select</option>
                                                <option value="page">Page</option>
                                                <option value="url">External URL</option>
                                            </select>
                                        </div>
                                    </div>
                                	
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="notice_title">Notice Title <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="notice_title" name="notice_title" placeholder="Enter Notice Title" autocomplete="off" maxlength="150" onload="convertToSlug();" onkeyup="convertToSlug();" onblur="convertToTags();">
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-md-4 mb-3" id="exam_id_div">
                                        <div class="form-group">
                                            <label for="exam_id">exam</label>                                            
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
                                    

                                    <div class="col-md-4 mb-3" id="notice_url_div" style="display:none">
                                        <div class="form-group">
                                            <label for="url_link">Notice URL</label>
                                            <input type="text" class="form-control" id="url_link" name="url_link"  >
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3" id="notice_page_div" style="display:none">
                                        <div class="form-group">
                                            <label for="page_link">Notice Page</label>
                                            <input type="file" accept=".html, .htm" class="form-control-file rounded" id="page_link" name="page_link">
                                            <a id="page_link_path" target="_blank" style="display:none">View</a>
                                            <a id="page_link_path_download" target="_blank" style="display:none">Download</a>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3" id="notice_page_div" >
                                        <div class="form-group"> 
                                            <label for="has_attachment">Has Attachments ?</label>
                                            <select name="has_attachment" id="has_attachment" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="notice_date">Notice Date</label>
                                            <input type="date" class="form-control" id="notice_date" name="notice_date"  >
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3"  >
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
                                            <label for="is_active">Is Active</label>                                            
                                            <select id="is_active" name="is_active" class="form-control" >
                                                <option value="1" >Yes</option>
                                                <option value="0" >No</option>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="description">Description</label>                                            
                                            <textarea name="description" id="description" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="tags">Tags</label>
                                        <input type="text" class="form-control" id="tags" name="tags" value="" data-role="tagsinput" autocomplete="off">
                                        <a class="btn btn-outline-danger btn-sm mt-2 float-right" href="javascript:void(0)" onclick="clearTag()"><i class="fa-regular fa-circle-xmark"></i> Clear Tags</a>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

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

            <!--ATTACHMENT MODAL START-->
            <div class="modal fade" id="add_edit_attachment_form" tabindex="-1" role="dialog" aria-labelledby="add_edit_formTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addJournalModalLongTitle" style="font-family:Oswald">
                                <i class="fa-solid fa-file-arrow-up"></i> Upload <span class="text-danger">Attachment</span> [<span class="text-primary" id="exam_name"></span>]
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <form id="frm2" name="frm2" method="post"  enctype="multipart/form-data">
                            
                                <div class="row">

                                <input type="hidden" name="attch_exam_id" id="attch_exam_id">
                                
                                <input type="hidden" id="attch_notice_id" name="attch_notice_id" >
                                <input type="hidden" id="base_directory" name="base_directory" value="">
                                    
                                    <!-- <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="attch_exam_id">exam</label>                                            
                                            <select id="attch_exam_id" name="attch_exam_id" class="form-control" readonly>
                                                <option value="">Select</option>
                                                <?php if($examRecords){ 
                                                    foreach ($examRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['exam_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>  
                                     -->
                                      
                                     <!--<div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="exam_name">Exam Name</label>                                            
                                            <input type="text" name="exam_name" id="exam_name" class="form-control">
                                        </div>
                                    </div>-->
                                    

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="year_directory">Exam Year Directory</label>                                            
                                            <select id="year_directory" name="year_directory" class="form-control" onchange="fetchSubDirectoryStructure(this.value)" >   
                                            <option value="">Select</option>                                            
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="new_directory">Create New Directory</label>
                                            <select id="new_directory" name="new_directory" class="form-control select-2-dropdown" onchange="fetchFilenameOfDirectory(this.value)">
                                               <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>                                  

                                    <div class="col-md-4 mb-3" id="notice_page_div" >
                                        <div class="form-group"> 
                                            <label for="attachments">Attachments</label>
                                            <input type="file" multiple accept=".pdf" class="form-control-file rounded" id="attachments" name="attachments[]">
                                            <a id="attachments_path" target="_blank" style="display:none">View</a>
                                            <a id="attachments_path_download" target="_blank" style="display:none">Download</a>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3" id="notice_page_div">
                                        <div class="form-group"> 
                                            <label for="directoryContainer" class="text-danger"><i class="fa-solid fa-folder-tree"></i> Directory Listing</label>
                                            <div id="directoryContainer" class="directory-container"></div>
                                        </div>
                                    </div>
                                  
                                </div>

                               <div id="attachments_file_list">

                               </div>

                                <div class="clearfix"></div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-danger btn-sm align-middle" id="save-attachment-notice-button" name="submit">Save Data</button>
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
        
        <script src="<?php echo BASE_URL_ADMIN;?>/adminuser/js/notice_exam.js"></script>
    </body>
</html>