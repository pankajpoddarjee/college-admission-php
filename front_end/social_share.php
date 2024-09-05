<style>
    .social_buttons a {text-decoration:none; font-size:18px; color:#666; margin-right:5px}
    .social_buttons .whatsapp {color:#25D366}
    .social_buttons .facebook {color:#316FF6}
    .social_buttons .twitterX {color:#14171A }
    .social_buttons .linkedin {color:#0077B5 }
</style>
<div class="social_buttons">
    <?php 
    //print_r($records);
    $shareTitle = ($records['notice_title'])?$records['notice_title']:'';
    $postLink = BASE_URL.'/'.$records['slug'];
    $notice_name =  "";
    if($records['notice_for'] == 1){
        $notice_name = !empty($college_name)?$college_name:"";
    } 
    if($records['notice_for'] == 2){
        $notice_name = !empty($university_name)?$university_name:"";
    } 
    if($records['notice_for'] == 3){
        $notice_name = !empty($exam_name)?$exam_name:"";
    } 

    // Encode the message for the URL
    $message = urlencode($notice_name.' - '.$shareTitle . "\nLink: " . $postLink);

    // Create the WhatsApp share URL
    $whatsappUrl = "https://api.whatsapp.com/send?text=" . $message;
    ?>
    <!-- Whatsapp -->
    <a class="whatsapp share_icon_steps" href="<?php echo $whatsappUrl;?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>

    <!-- Facebook -->
    <a class="facebook share_icon_steps" href="https://www.facebook.com/sharer.php?u=<?php echo $postLink; ?>" title="Share on Facebook" target="_blank"><i class="fa-brands fa-facebook"></i></a>
    
    <!-- Twitter -->
    <a class="twitterX share_icon_steps" href="http://twitter.com/share?url=<?php echo $postLink; ?>&text=<?php echo $shareTitle; ?>" title="Share on Twitter" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>

    <!-- LinkedIn -->
    <a class="linkedin share_icon_steps" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $postLink; ?>" title="Share on LinkedIn" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>

    <!-- Email -->   
    <a class="share_icon_steps" href="mailto:?Subject=<?php echo $shareTitle; ?> | <?php echo SITE_NAME; ?>&Body=<?php echo $college_name; ?> - <?php echo $shareTitle; ?><?php echo urlencode("\n");?>Link: <?php echo $postLink; ?><?php echo urlencode("\n\n");?>From<?php echo urlencode("\n");?><?php echo SITE_NAME; ?><?php echo urlencode("\n");?><?php echo SITE_URL; ?>   " title="Email Page Detail"><i class="fa-regular fa-envelope"></i></a>
</div>