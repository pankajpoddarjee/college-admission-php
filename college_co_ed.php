<?php include('settings.php');?>
<?php include("connection.php");include("function.php");

$fetchallqry = "SELECT c.ID, collegeUID, collegeName, collegeTypeId, ct.typeName, c.countryId, co.countryName, c.stateId, s.stateName, c.cityID, ci.cityName, folderName, fileName FROM college c 
JOIN collegeType ct ON c.collegeTypeID=ct.ID 
JOIN country co ON c.countryId=co.ID 
JOIN [state] s ON c.stateId=s.ID 
JOIN city ci ON c.cityID=ci.ID 
WHERE c.collegeTypeID='3' AND c.verified=1 order by c.collegeName";
$qryresult = $dbConn->query($fetchallqry);if($qryresult) {while ($row=$qryresult->fetch(PDO::FETCH_ASSOC)) {$record[] =$row;}} 
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title>List of Co-Educational (Co-Ed) Colleges | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="coed college list, list of co-educatioal colleges, co-ed college list">
<meta name="description" content="List of Co-Educational (Co-Ed) Colleges">
<meta property="og:title" content="List of Co-Educational (Co-Ed) Colleges | <?php echo SITE_NAME;?>">
<meta property="og:description" content="List of Co-Educational (Co-Ed) Colleges">
<meta property="og:image" content="<?php echo BASE_URL;?>/images/college_co_ed.jpg">
<meta property="og:url" content="<?php echo BASE_URL;?>/college_co_ed.php">
<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>
</head>
<body>
	<?php include("header.php");?>
    <?php include("menu.php");?>    
    <section class="bg-light">
        <div class="container-fluid page_header">
            <div class="row">
                <div class="col-md-10">
                    <img class="rounded" src="images/co_ed_logo.png" alt="logo" title="logo">
                    <a href="" title="">
                        <h1>List of Co-Ed Colleges</h1>
                    </a>
                    <span class="subType1">
                        <i class="fa fa-map-marker"></i> <a href="" title="">Kolkata</a>, <a href="" title="">West Bengal</a>, <a href="" title="">India</a>
                    </span>
                    <span class="subType2">
                        <i class="fas fa-university"></i> <a href="" title="list">Under Graduate</a>
                    </span>
                </div>
                <div class="col-md-2">
                    <?php if(SHOW_C_PAGE_HEADER_ADM_LINK==1) {?>
                    <a class="btn btn-danger btn-block p-2 pb-2 mt-4" href="">
                        <i class="fas fa-desktop"></i> <span class="faa-flash animated text-uppercase text-light">Admission <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?></span>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
					<?php include("google_ads_horizontal.php");?>
                </div>
                <?php include("college_page_social_share_button.php");?>
            </div>
        </div>
    </section>
    
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                	<div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert-info p-3" style="font-family:Rubik"><i class="fas fa-building"></i> List of Co-Ed Colleges</h4>
                        </div>
                    </div>
                	<div class="row">
                        <div class="col-md-12 mt-4">
                        	<div class="table-responsive">
                            	<table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="font-weight-bold bg-light">
                                            <td>#</td>
                                            <td>College Name</td>
                                            <td>Location</td>
                                        </tr>
                                    </thead>
                                    <tbody class="text-nowrap">
                                    <?php ?>
                                        <?php 
                                        $i=0;
                                        foreach($record as $rec){
                                        $i=$i+1;
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
                                                <a href="<?php echo BASE_URL;?>/<?php echo $rec["folderName"];?>/<?php echo $rec["fileName"];?>" title="<?php echo $rec["collegeName"];?>, <?php echo $rec["cityName"];?>"><?php echo $rec["collegeName"];?></a>
                                            </td>
                                            <td><?php echo $rec["cityName"];?>, <?php echo $rec["stateName"];?></td>
                                        </tr>
                                        <?php }?>
                                    <?php ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <?php include("admission_links_H.php");?>
                    
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                        	<?php include("google_ads_contextual.php");?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                	<?php include("right_panel.php");?>
                </div>
            </div>
        </div>
    </section>
    
	<?php include("footer.php");?>
    <?php include("footer_includes.php");?>
    
    <?php $dbConn =NULL; ?>
</body>
</html>