<?php
include_once("../connection.php");
include_once("../configuration.php");
include_once("../session.php");
include_once("../function.php");



$client_id = $_SESSION['userid']; 

// Fetch ad records for the client
$ad_records = [];
$strsql = "SELECT * FROM ads WHERE client_id = :client_id";
$stmt = $dbConn->prepare($strsql);
$stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
$stmt->execute();
$ad_records = $stmt->fetchAll(PDO::FETCH_ASSOC);

//echo "<pre>"; print_r($ad_records);

// Extract ad IDs from records
$ad_ids = array_column($ad_records, 'id');
//print_r($ad_ids); die;


// Prepare the placeholder for the IN clause
$in_placeholder = implode(',', array_fill(0, count($ad_ids), '?'));

//START CLICK COUNT

$click_counts = [];
// Fetch click counts from `ad_clicks` for each `ad_id`
if (!empty($ad_ids)) {
    $strsql = "SELECT ad_id, COUNT(*) AS click_count FROM ad_clicks WHERE ad_id IN ($in_placeholder) GROUP BY ad_id";
    $stmt = $dbConn->prepare($strsql);
    $stmt->execute($ad_ids);
    $click_counts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
  // echo "<pre>Click Counts:\n"; print_r($click_counts);
} else {
    $click_counts = [];
}

//END CLICK COUNT

//START CLICK COUNT

$impression_counts = [];
// Fetch click counts from `ad_clicks` for each `ad_id`
if (!empty($ad_ids)) {
    $strsql = "SELECT ad_id, COUNT(*) AS impression_count FROM ad_impressions WHERE ad_id IN ($in_placeholder) GROUP BY ad_id";
    $stmt = $dbConn->prepare($strsql);
    $stmt->execute($ad_ids);
    $impression_counts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
  // echo "<pre>Click Counts:\n"; print_r($impression_counts);
} else {
    $impression_counts = [];
}

//END CLICK COUNT

//$dbConn = null;
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
<style>
    /* Tab container styling */
    .tab-container {
        display: flex;
        border-bottom: 2px solid #ccc;
    }

    /* Tab buttons styling */
    .tab-button {
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        outline: none;
        background-color: #f1f1f1;
        color: #333;
        font-size: 16px;
    }

    /* Active tab styling */
    .tab-button.active {
        background-color: #007bff;
        color: white;
        border-bottom: 2px solid #007bff;
    }

    /* Tab content styling */
    .tab-content {
        display: none;
        padding: 20px;
        border: 1px solid #ccc;
    }

    /* Show active tab content */
    .tab-content.active {
        display: block;
    }
