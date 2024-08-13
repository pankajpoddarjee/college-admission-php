<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

include_once("../session.php");
include_once("../../function.php");
include_once("../../connection.php");
include_once("../../configuration.php");

$journalRecord =array();

$journalQuery = "select journal.*, department.department_name,users.name as teacher_name FROM journal join department on department.id = journal.department_of_teacher join users on users.id= journal.teacher_name WHERE journal.is_deleted=0";
//$journalQuery = "select * from journal WHERE is_deleted=0 ";

if( $_SESSION['usertype'] == 2){ 
    $user_id = $_SESSION['userid'];
    $journalQuery .= " and teacher_name = $user_id";
}

$journalQuery .= " order by upload_date desc;";
$journalResult = $dbConn->query($journalQuery);

if($journalResult) {
	while ($journalRow=$journalResult->fetch(PDO::FETCH_ASSOC)){
        $journalRecord[] = $journalRow;
    }
}

//All department Record
$departmentRecord = [];
$department_id = isset($_SESSION['department_id'])?$_SESSION['department_id']:"";
$departmentSql = "";
$departmentSql .= "select * FROM department WHERE is_active=1 ";
if( $_SESSION['usertype'] == 2 && $_SESSION['department_id'] != 0){ 
    $departmentSql .= " and id = $department_id";
}
$departmentSql .= " order by id desc;";

$departmentQry = $dbConn->prepare($departmentSql);
$departmentQry->execute();
$departmentRecord = $departmentQry->fetchAll(PDO::FETCH_ASSOC);

//All  users record
$userRecord = [];
$user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";
$userSql = "";
$userSql .= "select * FROM users WHERE is_active=1 and usertype=2";
if( $_SESSION['usertype'] == 2){ 
    $userSql .= " and id = $user_id";
}
$userSql .= " order by name desc;";

//echo $userSql;
$userQry = $dbConn->prepare($userSql);
$userQry->execute();
$userRecord = $userQry->fetchAll(PDO::FETCH_ASSOC);


