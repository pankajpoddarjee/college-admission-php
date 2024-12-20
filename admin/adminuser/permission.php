<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
include_once("../authentication.php");
include_once("../function.php");
include_once("../connection.php");
include_once("../configuration.php");
$records = [];
$strsql="select * from permissions";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

$userTypeRecords = [];
$strsql="select * from user_types";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$userTypeRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){
    $user_type = $_POST['user_type_filter'];
    $user_id = $_POST['user_filter'];
}

if(isset($user_id) && isset($user_type)){

    $userRecords = [];
    $strsql="select * from users_admin where usertype = $user_type";
    $stmt = $dbConn->prepare($strsql);
    $stmt->execute();
    $userRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="<?php echo VIEWPORT;?>">
        <title>Permission  | Admin - <?php echo COLLEGE_NAME; ?></title>        
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
                            	<h3 style="font-family:Oswald"><i class="fa-solid fa-pen-to-square"></i> Change <span class="text-danger">Permission</span></h3>
                            </div>                        	
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-4">
            <form action="" method="post">
                <div class="row">

                        
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label for="user_type_filter">User Type</label>
                                 
                                    <select name="user_type_filter" id="user_type_filter" class="form-control" onchange="getUser(this.value);">
                                        <option value="">Select</option>
                                        <?php if($userTypeRecords) {
                                            foreach ($userTypeRecords as  $value) { ?>

                                               <option value="<?php echo $value['id']; ?>" <?php echo (isset($user_type) && ($user_type == $value['id']))?"selected":""; ?>>
                                                
                                               <?php echo $value['user_type_name']; ?></option>
                                            <?php }
                                        }
                                        
                                        ?>
                                       
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label for="user_filter">User</label>                                 
                                    <select id="user_filter" name="user_filter" class="form-control">
                                   
                                        <?php if($userRecords) {
                                            foreach ($userRecords as  $value) { ?>

                                               <option value="<?php echo $value['id']; ?>" <?php echo (isset($user_id) && ($user_id == $value['id']))?"selected":""; ?>>
                                                
                                               <?php echo $value['name']; ?></option>
                                            <?php }
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 mb-2">
                                <div class="form-group">
                                    <label for="user_filter">  &nbsp;</label>                                 
                                    <button type="submit" name="submit" class=" form-control btn btn-primary"> Submit</button>
                                </div>
                            </div>
                       
                    </div>
                    </form>
                </div>
                <div class="row">
                
                    <div class="col-md-12">
                    <table id="master-table" class="table table-bordered order-table" style="font-family:Rubik">
                                <thead class="bg-light text-center font-weight-bold">
                                    <tr>
                                        <td class="align-middle">Srl</td>
                                        <td class="align-middle">Module</td>
                                        <td class="align-middle">Page Url</td>
                                        <td class="align-middle">Permission</td>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
									<?php 
                                    if(count($records)>0){
                                    $i=1;
                                    foreach ($records as $row) {
                                        $permission = ""; // Initialize permission as an empty string

                                        // Check if user_id is set
                                        if (isset($user_id) && isset($user_type)) {
                                            // Split the comma-separated user_ids into an array
                                            $permission_array = explode(',', $row['user_ids']);
                                            
                                            // Check if the user_id exists in the array
                                            if (in_array($user_id, $permission_array)) {
                                                // If user_id is found, mark the permission as "checked"
                                                $permission = "checked";
                                            } else {
                                                // If user_id is not found, permission remains empty
                                                $permission = "";
                                            }
                                        }else{
                                            $permission = "";  
                                        }
                                        
                                    ?>
                                    <tr>
                                        <td class="align-middle text-center"> <?php echo $i; ?></td>
                                        <td class="align-middle text-left"> <?php echo $row['module'];?></td>
                                        <td class="align-middle text-left"> <?php echo $row['page_url'];?></td>
                                        <td class="align-middle text-left"> 
                                        <input mid="<?php echo $row['id'];?>" uid="<?php echo isset($user_id)?$user_id:''; ?>" type="checkbox" name="user_id" class="permission" <?php echo $permission; ?> >
                                        </td>
                                        
                                       
                                    </tr><?php $i = $i+1; } } ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            
     
         
            <?php include("../footer.php");?>
        </div> 
        <?php include("../footer_includes.php");?> 
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
                        if(data.status==1)
                        {
                     

                        toastr.success(data.msg);
                        $('#old_password').val('');
                        $('#password').val('');
                        $('#repassword').val('');
                        $('#dvLoading').hide();
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

        function getUser(utid) { 
                $('#dvLoading').show();	
				$.ajax({ 
                    type: "get",
                    async: false,
                    url: "Save_permission.php?getUsers=" + utid,
                    dataType: "json",
                    success: function(data) {
                        $('#dvLoading').hide();	
                        if (data.status == 1) {
                            $('#user_filter').html("");
                                var html = '';
                                if (data.record.length > 0) {
                                    html += '<option value="">Select </option>';
                                    for (let i = 0; i < data.record.length; i++) {
                                        html += '<option value="' + data.record[i].id + '">' + data.record[i].name + '</option>';
                                    }

                                    $('#user_filter').html(html);
                                }
                                else {
                                    html += '<option value="">Select</option>';
                                    $('#user_filter').html(html);

                                }
                        } else {
                            alert(data.msg);
                            return false;
                        }
                    }
                });
            }                                                                                                                                                                                                                             
            $(document).on('change', '.permission', function () {
                var mid = $(this).attr("mid");
                var uid = $(this).attr("uid");
                if (this.checked) {
                    //console.log("Checkbox is checked");
                    $.ajax({
                        type: "get",
                        async: false,
                        url: "Save_permission.php?add_permission=" + mid + "&user_id=" + uid,
                        dataType: "json",
                        success: function(data) {
                            if (data.status == 1) {
                               // alert(data.msg);
                                toastr.success(data.msg);
                                //location.reload();
                            } else {
                                alert(data.msg);
                                return false;
                            }
                        }
                    });
                } else {
                   // console.log("Checkbox is unchecked");
                    $.ajax({
                        type: "get",
                        async: false,
                        url: "Save_permission.php?remove_permission=" + mid + "&user_id=" + uid,
                        dataType: "json",
                        success: function(data) {
                            if (data.status == 1) {
                               // alert(data.msg);
                                toastr.success(data.msg);
                                //location.reload();
                            } else {
                                alert(data.msg);
                                return false;
                            }
                        }
                    });
                }
            });
          
            // $(".status-change").click(function() {
            //     $('#dvLoading').show();
            //     var rid = $(this).attr("rid");
            //     var status = $(this).attr("status");
            //     $.ajax({
            //         type: "get",
            //         async: false,
            //         url: "Save_user.php?statusid=" + rid + "&status=" + status,
            //         dataType: "json",
            //         success: function(data) {
            //             if (data.status == 1) {
            //                 alert(data.msg);
            //                 toastr.success(data.msg);
            //                 location.reload();
            //             } else {
            //                 alert(data.msg);
            //                 return false;
            //             }
            //         }
            //     });
            // });
       
</script>
    </body>
</html>