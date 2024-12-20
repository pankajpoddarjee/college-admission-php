<?php /*?><?php echo GOOGLE_AD_JS;?><?php */?>
<?php //include("modal.php");?>
<link href="<?php echo GOOGLE_FONT_1;?>" rel="stylesheet">
<link href="<?php echo FONT_AWESOME_CSS;?>" rel="stylesheet">
<script src="<?php echo BASE_URL;?>/bootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>/bootstrap/js/bootstrap.min.js"></script>
<link href="<?php echo BASE_URL;?>/bootstrap/css/font-awesome-animation.min.css" rel="stylesheet">
<link href="<?php echo BASE_URL;?>/bootstrap/css/table_style.css" rel="stylesheet">
<link href="<?php echo BASE_URL;?>/bootstrap/css/select2.min.css" rel="stylesheet">
<script src="<?php echo BASE_URL;?>/bootstrap/js/table_filter.js"></script>

<script src="https://kit.fontawesome.com/3b1cd5c4d8.js" crossorigin="anonymous"></script>

<link href="<?php echo BASE_URL;?>/bootstrap/toast/toastr.min.css" rel="stylesheet"/>
<script src="<?php echo BASE_URL;?>/bootstrap/toast/toastr.min.js"></script>
<?php include("report_problem.php");?>
<script src="<?php echo BASE_URL;?>/bootstrap/js/scrollreveal.min.js"></script>
<script src="<?php echo BASE_URL;?>/bootstrap/js/select2.min.js"></script>
<script>
const dropdownElementList = document.querySelectorAll('.dropdown-toggle')
const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl))
</script>

<script>
window.sr = ScrollReveal();		
sr.reveal('.social_icon_anime', {
		duration: 5000,
		origin: 'bottom',
		distance: '2000px',
		rotate: { x: 50, y: 0, z: 0 },
		mobile: true
	});
	sr.reveal('.info1', {
		duration: 1600,
		origin: 'top',
		distance: '80px',
		mobile: true
	});
	sr.reveal('.info2', {
		duration: 1600,
		origin: 'bottom',
		distance: '80px',
		mobile: true
	});
	sr.reveal('.welcomeUser', {
		duration: 2000,
		origin: 'bottom',
		distance: '200px',
		rotate: { x: 50, y: 0, z: 0 },
		mobile: true
	});
	sr.reveal('.page_headerIcon', {
		duration: 1000,
		origin: 'left',
		distance: '100px',
		rotate: { x: 50, y: 0, z: 0 },
		mobile: true
	});	
	sr.reveal('.share_icon_steps', {reset: true, mobile: false}, 150);
	sr.reveal('.steps_follow_animation', {reset: true, mobile: false}, 40);
	sr.reveal('.steps_follow_animation2', {reset: true, mobile: false}, 30);
</script>
<script>
    function recordAdClick(adId) {
        // Send an AJAX request to the PHP script to record the click using jQuery
        $.ajax({
            url: '<?php echo BASE_URL?>/Save_click.php', // The URL of the PHP script
            type: 'GET', // Method type
            data: { ad_id: adId }, // Data to send
            success: function(response) {
                console.log(response); // Show success message
            },
            error: function(xhr, status, error) {
                console.log("Error recording click: " + error); // Show error message
            }
        });
    }
</script>




<!--END CODE FOR POPUP -->