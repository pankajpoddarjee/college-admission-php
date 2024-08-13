<?php include('../settings.php');?>
<?php include("../connection.php");include("../function.php");include("c_settings.php"); include ('../QRY_CAcollegeMainPage.php');
define("HIDE_NOTICE_BOARD","N");



?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo $college_name;?> - Courses Offered | <?php echo SITE_NAME;?></title>
<meta name="keywords" content="<?php echo $college_name;?> courses offered, subjects taught at <?php echo $college_name;?>">
<meta name="description" content="Courses Offered at <?php echo $college_name;?> <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Subjects Offered at <?php echo $college_name;?>">
<meta property="og:title" content="<?php echo $college_name;?> - Courses Offered | <?php echo SITE_NAME;?>">
<meta property="og:description" content="Courses Offered at <?php echo $college_name;?> <?php echo CURRENT_YEAR_DISPLAY_C_PAGE;?>, Subjects Offered at <?php echo $college_name;?>">
<meta property="og:image" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $banner_img;?>">
<meta property="og:url" content="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/courses.php">
<?php echo OTHER_META_TAGS;?>
<?php include("../head_includes.php");?>
</head>
<body>
	<?php include("../header.php");?>
    <?php include("../menu.php");?>
    
    <?php include("../college_page_header.php");?>
    <?php include("../college_page_menu.php");?>
    <style type="text/css">
	.active_courses{color:#FC0 !important;}
	</style>
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
					<?php include("../google_ads_horizontal.php");?>
                </div>
                <?php include("../college_page_social_share_button.php");?>
            </div>
        </div>
    </section>
    
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                    	<div class="col-md-12">
                            <h4 class="alert alert-info" title="<?php echo $college_name;?> Contact" style="font-family:Oswald"><i class="fa-solid fa-book"></i> Courses Offered</h4>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                    	<div class="col-md-12">                        	
                            <div id="accordion">
                              <div class="card">
                                <div class="card-header bg-secondary text-white" id="headingOne">
                                    <a class="btn btn-block btn-link text-left text-decoration-none" data-toggle="collapse" data-target="#collapseUG" aria-expanded="true" aria-controls="collapseUG" style="cursor:pointer">
                                      <h5 class="p-0 m-0" style="font-family:Rubik"><i class="fas fa-book"></i> Under Graduate (UG)</h5>
                                    </a>
                                </div>
                            
                                <div id="collapseUG" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                  <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="border-bottom p-2 text-danger" style="font-family:Rubik">- B.A. Honours <?php echo $college_id ?></h5>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <ul class="list-group">
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Bengali</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> English</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Hindi</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> History</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Journalism &amp; Mass Communication</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <ul class="list-group">
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Philosophy</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Political Science</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Sanskrit</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Sociology</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Communicative English</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="border-bottom p-2 text-danger" style="font-family:Rubik">- B.Sc. Honours</h5>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <ul class="list-group">
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Bio-Chemistry</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Botany</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Computer Science</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Economics</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Electronics</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Geography</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Geology</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Mathematics</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <ul class="list-group">
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Microbiology</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Physics</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Psychology</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Statistics</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Zoology</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Environmental Science</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Industrial Fish &amp; Fisheries</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="border-bottom p-2 text-danger" style="font-family:Rubik">- Management Subjects</h5>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <ul class="list-group">
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Bachelor of Business Administration (B.B.A.)</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="border-bottom p-2 text-danger" style="font-family:Rubik">- Vocational (B.Voc.) Subjects</h5>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <ul class="list-group">
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Fishery Science</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <ul class="list-group">
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Software Development</li>
                                            </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card">
                                <div class="card-header bg-secondary text-white mt-1" id="headingTwo">
                                  <h5 class="mb-0">
                                    <a class="btn btn-block btn-link text-left text-decoration-none collapsed" data-toggle="collapse" data-target="#collapsePG" aria-expanded="false" aria-controls="collapsePG" style="cursor:pointer">
                                      <h5 class="p-0 m-0" style="font-family:Rubik"><i class="fas fa-book"></i> Post Graduate (PG)</h5>
                                    </a>
                                  </h5>
                                </div>
                                <div id="collapsePG" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                  <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="border-bottom p-2 text-danger" style="font-family:Rubik">- M.A. Subjects</h5>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <ul class="list-group">
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Bengali</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="border-bottom p-2 text-danger" style="font-family:Rubik">- M.Sc. Subjects</h5>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <ul class="list-group">
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Computer Science</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Environmental Science</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Geography</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <ul class="list-group">
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Geology</li>
                                                <li class="list-group-item"><i class="fa fa-hand-o-right"></i> Zoology</li>
                                            </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card">
                                <div class="card-header bg-secondary text-white mt-1" id="headingThree">
                                  <h5 class="mb-0">
                                    <a class="btn btn-block btn-link text-left text-decoration-none collapsed" data-toggle="collapse" data-target="#collapseOtherCourses" aria-expanded="false" aria-controls="collapseOtherCourses" style="cursor:pointer">
                                      <h5 class="p-0 m-0" style="font-family:Rubik"><i class="fas fa-book"></i> Other Courses</h5>
                                    </a>
                                  </h5>
                                </div>
                                <div id="collapseOtherCourses" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                  <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="border-bottom p-2 text-danger" style="font-family:Rubik">- Post Graduate Distance Education Under Vidyasagar University</h5>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <p style="line-height:25px">
                                            	Asutosh College Post Graduate Study Centre aims at developing specialized skills needed for the overall growth of our society. The Centre offers various courses across humanities, science and management to generate advanced skills for Graduate candidates. The Post Graduate courses offered here allows the candidate to advance his/her skill and knowledge in his/her existing discipline or explore another industry. It also enables the candidate to build on his/her undergraduate knowledge, and gain the expertise one needs to drive his/her career forward.
                                                <br><br>
                                                The Post Graduate Study Centre at Asutosh College was established in 2012 under Vidyasagar University. The Study Centre offers M.Acourses in English, Political Science, Sanskrit and History; M.Sc. course in Environmental Science, Chemistry and M.Com Courses in Financial Accounting and Management, Cost Accounting. Theses course are offered in distance mode/learning.
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="border-bottom p-2 text-danger" style="font-family:Rubik">- Industrial Safety Engineering Course</h5>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <p style="line-height:25px">
                                            	This course is one of the most important courses to respond to the increasing demand for training personnel in Pollution Control and Industrial Safety. It has been rendering prolific results in the sense that the trained students emerging out of this course are continually making their marks in the industry giving out remarkable performances.
                                                <br><br>
                                                Diploma in Safety Engineering course now developed and renamed “Advanced Diploma in Industrial Safety" course, incorporating modified syllabus befitting 'National' if not 'International' standards.
                                                <br><br>
                                                The course, newly designed by the West Bengal State Council of Technical and Vocational Education &amp; Skill Development has been taken up with a view to rising to the occasion to prove that we are equal to the task any time, especially for any upgradation.
                                                <br><br>
                                                The course based on 'SHE' i.e., Safety Health and Environment Concept is of immense importance to the students in the present day context for getting a foothold in the industrial sector. It is for this, the same is administered with utmost care and attention. Our aim in view is to become an ideal centre for generations, as we firmly believe that process of improvement never ends.
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="border-bottom p-2 text-danger" style="font-family:Rubik">- Skill Development Programme</h5>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <p class="text-dark font-weight-bold"><i class="fa fa-hand-o-right"></i> Following Certificate Courses are offered :</p>
                                            <ul class="list-group">
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Basic Computer Course</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Career Counselling and Training Programme</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Soft Skills</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Herbal Plant Benefits and Scope</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Biomolecular Interactions in Clinical and Molecular Cell Biology</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Industrial Chemistry</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Wildlife Conservation</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> India: Geography, Resources and People</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Fundamentals of Psychology, Community Intervention and Life Style Management</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Latex</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Basic Electronics in Daily Life</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Bioinformatics and Computational Biology</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Apiculture and Sericulture</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Ornamental Fish Keeping and Basics of Aquaponic Farming</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Institutional Communication &amp; Public Speaking</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Social Entrepreneurship &amp; Social Work</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Travel and Tourism</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Human Rights</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Entrepreneurial Management</li>
                                            	<li class="list-group-item"><i class="fa fa-certificate"></i> Fundamentals of Mathematics and Statistics</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="border-bottom p-2 text-danger" style="font-family:Rubik">- Professional Course</h5>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <p class="text-dark font-weight-bold"><i class="fa fa-hand-o-right"></i> Training offered :</p>
                                            <ul class="list-group">
                                            	<li class="list-group-item"><i class="fa fa-book"></i> WBCS</li>
                                            	<li class="list-group-item"><i class="fa fa-book"></i> SSC/CTET</li>
                                            	<li class="list-group-item"><i class="fa fa-book"></i> NET &amp; SET (UGC &amp; CSIR)</li>
                                            	<li class="list-group-item"><i class="fa fa-book"></i> CAREER COUNSELLING</li>
                                            	<li class="list-group-item"><i class="fa fa-book"></i> COMBINED EXAMS (CLERKSHIP, STAFF SELECTION, RAILWAYS, BANK, MUNICIPAL SERVICES, POLICE SERGANT)</li>
                                            </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>                            
                        </div>
                    </div>
                    
                    <?php include("../college_page_admission_links_H.php");?>
                    
                    <div class="row d-none d-sm-block">
                        <div class="col-md-12">
                        	<?php include("../google_ads_contextual.php");?>
                        </div>
                    </div>                    
                </div>
                <div class="col-md-3">
                	<?php include("c_right_panel.php");?>
                </div>
            </div>
        </div>
    </section>
    
	<?php include("../footer.php");?>
    <?php include("../footer_includes.php");?>
    
    <?php $dbConn =NULL; ?>
</body>
</html>