<nav id="sidebar">
        <div class="sidebar-header p-2">
        	<a class="text-light text-decoration-none" href="javascript:void(0)">
                <div class="row p-0 m-0">
                	<div class="col-2 text-center p-0 ml-1">
						<i class="fa fa-user ml-2 mr-2 text-secondary" style="font-size:34px"></i>
                    </div>
                    <div class="col-9 p-0 m-0">
                        <span class="ml-1"><?php ?><?php echo !empty($adminusername)?ucwords($adminusername):""; ?><?php ?></span>
                        <small class=" align-text-top text-light ml-1 d-block"><?php echo !empty($designation)?ucwords($designation):""; ?></small>
                    </div>
                </div>
            </a>
        </div>

        <ul class="list-unstyled components">
            <!--<p class="pt-0 pb-0"><i class="fa fa-spinner faa-spin animated mr-2"></i>Application Process</p>-->
            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer mr-2"></i>Dashboard</a>
            </li> 
           <?php  if( $_SESSION['usertype'] != 2){  ?>
            <li>
                <a href="#masterSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-database mr-2"></i>System Masters</a>
                <ul class="collapse list-unstyled" id="masterSubmenu">                    
                    <li>
                        <a href="master_college_type.php"><i class="fa fa-angle-right mr-2"></i>College Type Master</a>
                    </li>
                    <li>
                        <a href="master_university_type.php"><i class="fa fa-angle-right mr-2"></i>University Type Master</a>
                    </li>
                    <li>
                        <a href="master_undertaking.php"><i class="fa fa-angle-right mr-2"></i>Undertaking Master</a>
                    </li>
                    <li>
                        <a href="master_country.php"><i class="fa fa-angle-right mr-2"></i>Country Master</a>
                    </li>
                    <li>
                        <a href="master_state.php"><i class="fa fa-angle-right mr-2"></i>State Master</a>
                    </li>
                    <li>
                        <a href="master_district.php"><i class="fa fa-angle-right mr-2"></i>District Master</a>
                    </li>
                    <li>
                        <a href="master_city.php"><i class="fa fa-angle-right mr-2"></i>City Master</a>
                    </li>
                    <li>
                        <a href="master_course_type.php"><i class="fa fa-angle-right mr-2"></i>Course Type Master</a>
                    </li>
                    <li>
                        <a href="master_stream.php"><i class="fa fa-angle-right mr-2"></i>Stream Master</a>
                    </li>
                    <li>
                        <a href="master_subject.php"><i class="fa fa-angle-right mr-2"></i>Subject Master</a>
                    </li>
                    <li>
                        <a href="master_exam_level.php"><i class="fa fa-angle-right mr-2"></i>Exam Level Master</a>
                    </li>
                    <li>
                        <a href="master_exam_type.php"><i class="fa fa-angle-right mr-2"></i>Exam Type Master</a>
                    </li>
                    <li>
                        <a href="master_exam_category.php"><i class="fa fa-angle-right mr-2"></i>Exam Category Master</a>
                    </li>                   
                    <li>
                        <a href="master_slug.php"><i class="fa fa-angle-right mr-2"></i>Slug Master</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <li>
                <a href="#collegeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa-solid fa-graduation-cap mr-2"></i>College Master</a>
                <ul class="collapse list-unstyled" id="collegeSubmenu">
                    <li>
                        <a href="master_college.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify College</a>
                    </li>
                    <li>
                        <a href="assign_courses.php"><i class="fa fa-angle-right mr-2"></i>Assign College Courses</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#universitySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa-solid fa-building-columns mr-2"></i>University Master</a>
                <ul class="collapse list-unstyled" id="universitySubmenu">
                    <li>
                        <a href="master_university.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify University</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#examSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa-solid fa-building-columns mr-2"></i>Exam Master</a>
                <ul class="collapse list-unstyled" id="examSubmenu">
                    <li>
                        <a href="master_exam.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify Exam</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#noticeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa-solid fa-file-pen mr-2"></i>Publication</a>
                <ul class="collapse list-unstyled" id="noticeSubmenu">
                    <li>
                        <a href="master_notice.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify Notice</a>
                    </li>
                    <li>
                        <a href="master_notice_college.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify College Notice</a>
                    </li>
                    <li>
                        <a href="master_notice_university.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify University Notice</a>
                    </li>

                    <li>
                        <a href="master_notice_exam.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify Exam Notice</a>
                    </li>
                    
                </ul>
            </li>

            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa-solid fa-building-columns mr-2"></i>Page Master</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="master_college_page.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify College Page</a>
                    </li>
                    <li>
                        <a href="master_universitye_page.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify University Page</a>
                    </li>
                    <li>
                        <a href="master_exam_page.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify Exam Page</a>
                    </li>
                </ul>
            </li>
            

            <!-- <li>
                <a href="#adSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa-solid fa-building-columns mr-2"></i>Ad Master</a>
                <ul class="collapse list-unstyled" id="adSubmenu">
                    <li>
                        <a href="master_ad.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify Ad</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#clientSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa-solid fa-building-columns mr-2"></i>Client Master</a>
                <ul class="collapse list-unstyled" id="clientSubmenu">
                    <li>
                        <a href="master_client.php"><i class="fa fa-angle-right mr-2"></i>Add / Modify Client</a>
                    </li>
                </ul>
            </li> -->

            <li>
                <a href="report_problem.php"><i class="fa-solid fa-bug mr-2"></i>Bug Reporting</a>
            </li>
        </ul>
    </nav>
	