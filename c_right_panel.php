<?php include("college_page_admission_links_V.php");?>

<section class="mt-3 mb-3">
    <div class="container-fluid p-0 m-0">
        <div class="row">
            <div class="col-md-12">
                <?php include("google_ads_square.php");?>
            </div>
        </div>
    </div>
</section>

<?php 


if(isset($records['notice_for']) && $records['notice_for'] == 1){
    include_once("college_page_notice_board.php");
} 
if(isset($records['notice_for']) && $records['notice_for'] == 2){
    include_once("university_page_notice_board.php");
} 
?>


<a class="btn btn-warning reportAProblem" href="javascript:void(0)">Report A Problem</a>


<section class="mt-3 mb-3 d-block d-sm-none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php include("google_ads_contextual.php");?>
            </div>
        </div>
    </div>
</section>