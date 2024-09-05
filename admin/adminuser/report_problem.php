<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
session_start();
include_once("../session.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");

//echo "<pre>"; print_r($_SERVER); die;

$records = [];
$strsql="select * from report_problem  order by status desc, created_at desc";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Bug Reporting | Admin - <?php echo COLLEGE_NAME; ?></title>
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
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-bug"></i> Bug <span class="text-danger">Reporting</span></h3>
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
                                        <td class="align-middle">Name of Reporter</td>
                                        <td class="align-middle">Reporter Email</td>
                                        <td class="align-middle">Reporter Mobile</td>
                                        <td class="align-middle">Reported URL</td>
                                        <td class="align-middle">Reported On</td>
                                        <td class="align-middle">Updated On</td>
                                        <td class="align-middle">Reporter Description</td>
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
                                        <td class="align-middle text-left"><?php echo $row['name'];?></td>
                                        <td class="align-middle text-left"><?php echo $row['email'];?></td>
                                        <td class="align-middle text-left"><?php echo $row['mobile'];?></td>
                                        <td class="align-middle text-center"><a class="btn btn-secondary btn-sm" href="<?php echo $row['report_problem_url'];?>" data-toggle="tooltip" data-placement="top" title="<?php echo $row['report_problem_url'];?>" target="_blank"><i class="fa-solid fa-up-right-from-square"></i></a></td>
                                        <td class="align-middle text-left"><?php echo date('d-M-Y h:i:s A',strtotime($row['created_at']));?></td>
                                        <td class="align-middle text-left"><?php echo ($row['updated_at'])?date('d-M-Y h:i:s A',strtotime($row['updated_at'])):'';?></td>
                                        <td class="align-middle text-left"><div class="d-inline-block text-truncate" style="width:140px"><?php echo $row['report_problem_description'];?></div></td>
                                        
                                        <td class="align-middle text-center text-nowrap" style="font-family:Rubik">
                                        	<?php 
                                             $class = "";
                                            if($row['status'] == 'Closed'){ 
                                                $class = "text-success";
                                                $icon = "<i class='fa-regular fa-circle-check'></i>";
                                            }else if($row['status'] == 'Cancelled'){
                                                $class = "text-danger";
                                                $icon = "<i class='fa-regular fa-circle-xmark'></i>";
                                            }else{
                                                $class = "text-warning";
                                                $icon = "<i class='fa-solid fa-triangle-exclamation'></i>";
                                            }
                                            ?>
                                          
                                            <span class="<?php echo $class; ?>"><?php echo $icon;?> <?php echo ucfirst($row['status']); ?></span>
											
                                        </td>
                                        <td class="align-middle text-center text-nowrap">                                            
                                            <a reporterName="<?php echo $row['name']; ?>" reporterEmail="<?php echo $row['email']; ?>" reporterMobile="<?php echo $row['mobile']; ?>" reportedOn="<?php echo date('d-M-Y h:i:s A',strtotime($row['created_at']));?>" reporterBrowser="<?php echo $row['browser']; ?>" reportedURL="<?php echo $row['report_problem_url']; ?>" reporterDescription="<?php echo $row['report_problem_description']; ?>" status="<?php echo $row['status']; ?>" eid="<?php echo $row['id']; ?>" class="btn btn-dark btn-sm get-record" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Edit Record"><i class="fa fa-pencil-square-o"></i>
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
                                <i class="fa-solid fa-bug"></i> Reported by <span class="text-danger" id ="reportBy"></span>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm1" name="frm1" action="#" method="post" onsubmit="return false;">
                                <input type="hidden" name="record_id" id="record_id">
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="reporterName">Reporter Name</label>                                            
                                            <input type="text" class="form-control" id="reporterName" name="reporterName" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="reporterEmail">Reporter Email</label>                                            
                                            <input type="text" class="form-control" id="reporterEmail" name="reporterEmail" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="reporterMobile">Reporter Mobile</label>                                            
                                            <input type="text" class="form-control" id="reporterMobile" name="reporterMobile" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="reportedOn">Reported On</label>                                            
                                            <input type="text" class="form-control" id="reportedOn" name="reportedOn" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="reporterBrowser">Reporter Browser</label>                                            
                                            <input type="text" class="form-control" id="reporterBrowser" name="reporterBrowser" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label for="reportedURL">Reported URL <a class="text-danger" href="" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i></a></label>                                            
                                            <input type="text" class="form-control" id="reportedURL" name="reportedURL" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label for="reporterDescription">Reporter Description</label>                                            
                                            <textarea class="form-control" id="reporterDescription" name="reporterDescription" readonly></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="status">Status</label>                                            
                                            <select class="form-control" id="status" name="status">
                                                <option value="">Select</option>
                                                <option value="Closed">Closed</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
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
                if ($.trim($("#status").val()) == "") {
                    toastr.error("Select status");
                    $("#status").focus();
                    return false;
                }
                return true;
            }

            function saveData() {
                var form1 = $('#frm1');
                $('#dvLoading').show();
                $.ajax({
                    type: "post",
                    async: false,
                    url: "Save_report_problem.php",
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


            //GET SINGLE RECORD
            $(".get-record").click(function() {
                $('#dvLoading').show();
                var record_id = $(this).attr("eid");
                var status = $(this).attr("status");
                var reporterName = $(this).attr("reporterName");
                var reporterEmail = $(this).attr("reporterEmail");
                var reporterMobile = $(this).attr("reporterMobile");
                var reportedOn = $(this).attr("reportedOn");
                var reportedURL = $(this).attr("reportedURL");
                var reporterDescription = $(this).attr("reporterDescription");
                var reporterBrowser = $(this).attr("reporterBrowser");
                $("#record_id").val(record_id);
                $("#reporterName").val(reporterName);
                $("#reporterEmail").val(reporterEmail);
                $("#reporterMobile").val(reporterMobile);
                $("#reportedOn").val(reportedOn);
                $("#reportedURL").val(reportedURL);
                $("#reporterDescription").val(reporterDescription);
                $("#reporterBrowser").val(reporterBrowser);
                $("#status").val(status);
                $("#reportBy").text(reporterName);
                $("#add_edit_form").modal();
                $('#dvLoading').hide();
            });

            function resetdata() {
                $("#country_name").val("");
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