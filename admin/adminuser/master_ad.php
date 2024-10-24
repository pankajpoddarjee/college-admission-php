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
$clientRecords = [];
$activeStatus = 1;
$strsql="select * from clients where is_active = :is_active order by company_name";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':is_active',$activeStatus);
$stmt->execute();
$clientRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

$records = [];
$strsql="select ads.*,clients.company_name,clients.client_name from ads join clients ON  ads.client_id = clients.id  order by ads.id";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Add / Modify ad | Admin - <?php echo COLLEGE_NAME; ?></title>
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
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-pen-to-square"></i> Add / Modify <span class="text-danger">Ad</span></h3>
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
                                        <td class="align-middle">Ad Image </td>
                                        <td class="align-middle">Ad ID </td>
                                        <td class="align-middle">Ad Link</td>
                                        <td class="align-middle">Company Name</td>
                                        <td class="align-middle">Alt</td>
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
                                        <td class="align-middle text-left"><img src="<?php echo BASE_URL_UPLOADS.'/ad/'.$row['ad_image'];?>" alt="" width="100" height="50"></td>
                                        <td class="align-middle text-left"> <?php echo $row['id'];?></td>
                                        <td class="align-middle text-left"> <?php echo $row['ad_link'];?></td>
                                        <td class="align-middle text-left"> <?php echo $row['company_name'];?></td>
                                        <td class="align-middle text-left"><?php echo $row['alt'];?></td>

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
                                <i class="fa-solid fa-pen-to-square"></i> Add / Edit <span class="text-danger">Ad</span>
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
                                            <label for="ad_image">Client Name</label>
                                            <select name="client_id" id="client_id" class="form-control">
                                                <option value="">Select</option>
                                                <?php 
                                                    if(count($clientRecords) > 0){
                                                        foreach ($clientRecords as $value) { ?>
                                                           <option value="<?php echo $value['id'] ?>"><?php echo $value['company_name'] ?></option>
                                                    <?php    }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="ad_image">Ad Image</label>
                                            <input type="file" accept="image/*" class="form-control-file rounded" id="ad_image" name="ad_image">
                                            <a id="ad_image_path" target="_blank" style="display:none">View</a>
                                            <a id="ad_image_path_download" target="_blank" style="display:none">Download</a>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="ad_link">Ad Link</label>
                                            <input type="text" class="form-control" id="ad_link" name="ad_link" placeholder="Enter Redirect Link" autocomplete="off" maxlength="75" tabindex="2"  >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="alt">Alt</label>
                                            <input type="text" class="form-control" id="alt" name="alt" placeholder="Enter text" autocomplete="off" >
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="from_date">From Date:</label>
                                            <input type="date" id="from_date" name="from_date"  class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="to_date">To Date:</label>
                                            <input type="date" id="to_date" name="to_date"  class="form-control">
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
         const fromDateInput = document.getElementById('from_date');
        const toDateInput = document.getElementById('to_date');

        // Add an event listener to the 'from' date input
        fromDateInput.addEventListener('change', function() {
            const fromDate = new Date(this.value);
            // Set the minimum date of 'to' date input to the selected 'from' date
            toDateInput.min = this.value;
            // If the 'to' date is before the 'from' date, reset it
            if (toDateInput.value && new Date(toDateInput.value) < fromDate) {
                toDateInput.value = '';
            }
        });    
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
                url: "Save_ad.php",
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

            if ($.trim($("#client_id").val()) == "") {
                toastr.error("Select client ");
                $("#client_id").focus();
                return false;
            }

            if ($.trim($("#record_id").val()) == "") {

                if($.trim($("#ad_image").val()) == ""){
                    toastr.error("Select Ad Image");
                    $("#ad_image").focus();
                    return false;
                }

            }
            if ($.trim($("#ad_link").val()) == "") {
                toastr.error("Enter Ad Redirect Link ");
                $("#ad_link").focus();
                return false;
            }

            if ($.trim($("#alt").val()) == "") {
                toastr.error("Enter text in Alt ");
                $("#alt").focus();
                return false;
            }

            if ($.trim($("#from_date").val()) == "") {
                toastr.error("Enter text in From Date ");
                $("#from_date").focus();
                return false;
            }

            if ($.trim($("#to_date").val()) == "") {
                toastr.error("Enter text in To Date ");
                $("#to_date").focus();
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
                url: "Save_ad.php?statusid=" + rid + "&status=" + status,
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
                url: "Save_ad.php?eid=" + eid,
                dataType: "json",
                success: function(data) {
                    if (data.status == 1) {

                        var base_url = $('#base_url').val();
                        var base_url_upload = $('#base_url_upload').val();

                        $('#ad_link').val(data.record.ad_link);

                        if(data.record.ad_image){ 

                           

                            var download_path = base_url_upload + "/ad/" + data.record.ad_image;
                        
                            $("#ad_image_path_download").show();

                           

                            $("#ad_image_path_download").attr("href", download_path);
                            $("#ad_image_path_download").attr("download", download_path);


                        
                        }else{
                            $("#ad_image_path").hide();  
                            $("#ad_image_path_download").show();
                        }
                        $('#client_id').val(data.record.client_id);
                        $('#alt').val(data.record.alt);
                      

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

            $("#ad_link").val("");
        

            $("#alt").val("");
        
            $("#ad_image_path").hide();
            $("#ad_image_path_download").hide();


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