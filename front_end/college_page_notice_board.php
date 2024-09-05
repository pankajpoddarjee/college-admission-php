<?php 

$notice_record = [];
if(isset($college_id)){ 
    $fetchallqry = "SELECT * FROM notices WHERE college_id=$college_id order by notice_date desc" ;
    $stmt = $dbConn->prepare($fetchallqry);
    $stmt->execute();
    $notice_record = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
?>

<section class="mt-3 mb-3">
    <div class="container-fluid p-0 m-0">
        <div class="row">
            <div class="col-md-12">
				<style type="text/css">
                .cPageAdmNotice_Height{min-height:180px; max-height:250px; overflow:auto; overflow-x: hidden;}
                .cPageAdmNotice {list-style-type:none; padding:0; margin:0; text-align:left; font-family:Rubik}
                .cPageAdmNotice li {padding:10px 3px 10px 5px; margin:0; border-bottom:1px dashed #e5e5e5; transition:250ms ease-in-out}
                .cPageAdmNotice a {text-decoration:none; color:#F66}
                .cPageAdmNotice a:hover {color:#cc0000}
                .cPageAdmNotice .title {display:block}
                .cPageAdmNotice li:hover {background:#f0f0f0}
                .cPageAdmNotice .publishDetails {color:#555; font-size:11px}
                </style>

                <div class="card">
                    <div class="card-header alert-info text-uppercase">
                        <i class="fas fa-clipboard-list"></i> College Notice Board <?php echo CURRENT_YEAR;?>
                    </div>
                    <div class="card-body border border-light p-0 cPageAdmNotice_Height">                        	
                        <ul class="cPageAdmNotice">
							<?php 
                                $i=0;
                              if(count($notice_record)>0){
                                    foreach ($notice_record as  $rec) { 
                                    $i=$i+1;

                                        $custom_link = "";
                                        $target = "";
                                        if($rec['notice_type'] == 'page'){
                                            $custom_link = BASE_URL."/".$rec['slug'];
                                            $target = "_self";
                                        }
                                        if($rec['notice_type'] == 'url'){
                                            $custom_link = $rec['url_link']; 
                                            $target = "_blank";
                                        }
                            ?>
                            <a  target="<?php echo $target; ?>" href="<?php echo $custom_link ?>" title="<?php echo $college_name;?> - <?php echo $rec["notice_title"];?>">
                                <li>
                                    <span class="title">
                                    <i class="fa fa-hand-o-right"></i> <?php echo $rec["notice_title"];?>                                    
									<?php if($rec["is_new"]==1) { ?>
										<sup><span class='badge badge-danger faa-flash faa-fast animated' style="background-color: blue;">New</span></sup>
									<?php }?>
                                    </span>
                                    
                                    <span class="publishDetails"><i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($rec['notice_date'])); ?></span>
                                </li>
                            </a>
							<?php } } ?>
                        </ul>
                    </div>
                    <div class="card-footer bg-light text-right">
                        <a href="<?php echo BASE_URL;?>/<?php echo $collegeSlug;?>/notice" title="Click here to view all updates." class="btn-link text-info" style="font-size:12px">
                            View all Notices <i class="fas fa-angle-double-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>