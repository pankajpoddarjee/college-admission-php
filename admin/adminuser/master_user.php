<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
include_once("../authentication.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");



$records = [];
$strsql="select * from users_admin  order by id";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Add / Modify User | Admin - <?php echo COLLEGE_NAME; ?></title>
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
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-pen-to-square"></i> Add / Modify <span class="text-danger">User</span></h3>
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
                                        <td class="align-middle">User Image </td>
                                        <td class="align-middle">Name</td>
                                        <td class="align-middle">Mobile</td>
                                        <td class="align-middle">Email</td>
                                        <td class="align-middle">Designation</td>
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
                                        <td class="align-middle text-left">
                                            <?php if(!empty($row['user_img'])) { ?>
                                            <img src="<?php echo BASE_URL_UPLOADS.'/user/'.$row['user_img'];?>" alt="" width="100" height="50">
                                            <?php } else { ?>
                                            <img src="<?php echo BASE_URL.'/images/dummy-user.png'; ?>" alt="" width="100" height="50">
                                            <?php } ?>
                                        
                                        </td>
                                        <td class="align-middle text-left"> <?php echo $row['name'];?></td>
                                        <td class="align-middle text-left"><?php echo $row['mobile'];?></td>
                                        <td class="align-middle text-left"><?php echo $row['email'];?></td>
                                        <td class="align-middle text-left"><?php echo $row['designation'];?></td>

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
                                <i class="fa-solid fa-pen-to-square"></i> Add / Edit <span class="text-danger">User</span>
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
                                            <label for="business">User Type</label>
                                            
                                            <select name="usertype" id="usertype" class="form-control">
                                                <option value="">Select User Type</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Super Admin</option>
                                            </select>

                                        </div>
                                    </div>        
                                                
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="ad_image">User Image</label>
                                            <input type="file" accept="image/*" class="form-control-file rounded" id="user_img" name="user_img">
                                            <a id="user_img_path" target="_blank" style="display:none">View</a>
                                            <a id="user_img_path_download" target="_blank" style="display:none">Download</a>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="name">User Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter User Name" autocomplete="off" maxlength="75" tabindex="2"  >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" autocomplete="off" >
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" autocomplete="off" >
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password" autocomplete="off" >
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="designation">Designation</label>
                                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Designation" autocomplete="off" >
                                        </div>
                                    </div>

                                    
                                  

                                   
                                    <div class="col-md-12 text-center">                                       
                                        <button class="btn btn-danger btn-sm align-middle" id="save-ad-button" name="submit">Save Data</button>
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
        <script>
            
        $('body').on('click', '#save-ad-button', function(event) {
            event.preventDefault();
            if (!verifyInput()) {
                return false;
            }

            $('#dvLoading').show();
            //$('#save-ad-button').attr('disabled', 'disabled');

            var formData = new FormData(document.getElementById("frm1"));
            $('#dvLoading').show();
            $.ajax({
                type: "post",
                contentType: false,
                processData: false,
                cache: false,
                url: "Save_user.php",
                data: formData,
                dataType: "json",
                success: function(data) {
                    // alert(JSON.stringify(data))
                    if (data.status == 1) {
                        alert(data.msg);
                        resetdata();
                        $('#dvLoading').hide();
                        //$('#save-ad-button').attr('disabled', '');
                        toastr.success(data.msg);
                        location.reload();
                    } else {
                        $('#dvLoading').hide();
                        //$('#save-ad-button').attr('disabled', '');
                        toastr.error(data.msg);
                        //alert(data.msg);
                        return false;
                    }
                }
            });
        });

        function verifyInput() {
            if ($.trim($("#usertype").val()) == "") {
                toastr.error("Enter Usertype");
                $("#usertype").focus();
                return false;
            }
            if ($.trim($("#record_id").val()) == "") {

                if($.trim($("#user_img").val()) == ""){
                    toastr.error("Select Company Logo");
                    $("#user_img").focus();
                    return false;
                }

            }
            
            if ($.trim($("#name").val()) == "") {
                toastr.error("Enter User Name ");
                $("#name").focus();
                return false;
            }

            if ($.trim($("#mobile").val()) == "") {
                toastr.error("Enter Mobile ");
                $("#mobile").focus();
                return false;
            }

            if ($.trim($("#email").val()) == "") {
                toastr.error("Enter email ");
                $("#email").focus();
                return false;
            }

            if ($.trim($("#record_id").val()) == "") {

                if ($.trim($("#password").val()) == "") {
                    toastr.error("Enter Password ");
                    $("#password").focus();
                    return false;
                }

            }

            
            
            if ($.trim($("#designation").val()) == "") {
                toastr.error("Enter Designation ");
                $("#designation").focus();
                return false;
            }
           

            return true;
        }


        //DEACTIVE Notice
        $(".status-change").click(function() {
            $('#dvLoading').show();
            var rid = $(this).attr("rid");
            var status = $(this).attr("status");
            $.ajax({
                type: "get",
                async: false,
                url: "Save_user.php?statusid=" + rid + "&status=" + status,
                dataType: "json",
                success: function(data) {
                    if (data.status == 1) {
                        alert(data.msg);
                        toastr.success(data.msg);
                        location.reload();
                    } else {
                        alert(data.msg);
                        return false;
                    }
                }
            });
        });

        // $('#page_title').on('keypress', function(event) {
        //     var regex = new RegExp("^[a-zA-Z () .]+$");
        //     var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

        //     if (!regex.test(key)) {
        //         event.preventDefault();
        //         return false;
        //     }
        // });


        //GET SINGLE RECORD
        // $(".get-record").click(function() {
        $('body').on('click', '.get-record', function(event) {
            event.preventDefault();
            $('#dvLoading').show();
            var eid = $(this).attr("eid");
            $.ajax({
                type: "get",
                // async: false,
                url: "Save_user.php?eid=" + eid,
                dataType: "json",
                success: function(data) {
                    if (data.status == 1) {

                        var base_url = $('#base_url').val();
                        var base_url_upload = $('#base_url_upload').val();

                        $('#name').val(data.record.name);

                        if(data.record.ad_image){ 

                           

                            var download_path = base_url_upload + "/ad/" + data.record.user_img;
                        
                            $("#user_img_path_download").show();

                           

                            $("#user_img_path_download").attr("href", download_path);
                            $("#user_img_path_download").attr("download", download_path);


                        
                        }else{
                            $("#user_img_path").hide();  
                            $("#user_img_path_download").show();
                        }

                        $('#mobile').val(data.record.mobile);
                        $('#email').val(data.record.email);
                       // $('#password').val(data.record.password);
                        $('#designation').val(data.record.designation);
                        $('#usertype').val(data.record.usertype);
                      

                        $('#record_id').val(data.record.id);
                        $('#action').val("edit");
                        $('#dvLoading').hide();
                        $("#add_edit_form").modal();

                    } else {
                        alert(data.msg);
                        return false;
                    }
                }
            });
        });

        function resetdata() {

            $("#name").val("");
            $("#usertype").val("");

            $("#mobile").val("");
       

            $("#email").val("");
            
            $('#password').val(''); // Clear the value
          
            $("#designation").val("");
        
            $("#user_img_path").hide();
            $("#user_img_path_download").hide();


        }

        function openModalForm() {
            resetdata();
            $("#action").val("add");
            $('#record_id').val("");
            $("#add_edit_form").modal();
        }
        </script>
        
    </body>
</html>