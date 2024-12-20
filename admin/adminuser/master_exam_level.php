<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
include_once("../authentication.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");
$records = [];
$strsql="select id,exam_level_name,short_name,is_active from exam_levels  order by exam_level_name";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Add / Modify Exam Level | Admin - <?php echo COLLEGE_NAME; ?></title>
        <?php include("../head_includes.php");?>
    </head>
    <body>
    <?php include("headermenu_left.php");?>
    	<div id="content">
        
        <?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        
        	<div class="pl-3 pr-3 pt-0">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="row m-0 border-bottom pb-2">
                        	<div class="col-md-8 text-center text-sm-left mb-3 mb-sm-0">
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-pen-to-square"></i> Add / Modify <span class="text-danger">Exam Level</span></h3>
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
                                        <td class="align-middle">Exam Level</td>
                                        <td class="align-middle">Short Name</td>
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
                                        <td class="align-middle text-left"> <?php echo $row['exam_level_name'];?></td>
                                        <td class="align-middle text-left"> <?php echo $row['short_name'];?></td>
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
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addJournalModalLongTitle" style="font-family:Oswald">
                                <i class="fa-solid fa-pen-to-square"></i> Add / Edit <span class="text-danger">Exam Level</span>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm1" name="frm1" action="#" method="post" onsubmit="return false;">
                                <input type="hidden" name="action" id="action">
                                <input type="hidden" name="record_id" id="record_id">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="exam_level_name">Exam Level Name</label>
                                            <input type="text" class="form-control" id="exam_level_name" name="exam_level_name" placeholder="Enter Exam Level Name" autocomplete="off" maxlength="75" tabindex="2">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="short_name">Short Name</label>
                                            <input type="text" class="form-control" id="short_name" name="short_name" placeholder="Enter Short Name" autocomplete="off" maxlength="75" tabindex="2">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-danger btn-sm align-middle" id="submit" name="submit" onClick="submitdata();" tabindex="6">Save Data</button>
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
            function submitdata() {
                if (!verifyInput()) return false;
                saveData();
            }

            function verifyInput() {
                if ($.trim($("#exam_level_name").val()) == "") {
                    toastr.error("Enter Exam Level Name");
                    $("#exam_level_name").focus();
                    return false;
                } 
                // if ($.trim($("#short_name").val()) == "") {
                //     toastr.error("Enter Short Name");
                //     $("#short_name").focus();
                //     return false;
                // }
                return true;
            }

            function saveData() {
                var form1 = $('#frm1');
                $('#dvLoading').show();
                $.ajax({
                    type: "post",
                    async: false,
                    url: "Save_exam_level.php",
                    data: form1.serialize(),
                    dataType: "json",
                    success: function(data) {
                        // alert(JSON.stringify(data))
                        if (data.status == 1) {
                            alert(data.msg);
                            resetdata();
                            $('#dvLoading').hide();
                            toastr.success(data.msg);
                            location.reload();
                        } else {
                            $('#dvLoading').hide();
                            toastr.error(data.msg);
                            //alert(data.msg);
                            return false;
                        }
                    }
                });
            }
            //DEACTIVE JOURNAL
            $(".status-change").click(function() {
                $('#dvLoading').show();
                var rid = $(this).attr("rid");
                var status = $(this).attr("status");
                $.ajax({
                    type: "get",
                    async: false,
                    url: "Save_exam_level.php?statusid=" + rid + "&status=" + status,
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
            
            $('#exam_level_name,#short_name').on('keypress', function(event) {
                var regex = new RegExp("^[a-zA-Z ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
               
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });


            //GET SINGLE RECORD
            $('body').on('click', '.get-record', function (event) {
                event.preventDefault();
                $('#dvLoading').show();
                var eid = $(this).attr("eid");
                $.ajax({
                    type: "get",
                    //async: false,
                    url: "Save_exam_level.php?eid=" + eid,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            $('#exam_level_name').val(data.record.exam_level_name); 
                            $('#short_name').val(data.record.short_name);
                            $('#record_id').val(data.record.id);
                            $('#action').val("edit");
                            $("#add_edit_form").modal();
                            $('#dvLoading').hide();
                        } else {
                            alert(data.msg);
                            return false;
                        }
                    }
                });
            });

            function resetdata() {
                $("#exam_level_name").val("");
                $("#short_name").val("");
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