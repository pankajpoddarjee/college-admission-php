<?php
include_once("../connection.php");
include_once("../configuration.php");
include_once("../session.php");
include_once("../function.php");
$ad_id = base64_decode($_GET['ad_id']);


?>


<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>Dashboard | <?php echo COLLEGE_NAME; ?></title>
<?php include("../head_includes.php");?>
<!--<style type="text/css">
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>-->
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <div class="pl-3 pr-3 pt-0 mt-5">
            <div class="row justify-content-center" style="margin-top:13vh; margin-bottom:13vh">                
                <div class="col-md-12 mb-1 text-center">
                    <i class="fa-solid fa-graduation-cap info2 mb-2 text-secondary" style="font-size:90px"></i>
                    <h3 class="m-0" style="font-family:Roboto">Welcome to</h3>
                	<h1 class="m-0 text-danger" style="font-family:Oswald; font-size:36px"><?php echo COLLEGE_NAME;?></h1>
                </div>
                
                <div class="col-md-12 mb-1 text-center">
                	<hr>
                </div>

                <div class="container">
                    <div class="row">
                        <form id="dateRangeForm">
                            <input type="hidden" name="ad_id" id="ad_id" value="<?php echo $ad_id ?>">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="fromDate">From Date:</label>
                                        <input type="date" id="fromDate" name="fromDate"  class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="toDate">To Date:</label>
                                        <input type="date" id="toDate" name="toDate"  class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="searchButton"></label>  
                                        <button type="submit" class="form-control btn btn-primary mt-2">Search</button>
                                    </div>
                                </div>                           
                            </div>
                        </form>
                        <!-- Display validation error -->
                        <div id="errorMessage" class="mt-3 text-danger"></div>
                        <div id="results" class="mt-3 text-danger"></div>
                    </div>

                </div>
                
               
            </div>
        </div>
        
        <div class="clearfix"></div>
        
        <div class="pl-5 pr-5 pt-0">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6 text-center">
                    <div id="appStats" class="steps_follow_animation3"></div>
                </div>
                
                <!--<div class="col-md-4 text-center">
                    <div id="categoryStats" class="steps_follow_animation3"></div>
                </div>
                
                <div class="col-md-4 text-center">
                    <div id="genderStats" class="steps_follow_animation3"></div>
                </div>-->
            </div>
        </div>
        
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
      

 

    <script src="<?php echo BASE_URL_CLIENT;?>/clientuser/js/dashboard.js"></script>
    <script>
         const fromDateInput = document.getElementById('fromDate');
        const toDateInput = document.getElementById('toDate');

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


          // Handle form submission with AJAX
          $(document).ready(function () {
            $('#dateRangeForm').on('submit', function (e) {
                e.preventDefault(); // Prevent form submission
                
                let ad_id = $('#ad_id').val();
                let fromDate = $('#fromDate').val();
                let toDate = $('#toDate').val();

                // Validate date range
                if (new Date(fromDate) > new Date(toDate)) {
                    $('#errorMessage').text('The "From Date" should be less than or equal to the "To Date".');
                    $('#results').html("");
                    return false;
                } else {
                    $('#errorMessage').text(''); // Clear previous error message
                    if(verifyInput()){
                    // AJAX request
                    $.ajax({
                        url: `client_dashboard.php?getImpressionCustomizeDetail=customize&ad_id=${ad_id}&fromDate=${fromDate}&toDate=${toDate}`,
                        type: 'GET',
                        success: function (response) {
                            // Update the table content in #results div
                            $('#results').html(response);

                            // Reinitialize DataTables
                            $('#master-table').DataTable({
                                "destroy": true,
                                "paging": true,
                                "searching": true,
                                "ordering": true,
                                "pageLength": 10,
                                "responsive": true // Make table responsive if needed
                            });
                        },
                        error: function () {
                            alert('Error occurred during the request.');
                        }
                    });
                    }
                }
            });
        });




    function verifyInput() {
        if ($.trim($("#fromDate").val()) == "") {
            toastr.error("Select from date");
            $("#fromDate").focus();
            return false;
        }

        if ($.trim($("#toDate").val()) == "") {
            toastr.error("Select to date");
            $("#toDate").focus();
            return false;
        }
        
        
        return true;
    }
    </script>
</body>
</html>