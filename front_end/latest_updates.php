<?php 
$recordLU = array();
$fetchallqryLU = "SELECT TOP 10 c.college_name, cty.city_name, collegeID, noticeYear, convert(varchar,convert(date, publishDate ,103) ,106) as publishDate, noticeTitle, noticeLink, IsNew FROM latestUpdates lu 
JOIN colleges c ON lu.collegeID=c.ID
JOIN cities cty ON c.city_id=cty.ID 
WHERE lu.noticeYear='".CURRENT_YEAR."' and lu.IsActive='1' order by lu.ID desc;";
$qryresultLU = $dbConn->query($fetchallqryLU);if($qryresultLU) {while ($rowLU=$qryresultLU->fetch(PDO::FETCH_ASSOC)) {$recordLU[] =$rowLU;}}
//print_r($recordLU);
?>

<div class="card">
    <div class="card-header bg-danger text-white">
        <i class="far fa-clock"></i> LATEST UPDATES <?php echo CURRENT_YEAR;?>
    </div>
    <div class="card-body border border-danger p-2 LatestUpdates_Height">
        <style type="text/css">
        .LatestUpdates_Height{height:200px; max-height:200px; overflow:auto; overflow-x: hidden;}
        .LatestUpdates {list-style:none; padding:0; margin:0; text-align:left; font-family:Rubik}
        .LatestUpdates li {padding:0 0 0 40px; margin:10px 0; border-bottom:1px dashed #CCCCCC; background: url(<?php echo BASE_URL;?>/images/institution.png) left top no-repeat;}
        .LatestUpdates .PDate{color:#C00}
        .LatestUpdates .instituteName{color:#000}
        </style>
        
        <ul class="LatestUpdates">
            <?php ?>
			<?php 
                $i=0;
                foreach($recordLU as $recLU){
                $i=$i+1;
            ?>
            
            <li>
                <a href="<?php echo $recLU["noticeLink"];?>" title="<?php echo $recLU["college_name"];?> <?php echo $recLU["noticeTitle"];?>" class="btn-link btn-block" target="_blank"><span class="PDate"><?php echo $recLU["publishDate"];?> -</span>
                    <span class="instituteName"><?php echo $recLU["college_name"];?>, <?php echo $recLU["city_name"];?> <?php if($recLU["IsNew"]==1) { ?><span class='badge badge-danger faa-flash faa-fast animated'>New</span><?php }?></span><br>
                    <?php echo $recLU["noticeTitle"];?>
                </a>
            </li>            
			<?php }?>
            <?php ?>            
        </ul>
    </div>
    <div class="card-footer bg-danger text-white text-right">
        <a href="javascript:void(0)" title="Click here to view all updates." class="btn-link text-light">
            <i class="fas fa-angle-double-right"></i> VIEW ALL UPDATES
        </a>
    </div>
</div>