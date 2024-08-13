<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
session_start();
include_once("../session.php");
include_once("../../function.php");
include_once("../../connection.php");
include_once("../../configuration.php");

$departmentRecord =array();

$departmentQuery = "select * from department order by department_name;";

$departmentResult = $dbConn->query($departmentQuery);

if($departmentResult) {
	while ($departmentRow=$departmentResult->fetch(PDO::FETCH_ASSOC)){
        $departmentRecord[] = $departmentRow;
    }
}


?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>Add Department | Journal - <?php echo COLLEGE_NAME; ?></title>
<?php include("../../head_includes.php");?>
<style type="text/css">
.form-group label{font-family:Viga !important; color:#033; font-size:14px !important}
</style>
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <div class="pl-3 pr-3 pt-0">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3 class="border-bottom pb-2" style="font-family:Oswald"><i class="fa-solid fa-book-open-reader"></i> Add New <span class="text-danger">Department</span></h3>
                </div>
            </div>
        </div>
        
        <div class="container mt-4">
            
            <div class="row">            
                <div class="col-md-4 mb-2">
                    <a class="btn btn-dark" href="javascript:void(0)" data-toggle="modal" data-target="#addDepartment">Add Department</a>
                </div>
                
                <div class="col-md-8">
                    <input class="form-control col-md-4 float-right" id="myInput" type="text" placeholder="Search..." autocomplete="off" style="padding:17px 8px 17px 8px">
                </div>
                
                <div class="col-md-12 mt-3">
                    <div class="table-responsive">
                        <table class="table table-bordered order-table" style="font-family:Rubik">
                            <thead class="bg-light text-center font-weight-bold">
                                <tr>
                                    <td class="align-middle">Srl</td>
                                    <td class="align-middle">Department Name</td>
                                    <td class="align-middle">Action</td>
                                </tr>
                            </thead>
                            <tbody id="myTable">

                                <?php 
                                if(count($departmentRecord)>0){
                                $i=1;
                                foreach ($departmentRecord as $row) {
                                ?>
                                <tr>
                                    <td class="align-middle text-center"><?php echo $i; ?></td>
                                    <td class="align-middle text-center"><?php echo $row['department_name'];?></td>
                                    <td class="align-middle text-center text-nowrap">
                                        <?php if($row['is_active'] == 1){ ?>
                                        
                                        <a status="<?php echo $row['is_active']; ?>" did="<?php echo $row['id']; ?>" class="btn btn-success btn-sm status-journal" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Record is Active." id="deactive-journal"><i class="fa fa-thumbs-o-up"></i> Active</a>
                                        <?php } else{ ?>
                                        <a status="<?php echo $row['is_active']; ?>" did="<?php echo $row['id']; ?>" class="btn btn-warning btn-sm status-journal" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Record is Inacctive." id="active-journal"><i class="fa fa-thumbs-o-down"></i> In-Active</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php $i = $i+1; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!--Search-->
        <script>
		$(document).ready(function(){
		  $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
		</script>
        <!--Search-->
        
     	<!--MODAL START-->
        
        <div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="addDepartmentTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="addDepartmentModalLongTitle" style="font-family:Oswald"><i class="fa-solid fa-file-circle-plus"></i> Add New <span class="text-danger">Department</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">
                <form id="frm1" name="frm1" action="#" method="post"  onsubmit="return false;">
              		<div class="row justify-content-center">
                        <div class="col-md-12 mb-2">
                            <div class="form-group text-center">
                                <label for="department_name">Enter Department Name</label>
                                <input type="text" class="form-control text-center" id="department_name" name="department_name" placeholder="Department Name" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="col-md-12 text-center">
                            <button  class="btn btn-danger btn-sm align-middle" id="submit" name="submit" onClick="submitdata();">Save Department</button>
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
     
         <div class="modal fade" id="ValidationAlert" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="ShowValidationAlert"><?php echo MODAL_VALIDATION_TEXT;?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-left" id="msgcontent">
                    	
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--MODAL END-->   
        <!--STATUS UPDATE MODAL START-->
        <div class="modal fade" id="statusAlert" tabindex="-1" role="dialog" aria-labelledby="statusAlertTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title text-danger" id="ShowdeleteAlert"><?php echo MODAL_VALIDATION_TEXT;?></h5>
                        <button type="button" class="close status-updated" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-left" >
                        <input type="hidden" name="delete_id" id="delete_id">
                    	<span id="statusMsgcontent"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm status-updated" >Close</button>

                    </div>
                </div>
            </div>
        </div>
        <!--MODAL END-->
    	<?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>
    <script>


        function submitdata() 
        {
            if(!verifyInput())
            return false;
            saveData();
        }

        function verifyInput()
        {
                
            if($.trim($("#department_name").val())=="")
            {
                // $("#msgcontent").html("Enter Department Name");
                // $("#ValidationAlert").modal();
                toastr.error("Enter Department Name");
                $("#department_name").focus();
                return false;
            }
                
        return true;		
        }

        function saveData()
        { 
        
            var form1 = $('#frm1');
            $('#dvLoading').show();
            $.ajax({
                type: "post",
                async: false,
                url: "Save_department.php", 
                data: form1.serialize(), 
                dataType: "json",
            
                success: function(data) {
            // alert(JSON.stringify(data))
                        if(data.status==1)
                        {
                            
                            alert("Department Saved Successfully");
                            //resetdata();
                            $('#dvLoading').hide();

                            // setTimeout(function () {
                            //     toastr.success("Department Saved Successfully");
                            // }, 8000);
                            location.reload();

                        }
                        else
                        {
                            $('#dvLoading').hide();
                            toastr.error("Department Already Exist");
                            $("#department_name").focus();
                        return false;
                        }
                    
                    }
                });
        }

         //DEACTIVE JOURNAL

         $(".status-journal").click(function(){

            $('#dvLoading').show();
            var did = $(this).attr("did");  
            var status = $(this).attr("status");  
            $.ajax({
            type: "get",
            async: false,
            url: "Save_department.php?statusid=" + did+"&status="+ status,
            dataType: "json",

            success: function(data) {
                    if(data.status==1)
                    {
                        //alert('status updated successfully');
                        $('#dvLoading').hide();
                        $("#statusMsgcontent").html("<p class='text-center font-weight-bold mt-2' style='font-size:16px'><i class='fa-regular fa-circle-check text-success' style='font-size:40px'></i><br>Status updated successfully</p>");
                        $("#statusAlert").modal();
                    // location.reload();
                    }
                    else
                    {
                    alert(data.msg);
                    return false;
                    }            
                }
            });
        });

        $(".status-updated").click(function(){
        location.reload();
        });
    </script>
</body>
</html>