<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
session_start();
include_once("../session.php");
include_once("../../function.php");
include_once("../../connection.php");
include_once("../../configuration.php");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>Change Password | Journal - <?php echo COLLEGE_NAME; ?></title>
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
                    <h3 class="border-bottom pb-2" style="font-family:Oswald"><i class="fa-solid fa-user-lock"></i> Change <span class="text-danger">Password</span></h3>
                </div>
            </div>
        </div>
        
        <div class="container mt-4">
            <form id="frm1" name="frm1" action="#" method="post"  onsubmit="return false;">
                <div class="row">
                    
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="xxxxxx">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" autocomplete="off" placeholder="Enter Old Password" tabindex="1">
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="xxxxxx">New Password 
                                <a href="javascript:void(0)" class="text-dark" data-toggle="tooltip" data-placement="top" title="Show / Hide Password">
                                    <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
                                </a>
                            </label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Enter New Password" tabindex="2">
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="xxxxxx">Re-Enter New Password 
                                <a href="javascript:void(0)" class="text-dark" data-toggle="tooltip" data-placement="top" title="Show / Hide Password">
                                    <i id="REpass-status" class="fa fa-eye" aria-hidden="true" onClick="viewREPassword()"></i>
                                </a>
                            </label>
                            <input type="password" class="form-control" id="repassword" name="repassword" autocomplete="off" placeholder="Re-Enter New Password" tabindex="3">
                        </div>
                    </div>
                    
                    <div class="col-md-12 text-center mb-5">
                        <button  class="btn btn-danger btn-sm align-middle" id="submit" name="submit" onClick="submitdata();">Update Password</button>
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
                        <button type="button" class="close status-updated" data-dismiss="modal" aria-label="Close"  >
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
    
</body>
</html>

<script>
function viewPassword()
{
    var passwordInput = document.getElementById('password');
    var passStatus = document.getElementById('pass-status');
    
    if (passwordInput.type == 'password'){
    passwordInput.type='text';
    passStatus.className='fa fa-eye-slash';
    
    }
    else{
    passwordInput.type='password';
    passStatus.className='fa fa-eye';
    }
}
function viewREPassword()
{
    var passwordInput = document.getElementById('repassword');
    var passStatus = document.getElementById('REpass-status');
    
    if (passwordInput.type == 'password'){
    passwordInput.type='text';
    passStatus.className='fa fa-eye-slash';
    
    }
    else{
    passwordInput.type='password';
    passStatus.className='fa fa-eye';
    }
}



function submitdata() 
        { 
            if(!verifyInput())
            return false;
            saveData();
        }

        function verifyInput()
        {
                
            

            if($.trim($("#old_password").val())=="")
            {
                // $("#msgcontent").html("Enter Teacher Name");
                // $("#ValidationAlert").modal();
                toastr.error("Enter Old Password");
                $("#old_password").focus();
                return false;
            }

            if($.trim($("#password").val())=="")
            {
                toastr.error("Enter New Password");
                $("#password").focus();
                return false;
            }
            else if($.trim($("#password").val()).length<5)
            {
                toastr.error("Password must be minimum 5 characters.");
                $("#password").focus();
                return false;
            }
           

            if($.trim($("#repassword").val())=="")
            {
                toastr.error("Enter Re-Enter New Password");
                $("#repassword").focus();
                return false;
            }
            else if($.trim($("#repassword").val()).length<5)
            {
                toastr.error("Password must be minimum 5 characters.");
                $("#repassword").focus();
                return false;
            }

            if($.trim($("#repassword").val())!=$.trim($("#password").val()))
            {
                toastr.error("Your New Password and Re-Enter New Password does not matched");
                $("#repassword").focus();
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
                url: "Update_password.php", 
                data: form1.serialize(), 
                dataType: "json",
            
                success: function(data) {
            // alert(JSON.stringify(data))
                        if(data.status==1)
                        {
                            $("#statusMsgcontent").html("<p class='text-center font-weight-bold m-0' style='font-size:16px'><i class='fa-regular fa-circle-check text-success' style='font-size:40px'></i><br>Password Updated Successfully<br>You will be redirected to login page.");
                           // $("#statusAlert").modal();
                            $('#statusAlert').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
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
            //location.reload();
            var logoutUrl = '<?php echo BASE_URL?>'+'/admin/adminuser/logoutuser.php';
            window.location.href = logoutUrl;
        });
</script>