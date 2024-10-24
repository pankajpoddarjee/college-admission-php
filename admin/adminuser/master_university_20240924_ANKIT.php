<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
session_start();
include_once("../session.php");
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
//GET ALL UNIVERSITY TYPE
$universityTypeRecords = [];
$activeStatus = 1;
$strsql="select id,university_type_name from university_types where is_active = :is_active order by university_type_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$universityTypeRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

//GET ALL COUNTRY
$countryRecords = [];
$activeStatus = 1;
$strsql="select id,country_name from countries where is_active = :is_active order by country_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$countryRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
//GET ALL UNIVERSITY
$records = [];
$strsql="select * from universities  order by university_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Add / Modify University | Admin - <?php echo COLLEGE_NAME; ?></title>
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
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-pen-to-square"></i> Add / Modify <span class="text-danger">University</span></h3>
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
                                        <td class="align-middle">University Name</td>
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
                                        <td class="align-middle text-center"> <?php echo $i; ?></td>
                                        <td class="align-middle text-left"> <?php echo $row['university_name'];?></td>
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
                                <i class="fa-solid fa-pen-to-square"></i> Add / Edit <span class="text-danger">University</span>
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
                                            <i class="fa-solid fa-graduation-cap"></i> Basic Info
                                        </h4>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="university_name">University Name <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="university_name" name="university_name" placeholder="Enter University Name" autocomplete="off" maxlength="75" onload="convertToSlug();" onkeyup="convertToSlug();" onblur="convertToTags();">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="short_name">University Short Name</label>
                                            <input type="text" class="form-control" id="short_name" name="short_name" placeholder="Enter University Short Name" autocomplete="off" maxlength="75" onblur="convertToTags();">
                                        </div>
                                    </div>
                                    
                                   
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="other_name">Other / Former Name</label>
                                            <input type="text" class="form-control" id="other_name" name="other_name" placeholder="Enter Other Name" autocomplete="off" maxlength="75" onblur="convertToTags();">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="eshtablish">Estd.</label>
                                            <input type="text" class="form-control" id="eshtablish" name="eshtablish" placeholder="Eg: 1989" autocomplete="off" maxlength="75">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="discription">Discription</label>
                                            <input type="text" class="form-control" id="discription" name="discription" placeholder="Discription" autocomplete="off" maxlength="75">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="university_type_id">University Type</label>                                            
                                            <select id="university_type_id" name="university_type_id" class="form-control" onchange="convertToTags();">
                                                <option value="">Select</option>
                                                <?php if($universityTypeRecords){ 
                                                    foreach ($universityTypeRecords as $value) { 
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['university_type_name'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                   
                                </div>
                                
                                <div class="row">    
                                	<div class="col-md-12 mb-1">
                                        <h4 class="alert alert-secondary" style="font-family:Oswald">
                                            <i class="fa-solid fa-earth-asia"></i> Contact Info
                                        </h4>
                                    </div>
                                                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="address">Address <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" autocomplete="off" maxlength="75">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="landmark">Landmark </label>
                                            <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Eg: Near SBI Bank" autocomplete="off" maxlength="75">
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
                                </div>
                                
                                <div class="row">    
                                	<div class="col-md-12 mb-1">
                                        <h4 class="alert alert-secondary" style="font-family:Oswald">
                                            <i class="fa-solid fa-earth-asia"></i> Social Info
                                        </h4>
                                    </div>
    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="email">E-mail Id 1 <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter College Name" autocomplete="off" maxlength="75">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="email2">E-mail Id 2</label>
                                            <input type="text" class="form-control" id="email2" name="email2" placeholder="Enter College Short Name" autocomplete="off" maxlength="75">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter College Code" autocomplete="off" maxlength="75">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="website_url">Website URL</label>
                                            <input type="text" class="form-control" id="website_url" name="website_url" placeholder="Enter Other Name" autocomplete="off" maxlength="75">
                                        </div>
                                    </div>
    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="website_display">Website Display</label>
                                            <input type="text" class="form-control" id="website_display" name="website_display" placeholder="Enter Other Name" autocomplete="off" maxlength="75">
                                        </div>
                                    </div>
                                </div>
                                
                               
                                
                                <div class="row">
                                	<div class="col-md-12 mb-1">
                                        <h4 class="alert alert-secondary" style="font-family:Oswald">
                                            <i class="fa-solid fa-file-image"></i> Path &amp; Image Info
                                        </h4>
                                    </div>
                                    
                                	<!-- <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="folder_name">Folder Name</label>
                                            <input type="text" class="form-control" id="folder_name" name="folder_name" placeholder="Eg: asutosh-college" autocomplete="off" maxlength="200" oninput="populateFolderName();">
                                        </div>
                                    </div> -->
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="folder_name">URL Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" autocomplete="off" >
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="file_name">File Name</label>
                                            <input type="text" class="form-control" id="file_name" name="file_name"placeholder="Eg: auutosh-college.php" autocomplete="off" maxlength="200">
                                        </div>
                                    </div> -->
                                </div>
                                
                                <div class="row">
                                    
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
                                        <button class="btn btn-danger btn-sm align-middle" id="save-university-button" name="submit">Save Data</button>
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
        
        <script src="<?php echo BASE_URL_ADMIN;?>/adminuser/js/university.js"></script>
    </body>
</html>