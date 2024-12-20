<!-- <style type="text/css">
@media only screen and (max-width: 480px) {
.gAD_Horizontal{min-width:200px; max-width:300px; min-height:200px; max-height:360px !important; margin-left:auto !important; margin-right:auto !important; text-align:center !important}
}
@media only screen and (max-width: 767px) {
.gAD_Horizontal{width:99.5%; height:90px; max-height:120px;margin-top:2px; margin-bottom:2px;}
}
@media only screen and (max-width: 1050px) {
.gAD_Horizontal{width:100% !important; height:250px !important; max-height:250px !important; text-align:center !important; margin-left:auto !important; margin-right:auto !important}
}
@media only screen and (min-width: 1050px) {
.gAD_Horizontal{min-width:728px; max-width:100%; min-height:90px; max-height:90px !important; margin-left:auto !important; margin-right:auto !important; text-align:center !important}
}
</style> -->

<!-- Responsive CA 06/12/2016 -->
<!-- <ins class="adsbygoogle gAD_Horizontal" style="display:block;" data-ad-client="ca-pub-5248769025296831" data-ad-slot="1444750687" data-ad-format="horizontal" data-full-width-responsive="false"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script> -->

<?php $add1 = getTopAd('university','top'); 
if(isset($add1['id'])){
    $ad_id = $add1['id'];
    // Build the URL with query parameters
    $url = BASE_URL."/log_impression.php?ad_id=$ad_id";
    // Prepare the command string with the dynamically built URL
    $command = 'start /B curl "' . $url . '"';
    // Execute the background task using exec()

    //exec($command);
?>
<div class="text-center">
<a class="ad" onclick="recordAdClick(<?php echo $add1['id']; ?>)" href="<?php echo $add1['ad_link']; ?>" target="_blank"><img class="img-fluid" src="<?php echo BASE_URL_UPLOADS.'/ad/'.$add1['ad_image'];?>" alt="<?php echo $add1['alt']; ?>"></a>
</div>
<?php } ?>