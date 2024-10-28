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
<?php $add1 = getAdById(2); 
//print_r($add1);
//echo $add1['id'];
if(isset($add1['id'])){

    // Get device details
    $devideDetails = getBrowserAndPlatform();
    $browser = $devideDetails['browser'];
    $platform = $devideDetails['platform'];
    $device = getDeviceType();
    $ip_address = getUserIP();
    $city = getUserCity($ip_address);
    $clicked_at = date("Y-m-d H:i:s");
    $ad_id = $add1['id'];
    $insert_sql = "INSERT INTO ad_impressions (ad_id, browser, platform, device, ip_address, city, clicked_at) 
                   VALUES (:ad_id, :browser, :platform, :device, :ip_address, :city, :clicked_at)";
    try {
        // Prepare statement
        $stmt = $dbConn->prepare($insert_sql);
        
        // Bind parameters
        $stmt->bindValue(':ad_id', $ad_id, PDO::PARAM_INT);
        $stmt->bindValue(':browser', $browser, PDO::PARAM_STR);
        $stmt->bindValue(':platform', $platform, PDO::PARAM_STR);
        $stmt->bindValue(':device', $device, PDO::PARAM_STR);
        $stmt->bindValue(':ip_address', $ip_address, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':clicked_at', $clicked_at, PDO::PARAM_STR);

        // Execute the statement
        $stmt->execute();
         
    } catch (PDOException $e) {
        echo "Error preparing statement: " . $e->getMessage(); // Provide specific error
    }

?>
<div class="text-center">
<a class="ad" onclick="recordAdClick(<?php echo $add1['id']; ?>)" href="<?php echo $add1['ad_link']; ?>" target="_blank"><img class="img-fluid" src="<?php echo BASE_URL_UPLOADS.'/ad/'.$add1['ad_image'];?>" alt="<?php echo $add1['alt']; ?>"></a>
</div>
<?php } ?>