// $loggedInUser[0]['usertype'];
// $author_name = ($loggedInUser[0]['usertype']==2)?$loggedInUser[0]['name']:"";

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>Add / Edit Journal | <?php echo COLLEGE_NAME; ?></title>
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
                    <h3 class="border-bottom pb-2" style="font-family:Oswald"><i class="fa-solid fa-file-circle-plus"></i> Add / Edit <span class="text-danger">Journal</span></h3>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
        	<div class="row">            
            	<div class="col-md-4 mb-2">
                    <a class="btn btn-danger" href="javascript:void(0)" onclick="openjournalForm()">Add Journal</a>
                </div>
                
                <div class="col-md-8 mb-3">
                	<input class="form-control col-md-4 float-right" id="myInput" type="text" placeholder="Search..." autocomplete="off" style="padding:17px 8px 17px 8px">
                </div>
                
                <div class="col-md-12 mb-3">
                	<div class="table-responsive">
                        <table class="table table-bordered order-table" style="font-family:Rubik">
                            <thead class="bg-light text-center font-weight-bold">
                                <tr>
                                    <td class="align-middle">Srl</td>
                                    <td class="align-middle">Date</td>
                                    <td class="align-middle">Department</td>
                                    <td class="align-middle">Teacher</td>
                                    <td class="align-middle">Paper Title</td>
                                    <td class="align-middle">Author/s</td>
                                    <td class="align-middle">Journal Name</td>
                                    <td class="align-middle">Year of Pub.</td>
                                    <td class="align-middle">ISSN No.</td>
                                    <td class="align-middle">Link/s</td>
                                    <td class="align-middle">Action</td>
                                </tr>
                            </thead>
                            <tbody id="myTable">

                                <?php 
                                if(count($journalRecord)>0){
                                $i=1;
                                foreach ($journalRecord as $row) {
                                ?>
                                <tr>
                                    <td class="align-middle text-center"><?php echo $i; ?></td>
                                    <td class="align-middle text-center"><?php echo date('d F Y', strtotime($row['upload_date']));?></td>
                                    <td class="align-middle text-left"><?php echo !empty($row['department_name'])?$row['department_name']:''; ?></td>
                                    <td class="align-middle text-center"><?php echo !empty($row['teacher_name'])?$row['teacher_name']:''; ?></td>
                                    <td class="align-middle text-left"><?php echo !empty($row['paper_title'])?$row['paper_title']:''; ?></td>
                                    <td class="align-middle text-left"><?php echo !empty($row['author_name'])?$row['author_name']:''; ?></td>
                                    <td class="align-middle text-left"><?php echo !empty($row['journal_name'])?$row['journal_name']:''; ?></td>
                                    <td class="align-middle text-center"><?php echo !empty($row['year_of_publication'])?$row['year_of_publication']:''; ?></td>
                                    <td class="align-middle text-center"><?php echo !empty($row['issn_no'])?$row['issn_no']:''; ?></td>
                                    <td class="align-middle text-center">
                                        <a class="btn btn-outline-primary btn-sm mb-1 " target="_blank" href="<?php echo !empty($row['website_link'])?$row['website_link']:''; ?>" data-toggle="tooltip" data-placement="top" title="Link to Website of the Journal">Link 1</a>
                                        <a class="btn btn-outline-primary btn-sm " target="_blank" href="<?php echo !empty($row['article_link'])?$row['article_link']:''; ?>" data-toggle="tooltip" data-placement="top" title="Link to Article / Paper">Link 2</a>
                                    </td>
                                    <td class="align-middle text-center text-nowrap">
                                        <?php if($row['is_active'] == 1){ ?>
                                        <a status="<?php echo $row['is_active']; ?>" jid="<?php echo $row['id']; ?>" class="btn btn-success btn-sm status-journal" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Record is Active." id="deactive-journal"><i class="fa fa-check-square-o"></i></a>
                                        <?php } else{ ?>
                                        <a status="<?php echo $row['is_active']; ?>" jid="<?php echo $row['id']; ?>" class="btn btn-warning btn-sm status-journal" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Record is Inacctive." id="active-journal"><i class="fa fa-exclamation-triangle"></i></a>
                                        <?php } ?>

                                        <a jid="<?php echo $row['id']; ?>" class="btn btn-dark btn-sm get-record" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Edit Record"   ><i class="fa fa-pencil-square-o"></i></a>

                                        <a jid="<?php echo $row['id']; ?>" jname="<?php echo $row['journal_name']; ?>" jtitle="<?php echo $row['paper_title']; ?>" jauthor="<?php echo $row['author_name']; ?>" class="btn btn-danger btn-sm delete-record-confirmation" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Delete Record"><i class="fa fa-trash-o"></i></a>
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
        
        <!--FORM START-->
        
        <div class="modal fade" id="addJournal" tabindex="-1" role="dialog" aria-labelledby="addJournalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="addJournalModalLongTitle" style="font-family:Oswald"><i class="fa-solid fa-file-circle-plus"></i> Add / Modify <span class="text-danger">Journal</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="frm1" name="frm1" action="#" method="post"  onsubmit="return false;">
                            <input type="hidden" name="journal_id" id="journal_id">
                            <div class="container">
                                <div class="row">
                                
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="xxxxxx">Department</label>
                                            <select class="form-control" id="department_of_teacher" name="department_of_teacher" autocomplete="off" onchange="getTeacher(this.value)">
                                                <option value="">Select</option>

                                                <?php if(count($departmentRecord)>0){
                                                    foreach ($departmentRecord as $row) {
                                                ?>
                                                <option <?php echo ($_SESSION['department_id'] == $row['id'])?"selected":""; ?> value="<?php echo $row['id']; ?>"><?php echo $row['department_name']; ?></option>
                                                <?php } }?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="xxxxxx">Teacher</label>
                                            <select class="form-control" id="teacher_name" name="teacher_name" autocomplete="off">
                                                <option value="">Select</option>
                                                <?php if($userRecord){
                                                    foreach ($userRecord as $row) {
                                                ?>
                                                <option <?php echo ($_SESSION['userid'] == $row['id'])?"selected":""; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } }?>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="xxxxxx">Name of Author/s</label>
                                            <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Enter Author/s Name" autocomplete="off">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="xxxxxx">Title of the Paper</label>
                                            <input type="text" class="form-control" id="paper_title" name="paper_title" placeholder="Enter Paper Title" autocomplete="off">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="xxxxxx">Name of Journal</label>
                                            <input type="text" class="form-control" id="journal_name" name="journal_name" placeholder="Enter Journal Name" autocomplete="off">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="xxxxxx">Year of Publication</label>
                                            <input type="text" class="form-control" id="year_of_publication" name="year_of_publication" placeholder="Enter Publication Year" autocomplete="off" maxlength="4" onKeyPress="inputNumber(event,this.value,false);" inputmode="numeric">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="xxxxxx">ISSN No.</label>
                                            <input type="text" class="form-control" id="issn_no" name="issn_no" placeholder="Enter ISSN No." autocomplete="off">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="xxxxxx">Link to website of the Journal</label>
                                            <input type="text" class="form-control" id="website_link" name="website_link" placeholder="Enter Journal Link" autocomplete="off">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="xxxxxx">Link to article / paper / abstract of the article</label>
                                            <input type="text" class="form-control" id="article_link" name="article_link" placeholder="Enter Article / Paper Link" autocomplete="off">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="xxxxxx">Upload Date</label>
                                            <input type="date" class="form-control" id="upload_date" name="upload_date" value="<?php echo date('Y-m-d');?>" autocomplete="off">
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button  class="btn btn-primary btn-sm" id="submit" name="submit" onClick="submitdata();"><i class="fa-solid fa-file-arrow-up"></i> Upload Journal</button>
                                        <button class="btn btn-danger btn-sm" id="reset" name="reset" onClick="resetdata();"><i class="fa-regular fa-circle-xmark"></i> Reset Data</button>
                                    </div>
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
        
        <!--FORM END-->
        
        
         <!--MODAL START-->
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

        <!--DELETE MODAL START-->
        <div class="modal fade" id="deleteAlert" tabindex="-1" role="dialog" aria-labelledby="deleteAlertTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="ShowdeleteAlert"><?php echo MODAL_VALIDATION_TEXT;?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-left" >
                        <input type="hidden" name="delete_id" id="delete_id">
                    	<p id="deleteMsgcontent"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm "  id="delete-record"><i class="fa-regular fa-trash-can"></i> Yes, Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
        <!--DELETE MODAL END-->  

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
         //alert("621");
            if(!verifyInput())
                return false;
        //alert("624")		
            saveData();
        }

        function verifyInput()
        {            

            if($.trim($("#department_of_teacher").val())=="")
            {
                // $("#msgcontent").html("Select Department");
                // $("#ValidationAlert").modal();
                toastr.error("Select Department");
                $("#department_of_teacher").focus();
                return false;
                
            }

            if($.trim($("#teacher_name").val())=="")
            {
                // $("#msgcontent").html("Select Teacher Name");
                // $("#ValidationAlert").modal();
                toastr.error("Select Teacher Name");
                $("#teacher_name").focus();
                return false;
                
            }

            if($.trim($("#author_name").val())=="")
            {
                // $("#msgcontent").html("Enter Name of Author/s");
                // $("#ValidationAlert").modal();
                toastr.error("Enter Name of Author/s");
                $("#author_name").focus();
                return false;
                
            }
			
			if($.trim($("#paper_title").val())=="")
            {
                // $("#msgcontent").html("Enter Title of the Paper");
                // $("#ValidationAlert").modal();
                toastr.error("Enter Title of the Paper");
                $("#paper_title").focus();
                return false;
                
            }
            
            if($.trim($("#journal_name").val())=="")
            {
                // $("#msgcontent").html("Enter Name of Journal");
                // $("#ValidationAlert").modal();
                toastr.error("Enter Name of Journal");
                $("#journal_name").focus();
                return false;
                
            }
            
            if($.trim($("#year_of_publication").val())=="")
            {
                // $("#msgcontent").html("Enter Year of Publication");
                // $("#ValidationAlert").modal();
                toastr.error("Enter Year of Publication");
                $("#year_of_publication").focus();
                return false;
                
            }

            if($.trim($("#year_of_publication").val())!="" ) 
            {
                var  mobno = $("#year_of_publication").val().replaceAll(/\s/g,'') ;
                if(mobno.length!=4 ) { 
              
                toastr.error("Enter Valid Year of Publication");
                $("#year_of_publication").focus();
                return false;
                }
                
            }
            
            if($.trim($("#issn_no").val())=="")
            {
                // $("#msgcontent").html("Enter ISSN No.");
                // $("#ValidationAlert").modal();
                toastr.error("Enter ISSN No.");
                $("#issn_no").focus();
                return false;
                
            }
            
            if($.trim($("#website_link").val())=="")
            {
                // $("#msgcontent").html("Enter Link to website of the Journal");
                // $("#ValidationAlert").modal();
                toastr.error("Enter Link to website of the Journal");
                $("#website_link").focus();
                return false;
                
            }
            
            if($.trim($("#article_link").val())=="")
            {
                // $("#msgcontent").html("Enter Link to article / paper / abstract of the article");
                // $("#ValidationAlert").modal();
                toastr.error("Enter Link to article / paper / abstract of the article");
                $("#article_link").focus();
                return false;
                
            }
            
            if($.trim($("#upload_date").val())=="")
            {
                // $("#msgcontent").html("Enter Upload Date");
                // $("#ValidationAlert").modal();
                toastr.error("Enter Upload Date");
                $("#upload_date").focus();
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
                url: "Save_Journal.php", 
                data: form1.serialize(), 
                dataType: "json",
            
                success: function(data) {
            // alert(JSON.stringify(data))
                        if(data.status==1)
                        {
                            alert("Journal Saved Successfully");
                            resetdata();
                            $('#dvLoading').hide();
                            location.reload();

                        }
                        else
                        {
                            $('#dvLoading').hide();
                        alert(data.msg);
                        return false;
                        }
                    
                    }
                });
        }

        function resetdata()
        { 
            $("#journal_id").val("");
            $("#paper_title").val("");
            $("#teacher_name").val("");
            $("#author_name").val("");
            $("#journal_name").val("");
            $("#year_of_publication").val("");
            $("#issn_no").val("");
            $("#website_link").val("");
            $("#article_link").val("");
            $("#upload_date").val("");
            $("#department_of_teacher").val("");
        }



        //GET SINGLE RECORD
        $(".get-record").click(function(){

                $('#dvLoading').show();
               var jid = $(this).attr("jid");  

               $.ajax({
                type: "get",
                async: false,
                url: "Save_Journal.php?jid=" + jid,
                dataType: "json",
            
                success: function(data) {
                        if(data.status==1)
                        {
                           // $('#add_edit_Journal').collapse();

                            $('#add_edit_Journal').collapse('show');
                            getTeacher(data.record.department_of_teacher)

                            $("#journal_id").val(data.record.id);
                            $('#department_of_teacher').val(data.record.department_of_teacher);
                            $('#teacher_name').val(data.record.teacher_name);
                            $('#author_name').val(data.record.author_name);
                            $('#paper_title').val(data.record.paper_title);
                            $('#journal_name').val(data.record.journal_name);
                            $('#year_of_publication').val(data.record.year_of_publication);
                            $('#issn_no').val(data.record.issn_no);
                            $('#website_link').val(data.record.website_link);
                            $('#article_link').val(data.record.article_link);
                            $('#upload_date').val(data.record.upload_date);
                            $("#addJournal").modal();
                            // $('html, body').animate({
                            //     scrollTop: $("#content").offset().top
                            // }, 2000);

                            $('#dvLoading').hide();
                        }
                        else
                        {
                        alert(data.msg);
                        return false;
                        }
                    
                    }
                });
        });
        
    //CONFIRMATION FOR DELETE

    $(".delete-record-confirmation").click(function(){
        var jid = $(this).attr("jid");  
        var jname = $(this).attr("jname");
        var jtitle = $(this).attr("jtitle");
        var jauthor = $(this).attr("jauthor");
        $("#deleteMsgcontent").html("<p class='font-weight-bold text-center text-danger' style='font-size:16px'><i class='fa-regular fa-circle-xmark' style='font-size:40px'></i><br>Are you sure you want to delete selected Journal?</p><table class='table table-bordered' style='font-family:Rubik'><tr class='bg-light'><td class='text-nowrap'>Paper Title</td><td class='text-nowrap'>Journal Name</td><td class='text-nowrap'>Author</td></tr><tr><td>"+jtitle+"</td><td>"+jname+"</td><td>"+jauthor+"</td></tr></table>");
        $('#delete_id').val(jid);
        $("#deleteAlert").modal();
    });

    //DELETE JOURNAL
    $("#delete-record").click(function(){

        $('#dvLoading').show();
        var jid = $('#delete_id').val();

        $.ajax({
        type: "get",
        async: false,
        url: "Save_Journal.php?did=" + jid,
        dataType: "json",

        success: function(data) {
                if(data.status==1)
                {
                    $('#dvLoading').hide();
                    location.reload();
                }
                else
                {
                alert(data.msg);
                return false;
                }            
            }
        });
     });

     //DEACTIVE JOURNAL

    $(".status-journal").click(function(){

        $('#dvLoading').show();
        var jid = $(this).attr("jid");  
        var status = $(this).attr("status");  
        $.ajax({
        type: "get",
        async: false,
        url: "Save_Journal.php?statusid=" + jid+"&status="+ status,
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

    $('#designation').on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        /* $("#msgcontent").html(event.keyCode");
        $("#ValidationAlert").modal();  */
        if (!regex.test(key)) {
        event.preventDefault();
        return false;
        }
    });

    function inputNumber(e,val,allowdecimal)
    {
        
        var key=(window.event) ? event.keyCode : e.charCode || 0;
        
        if(allowdecimal==true)
        {
            if(key==0 || key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57))
            {	
                if(key==46)
                {
                    if(val.indexOf(".")!=-1)
                    {
                        if(window.event)
                        {
                            event.returnValue=false
                        }
                        else
                        {
                            e.preventDefault()
                        }
                    }
                }
            }      
            else
            {
                if(window.event)
                {
                    event.returnValue=false
                }
                else
                {
                    e.preventDefault()
                }
            }
        }
        else
        {
            if(key==0 || key == 8 || key == 9 || (key >= 48 && key <= 57))
            {	
                
            }      
            else
            {
                if(window.event)
                {
                    event.returnValue=false
                }
                else
                {
                    e.preventDefault()
                }
            }
        }
    }

    function getTeacher(dep_id){

      
	//$("#teacher_name").html('');
	 if(dep_id){
	 $('#dvLoading').show();	
	 var str="<option value=''>Select</option>";


               $.ajax({
                type: "get",
                async: false,
                url: "getTeacher.php?dep_id=" + dep_id,
                dataType: "json",
			 success: function(data)
			  { 
					$('#dvLoading').hide();	


                    $('#teacher_name').html("");
                        var html = '';
                        if (data.length > 0) {
                            html += '<option value="">Select </option>';
                            for (let i = 0; i < data.length; i++) {
                                html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                            }

                            $('#teacher_name').html(html);
                        }
                        else {
                            html += '<option value="">Select</option>';
                            $('#teacher_name').html(html);

                        }
				}
			});

        }
}
function openjournalForm(){
    resetdata();
    $("#addJournal").modal(); 
}
    </script>
</body>
</html>