</style>
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <div>
            <!-- Tab container -->
            <div class="tab-container">
                <button class="tab-button active" onclick="openTab(event, 'Tab1')">Click</button>
                <button class="tab-button" onclick="openTab(event, 'Tab2')">Impression</button>
                <button class="tab-button" onclick="openTab(event, 'Tab3')">Bill</button>
            </div>

            <!-- Tab content sections -->
            <div id="Tab1" class="tab-content active">
                <?php 
                if ($click_counts) {
                    foreach ($click_counts as $value) {
                        // Fetch the image for the current ad ID
                        $ad_image_file = getAdImageByAdId($value['ad_id']); 

                        // Check if an image was found
                        if ($ad_image_file === "NA") {
                            echo "<p>No image found for Ad ID: {$value['ad_id']}</p>";
                            continue; // Skip to the next iteration if no image
                        }
                        ?>
                        <a href="javascript:void(0)" onclick="getClickDetails(<?php echo $value['ad_id']?>)">
                        <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                            <img class="img-fluid" src="<?php echo BASE_URL_UPLOADS.'/ad/'.$ad_image_file;?>" alt="Ad Image">
                            <h2>Click: <?php echo $value['click_count']; ?></h2>
                        </div>
                        </a>
                        <a href="getClickDetail.php?ad_id=<?php echo base64_encode($value['ad_id'])?>" target="_blank"> Get Customize Detail</a>
                        <?php
                    }
                } else {
                    echo "<p>No click counts available.</p>";
                }
                ?>
            </div>

            <div id="Tab2" class="tab-content">
                <?php 
                if ($impression_counts) {
                    foreach ($impression_counts as $value) {
                        // Fetch the image for the current ad ID
                        $ad_image_file = getAdImageByAdId($value['ad_id']); 

                        // Check if an image was found
                        if ($ad_image_file === "NA") {
                            echo "<p>No image found for Ad ID: {$value['ad_id']}</p>";
                            continue; // Skip to the next iteration if no image
                        }
                        ?>
                        <a href="javascript:void(0)" onclick="getImpressionDetails(<?php echo $value['ad_id']?>)">
                        <div class="col-md-2 col-6 mb-3 text-center" style="font-family:Inter; font-size:14px; color:#666">
                            <img class="img-fluid" src="<?php echo BASE_URL_UPLOADS.'/ad/'.$ad_image_file;?>" alt="Ad Image">
                            <h2>Impressions: <?php echo $value['impression_count']; ?></h2>
                        </div>
                        </a>
                        <a href="getImpressionDetail.php?ad_id=<?php echo base64_encode($value['ad_id'])?>" target="_blank"> Get Customize Detail</a>
                        <?php
                    }
                } else {
                    echo "<p>No click counts available.</p>";
                }
                ?>
            </div>

            <div id="Tab3" class="tab-content">
                <h3>Tab 3 Content</h3>
                <p>This is the content for Tab 3.</p>
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
      

    <!--MODAL START-->
    <div class="modal fade" id="click-detail-info" tabindex="-1" role="dialog" aria-labelledby="add_edit_formTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addJournalModalLongTitle" style="font-family:Oswald">
                        <i class="fa-solid fa-pen-to-square"></i> List Of Click On Ads 
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid mt-4">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="master-table" class="table table-bordered order-table" style="font-family:Rubik">
                                        <thead class="bg-light text-center font-weight-bold">
                                            <tr>
                                            <td class="align-middle">SL No.</td>
                                                <td class="align-middle">Click Date Time</td>
                                                <td class="align-middle">IP Address </td>
                                                <td class="align-middle">Device</td>
                                                <td class="align-middle">Browser</td>
                                                <td class="align-middle">Platform</td>
                                                <td class="align-middle">City</td>
                                            </tr>
                                        </thead>
                                        <tbody id="clickDetailTable">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--MODAL END-->

        <!--MODAL START-->
        <div class="modal fade" id="impression-detail-info" tabindex="-1" role="dialog" aria-labelledby="add_edit_formTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addJournalModalLongTitle" style="font-family:Oswald">
                        <i class="fa-solid fa-pen-to-square"></i> List Of Impression On Ads 
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid mt-4">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="master-table-impression" class="table table-bordered order-table" style="font-family:Rubik">
                                        <thead class="bg-light text-center font-weight-bold">
                                            <tr>
                                            <td class="align-middle">SL No.</td>
                                                <td class="align-middle">Click Date Time</td>
                                                <td class="align-middle">IP Address </td>
                                                <td class="align-middle">Device</td>
                                                <td class="align-middle">Browser</td>
                                                <td class="align-middle">Platform</td>
                                                <td class="align-middle">City</td>
                                            </tr>
                                        </thead>
                                        <tbody id="impressionDetailTable">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--MODAL END-->

    <script src="<?php echo BASE_URL_CLIENT;?>/clientuser/js/dashboard.js"></script>
    
    <script>
    // JavaScript function to open tabs
    function openTab(event, tabName) {
        // Hide all tab contents
        var tabContents = document.getElementsByClassName("tab-content");
        for (var i = 0; i < tabContents.length; i++) {
            tabContents[i].classList.remove("active");
        }

        // Remove the "active" class from all buttons
        var tabButtons = document.getElementsByClassName("tab-button");
        for (var i = 0; i < tabButtons.length; i++) {
            tabButtons[i].classList.remove("active");
        }

        // Show the current tab and add the "active" class to the clicked button
        document.getElementById(tabName).classList.add("active");
        event.currentTarget.classList.add("active");
    }
    </script>
</body>
</html>