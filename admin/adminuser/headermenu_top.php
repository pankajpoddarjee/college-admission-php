<style type="text/css">
.no-arrow .dropdown-toggle::after{display:none}
.text-gray-400{color:#d1d3e2!important}
.no-BG:focus{background:inherit}
</style>
<?php
$reportBugRecords = [];
$strsql="select * from report_problem where is_read=0 order by status desc, created_at desc";
$stmt = $dbConn->prepare($strsql);
$stmt->execute();
$reportBugRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark p-2 mb-3 d-print-none">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-secondary">
            <i class="fa fa-bars"></i>
            <!--<span>Show / Hide</span>-->
        </button>
        <button class="btn btn-secondary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-user"></i>
        </button>
        <!-- Open Report Problem Notification -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">  
                  	
                <li class="nav-item dropdown no-arrow">
                  
                    <a class="nav-link dropdown-toggle no-BG" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="badge badge-danger"><?php echo count($reportBugRecords); ?></span>
                        <span class="d-none d-lg-inline text-white"><i class="fa-solid fa-bug mr-2" aria-hidden="true"></i></span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div id="navbarSupportedContent" class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userDropdown">
                      <?php  if(count($reportBugRecords)>0){  ?>  
                        <a href="javascript:void(0)" onclick="updateAllReadStatus()">Mark All As Read</a>
                        <?php foreach ($reportBugRecords as $row) {  ?>
						            <a class="dropdown-item" href="javascript:void(0)" onclick="updateReadStatus('<?php echo $row['id']; ?>')">
                            <i class="fa fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            <?php echo $row['name'];?> &nbsp; 
                            <span class="badge badge-success"><?php echo timeAgo($row['created_at']);?></span>
                            
                        </a>
                        <?php } ?>
                       
                      
                    </div>
                    <?php } else{ ?>
                        <a class="nav-item dropdown no-arrow">
                          No record found
                    </a>
                    <?php } ?>
                </li>
              
            </ul>            
        </div>
        <!-- Close Report Problem Notification -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">            	
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle no-BG" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-lg-inline text-warning"><?php echo !empty($adminusername)?ucwords($adminusername):""; ?></span>
                        <span class="d-none d-lg-inline text-white"><i class="fa fa-user border border-dark p-1 rounded" style="font-size:20px; color:rgba(255,255,255,0.6)"></i></span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div id="navbarSupportedContent" class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userDropdown">
						<a class="dropdown-item" href="profile.php">
                            <i class="fa fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Update Profile
                        </a>
                        <a class="dropdown-item" href="changePwd.php">
                            <i class="fa fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#logoutModal">
                            <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                            <span class="text-danger">Logout</span>
                        </a>
                    </div>
                </li>
            </ul>            
        </div>
    </div>
</nav>
<script src="<?php echo BASE_URL_ADMIN;?>/bootstrap/js/menuScrollbar.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#sidebar").mCustomScrollbar({
			theme: "minimal"
		});

		$('#sidebarCollapse').on('click', function () {
			$('#sidebar, #content').toggleClass('active');
			$('.collapse.in').toggleClass('in');
			$('a[aria-expanded=true]').attr('aria-expanded', 'false');
		});
	});
</script>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalModalLongTitle">Ready to Leave ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p class="p-0 m-0" style="font-family:'Rubik'">
            <h5>Are you sure you want to Logout?</h5>
            <h6>This will end your current session.</h6>
        </p>
      </div>
      
      <div class="modal-footer">
        <a type="button" class="btn btn-danger btn-sm" href="logoutuser.php"><i class="fa fa-sign-out fa-sm fa-fw"></i> Logout</a>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>


 function updateReadStatus(bug_id) {
    $('#dvLoading').show();
    $.ajax({
      type: "get",
      async: false,
      url: "Save_report_problem.php?bug_id=" + bug_id,
      dataType: "json",
        success: function(data) {
            // alert(JSON.stringify(data))
            if (data.status == 1) {
                //alert(data.msg);
                $('#dvLoading').hide();
                toastr.success(data.msg);
                var redirect_url = "<?php echo BASE_URL_ADMIN ?>/adminuser/report_problem.php"
                window.location.href = redirect_url;
            } else {
                $('#dvLoading').hide();
                toastr.error(data.msg);
                //alert(data.msg);
                return false;
            }
        }
    });
}
function updateAllReadStatus() {
    $('#dvLoading').show();
    var param = "all";
    $.ajax({
      type: "get",
      async: false,
      url: "Save_report_problem.php?update_all_bug_id=" + param,
      dataType: "json",
        success: function(data) {
            // alert(JSON.stringify(data))
            if (data.status == 1) {
                //alert(data.msg);
                $('#dvLoading').hide();
                toastr.success(data.msg);
                var redirect_url = "<?php echo BASE_URL_ADMIN ?>/adminuser/report_problem.php"
                window.location.href = redirect_url;
            } else {
                $('#dvLoading').hide();
                toastr.error(data.msg);
                //alert(data.msg);
                return false;
            }
        }
    });
}
</script>