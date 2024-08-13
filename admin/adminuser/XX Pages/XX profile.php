<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
session_start();
include_once("../session.php");
include_once("../../function.php");
include_once("../../connection.php");
include_once("../../configuration.php");
$user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";
$userQuery = $dbConn->prepare("select name,department,email,mobile,designation from users WHERE id=$user_id");
$userQuery->execute();
$userRecord = $userQuery->fetch(PDO::FETCH_ASSOC);
//$usertype = $userRecord['user_type']; 
// echo $userRecord['name'];
// print_r($userRecord);
$departmentRecord =array();

$departmentQuery = "select * from department order by id desc;";

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
<title>Update Profile | Journal - <?php echo COLLEGE_NAME; ?></title>
<?php include("../../head_includes.php");?>
<style type="text/css">
.form-group label{font-family:Viga !important; color:#033; font-size:14px !important}
</style>
<!--<style type="text/css">
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>-->
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <div class="pl-3 pr-3 pt-0">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3 class="border-bottom pb-2" style="font-family:Oswald"><i class="fa-solid fa-user-edit"></i> Update <span class="text-danger">Profile</span></h3>
                </div>
            </div>
        </div>
        
        <div class="container mt-4">
            <form id="frm1" name="frm1" action="#" method="post"  onsubmit="return false;">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select class="form-control" id="department" name="department" autocomplete="off" disabled>
                                <option value="">Select</option>
                                <?php if(count($departmentRecord)>0){
                                    foreach ($departmentRecord as $row) {
                                ?>
                                <option <?php echo ($userRecord['department'] == $row['id'])?"selected":""; ?> value="<?php echo $row['id']; ?>"><?php echo $row['department_name']; ?></option>
                                <?php } }?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="name">Teacher Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Teacher Name" autocomplete="off" maxlength="75" value="<?php echo !empty($userRecord['name'])?$userRecord['name']:""; ?>">
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Designation" autocomplete="off" value="<?php echo !empty($userRecord['designation'])?$userRecord['designation']:""; ?>">
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="email">Email Id.</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Id." autocomplete="off" disabled value="<?php echo !empty($userRecord['email'])?$userRecord['email']:""; ?>">
                            <!--<small id="emailHelp" class="form-text text-muted">Note: Email Id. will be your Username.</small>-->
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="mobile">Mobile No.</label>
                            <input type="text"  class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile No." autocomplete="off"  maxlength="10" onKeyPress="inputNumber(event,this.value,false);" inputmode="numeric" value="<?php echo !empty($userRecord['mobile'])?$userRecord['mobile']:""; ?>">
                        </div>
                    </div>
                    
                    <div class="col-md-12 text-center mb-5">
                        <button  class="btn btn-danger btn-sm align-middle" id="submit" name="submit" onClick="submitdata();">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
             
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
                
            

            if($.trim($("#name").val())=="")
            {
                // $("#msgcontent").html("Enter Teacher Name");
                // $("#ValidationAlert").modal();
                toastr.error("Enter Teacher Name");
                $("#name").focus();
                return false;
            }
           
            if($.trim($("#email").val())=="")
            {
                toastr.error("Enter Email Id.");
                $("#email").focus();
                return false;
            }
            else
            {
                var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
                if(!filter.test($.trim($("#email").val())))
                {
                    
                    toastr.error("Enter E-mail in valid format");
                    $("#email").focus();
                    return false;
                }
            }

            if($.trim($("#mobile").val())=="")
            {
                toastr.error("Enter Mobile Number");
                $("#mobile").focus();
                return false;
            }
            if($.trim($("#mobile").val())!="" ) 
            {
                var  mobno = $("#mobile").val().replaceAll(/\s/g,'') ;
                if(mobno.length!=10 ) { 
              
                toastr.error("Enter Valid Mobile Number");
                $("#mobile").focus();
                return false;
                }
                
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
                url: "Save_profile.php", 
                data: form1.serialize(), 
                dataType: "json",
            
                success: function(data) {
            // alert(JSON.stringify(data))
                        if(data.status==1)
                        {
                            $("#statusMsgcontent").html("<p class='text-center font-weight-bold mt-2' style='font-size:16px'><i class='fa-regular fa-circle-check text-success' style='font-size:40px'></i><br>Profile Updated Successfully</p>");
                            $("#statusAlert").modal();
                            //resetdata();
                            $('#dvLoading').hide();
                            //location.reload();

                        }
                        else
                        {
                            $('#dvLoading').hide();
                            toastr.error(data.msg);
                        //alert(data.msg);
                        return false;
                        }
                    
                    }
                });
        }

        $(".status-updated").click(function(){
            location.reload();
        });
    </script>
</body>
</html>