<!--https://webslidemenu.com/menudemo/webslide/slide-down-toggle-css/#-->
<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">-->

<link id="effect" rel="stylesheet" type="text/css" media="all" href="<?php echo BASE_URL;?>/menu/css/fade-down.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo BASE_URL;?>/menu/css/webslidemenu.css">
<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo BASE_URL;?>/menu/css/white-gry.css">

<!--Main Menu HTML Code-->
<div class="sticky-top">
    <nav class="wsmenu clearfix">
      <label for="wsmainlinks" class="wsdownopener" style="background:#399a39; color:#fff"><a href="<?php echo BASE_URL;?>/index.php" class="wshomeico active"><img src="<?php echo BASE_URL;?>/images/ca_logo.png" width="30" alt="logo" class="bg-white rounded"></a>&nbsp;&nbsp; Navigation Menu</label>
      <input type="checkbox" id="wsmainlinks" class="wsdexpander" />
      <ul class="wsmenu-list">
        <li aria-haspopup="true" class="d-none d-sm-none d-md-none d-lg-block"><a href="<?php echo BASE_URL;?>/index.php" class="wshomeico active"><img src="<?php echo BASE_URL;?>/images/ca_logo.png" width="30" alt="logo" class="bg-white rounded"><!--<span class="hometext">&nbsp;&nbsp;Home</span>--></a></li>
        <li aria-haspopup="true">
          <label for="wsmainlinks-1" class="wsdownopener-sub"></label>
          <a href="#"><i class="fas fa-book-reader"></i>Admission 2022<i class="wsdmdownic fas fa-angle-down"></i></a>
          <input type="checkbox" id="wsmainlinks-1" class="wsdexpander" />
          <ul class="sub-menu">
            <!--<li aria-haspopup="true"><a href="#">XXXX XXXX</a></li>-->
            <li aria-haspopup="true">
              <label for="wsmainlinks-1-1" class="wsdownopener-sub"></label>
              <a href="#">Admission Information for<i class="fas fa-angle-right"></i></a>
              <input type="checkbox" id="wsmainlinks-1-1" class="wsdexpander" />
              <ul class="sub-menu">
                <li aria-haspopup="true"><a href="#">Under Graduate (UG)</a></li>
                <li aria-haspopup="true"><a href="#">Bachelor of Education (B.Ed.)</a></li>
                <li aria-haspopup="true"><a href="#">Post Graduate (PG)</a></li>
                <li aria-haspopup="true"><a href="#">Post Graduate Diploma</a></li>
                <!-- NEXT SUB LEVEL
                <li aria-haspopup="true">
                  <label for="wsmainlinks-1-2" class="wsdownopener-sub"></label>
                  <a href="#">Submenu item 4<i class="fas fa-angle-right"></i></a>
                  <input type="checkbox" id="wsmainlinks-1-2" class="wsdexpander" />
                  <ul class="sub-menu">
                    <li aria-haspopup="true"><a href="#">Submenu item 1 Sub</a></li>
                    <li aria-haspopup="true"><a href="#">Submenu item 2 Sub</a></li>
                    <li aria-haspopup="true"><a href="#">Submenu item 3 Sub</a></li>
                    <li aria-haspopup="true"><a href="#">Submenu item 4 Sub</a></li>
                  </ul>
                </li>-->
              </ul>
            </li>
            <li aria-haspopup="true">
              <label for="wsmainlinks-2-2" class="wsdownopener-sub"></label>
              <a href="#">Apply Now for<i class="fas fa-angle-right"></i></a>
              <input type="checkbox" id="wsmainlinks-2-2" class="wsdexpander" />
              <ul class="sub-menu">
                <li aria-haspopup="true"><a href="#">Under Graduate (UG)</a></li>
                <li aria-haspopup="true"><a href="#">Bachelor of Education (B.Ed.)</a></li>
                <li aria-haspopup="true"><a href="#">Post Graduate (PG)</a></li>
                <li aria-haspopup="true"><a href="#">Post Graduate Diploma</a></li>
              </ul>
            </li>
            <li aria-haspopup="true">
              <label for="wsmainlinks-1-1" class="wsdownopener-sub"></label>
              <a href="#">Merit / Admission List for<i class="fas fa-angle-right"></i></a>
              <input type="checkbox" id="wsmainlinks-3-3" class="wsdexpander" />
              <ul class="sub-menu">
                <li aria-haspopup="true"><a href="#">Under Graduate (UG)</a></li>
                <li aria-haspopup="true"><a href="#">Bachelor of Education (B.Ed.)</a></li>
                <li aria-haspopup="true"><a href="#">Post Graduate (PG)</a></li>
                <li aria-haspopup="true"><a href="#">Post Graduate Diploma</a></li>
              </ul>
            </li>
            <!--<li aria-haspopup="true">
              <label for="wsmainlinks-1-1" class="wsdownopener-sub"></label>
              <a href="#">Open Source Development<i class="fas fa-angle-right"></i></a>
              <input type="checkbox" id="wsmainlinks-1-1" class="wsdexpander" />
              <ul class="sub-menu">
                <li aria-haspopup="true"><a href="#">Submenu item 1</a></li>
                <li aria-haspopup="true"><a href="#">Submenu item 2</a></li>
                <li aria-haspopup="true"><a href="#">Submenu item 3</a></li>
                <li aria-haspopup="true">
                  <label for="wsmainlinks-1-2" class="wsdownopener-sub"></label>
                  <a href="#">Submenu item 4<i class="fas fa-angle-right"></i></a>
                  <input type="checkbox" id="wsmainlinks-1-2" class="wsdexpander" />
                  <ul class="sub-menu">
                    <li aria-haspopup="true"><a href="#">Submenu item 1 Sub</a></li>
                    <li aria-haspopup="true"><a href="#">Submenu item 2 Sub</a></li>
                    <li aria-haspopup="true"><a href="#">Submenu item 3 Sub</a></li>
                    <li aria-haspopup="true"><a href="#">Submenu item 4 Sub</a></li>
                  </ul>
                </li>
              </ul>
            </li>-->
          </ul>
        </li>
        <li aria-haspopup="true">
          <label for="wsmainlinks-2" class="wsdownopener-sub"></label>
          <a href="#"><i class="fas fa-list-alt"></i>Half menu <i class="wsdmdownic fas fa-angle-down"></i></a>
          <input type="checkbox" id="wsmainlinks-2" class="wsdexpander" />
          <div class="wsmegamenu clearfix halfmenu">
            <div class="container-fluid">
              <div class="row">

                <ul class="col-lg-6 col-md-12 col-xs-12 link-list">
                  <li class="title">Product Header</li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                </ul>
                <ul class="col-lg-6 col-md-12 col-xs-12 link-list">
                  <li class="title">Product Header</li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                </ul>
              </div>

            </div>
          </div>
        </li>
        <li aria-haspopup="true">
          <label for="wsmainlinks-3" class="wsdownopener-sub"></label>
          <a href="#"><i class="fas fa-graduation-cap"></i>Colleges <i class="wsdmdownic fas fa-angle-down"></i></a>
          <input type="checkbox" id="wsmainlinks-3" class="wsdexpander" />
          <div class="wsmegamenu clearfix">
            <div class="container-fluid">
              <div class="row">

                <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
                  <li class="title">In XXXX</li>
                  <li><a href="<?php echo BASE_URL;?>/co-ed-colleges-in-kolkata" title=""><i class="fa fa-angle-right"></i>Co-Ed Colleges</a></li>
                  <li><a href="<?php echo BASE_URL;?>/colleges-in-kolkata" title=""><i class="fa fa-angle-right"></i>Colleges in Kolkata</a></li>
                  <li><a href="<?php echo BASE_URL;?>/colleges-in-west-bengal" title=""><i class="fa fa-angle-right"></i>Colleges in West Bengal</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                </ul>

                <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
                  <li class="title">In West Bengal</li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                </ul>

                <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
                  <li class="title">University Wise</li>
                  <li><a href="<?php echo BASE_URL;?>/universities-in-india" title=""><i class="fa fa-angle-right"></i>Universities in India</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                </ul>

                <div class="col-lg-3 col-md-12 col-xs-12">

                  <h3 class="title">Other Institutes</h3>
                  <div class="newadimg"><img src="" alt="" /> </div>
                </div>

              </div>
            </div>
          </div>
        </li>
        
        <li aria-haspopup="true">
          <label for="wsmainlinks-universities" class="wsdownopener-sub"></label>
          <a href="#"><i class="fa fa-university"></i>Universities <i class="wsdmdownic fas fa-angle-down"></i></a>
          <input type="checkbox" id="wsmainlinks-universities" class="wsdexpander" />
          <div class="wsmegamenu clearfix">
            <div class="container-fluid">
              <div class="row">

                <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
                  <li class="title">Central Universities</li>
                  <li><a href="<?php echo BASE_URL;?>/college_co_ed.php" title="list of co-educational (co-ed) colleges"><i class="fa fa-angle-right"></i>Co-Ed Colleges</a></li>
                  <li><a href="<?php echo BASE_URL;?>/CollegesInKolkata.php" title="list of colleges in kolkata"><i class="fa fa-angle-right"></i>Colleges in Kolkata</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                </ul>

                <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
                  <li class="title">State Universities</li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                </ul>

                <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
                  <li class="title">Deemed University</li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i>Submenu link style</a></li>
                </ul>

                <div class="col-lg-3 col-md-12 col-xs-12">

                  <h3 class="title">Private Universities</h3>
                  <div class="newadimg"><img src="" alt="" /> </div>
                </div>

              </div>
            </div>
          </div>
        </li>

        <li aria-haspopup="true">
          <label for="wsmainlinks-examinations" class="wsdownopener-sub"></label>
          <a href="#"><i class="fa fa-leanpub"></i>Exam <i class="wsdmdownic fas fa-angle-down"></i></a>
          <input type="checkbox" id="wsmainlinks-examinations" class="wsdexpander" />
          <div class="wsmegamenu clearfix">
            <div class="container-fluid">
              <div class="row">

                <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
                  <li class="title">Entrance Exam</li>
                  <li><a href="#" title="Birla Institute of Technology and Science Admission Test [BITSAT]"><i class="fa fa-angle-right"></i>BITSAT</a></li>
                  <li><a href="#" title="Graduate Aptitude Test in Engineering [GATE]"><i class="fa fa-angle-right"></i>GATE</a></li>
                  <li><a href="#" title="Joint Entrance Examination [JEE Advanced]"><i class="fa fa-angle-right"></i>JEE Advanced</a></li>
                  <li><a href="#" title="Joint Entrance Examination [JEE Main]"><i class="fa fa-angle-right"></i>JEE Main</a></li>
                  <li><a href="#" title="National Institute of Fashion Technology [NIFT]"><i class="fa fa-angle-right"></i>NIFT Entrance Exam</a></li>
                  <a href="<?php echo BASE_URL;?>/Exam/entrance_exam.php" title="list of entrance exams" class="btn btn-dark btn-sm btn-block">More Entrance Exams <i class="fa fa-angle-right"></i></a>
                </ul>

                <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
                  <li class="title">Competitive Exams</li>
                  <li><a href="#" title="Competitive Exams for Banks"><i class="fa fa-angle-right"></i>Bank</a></li>
                  <li><a href="#" title="Competitive Exams for Defense"><i class="fa fa-angle-right"></i>Defense</a></li>
                  <li><a href="#" title="Competitive Exams for Professional Schools"><i class="fa fa-angle-right"></i>Professional Schools</a></li>
                  <li><a href="#" title="Competitive Exams for SSC"><i class="fa fa-angle-right"></i>Staff Selection Commission</a></li>
                  <li><a href="#" title="Competitive Exams for UPSC"><i class="fa fa-angle-right"></i>Union Public Service Commission</a></li>
                  <a href="javascript:void(0)" title="list of competitive exams" class="btn btn-dark btn-sm btn-block">More Competitive Exams <i class="fa fa-angle-right"></i></a>
                </ul>

                <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
                  <li class="title">Medical Exams</li>
                  <li><a href="#" title="All India Institute of Medical Sciences [AIIMS]"><i class="fa fa-angle-right"></i>AIIMS</a></li>
                  <li><a href="#" title="All India Pre-Medical Test [AIPMT]"><i class="fa fa-angle-right"></i>AIPMT</a></li>
                  <li><a href="#" title="Common Entrance Test [CET]"><i class="fa fa-angle-right"></i>CET</a></li>
                  <li><a href="#" title="Consortium of Medical, Engineering and Dental Colleges of Karnataka [COMEDK]"><i class="fa fa-angle-right"></i>COMEDK</a></li>
                  <li><a href="#" title="Kerala Engineering Architecture Medical [KEAM]"><i class="fa fa-angle-right"></i>KEAM</a></li>
                  <a href="javascript:void(0)" title="list of medical exams" class="btn btn-dark btn-sm btn-block">More Medical Exams <i class="fa fa-angle-right"></i></a>
                </ul>

                <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
                  <li class="title">Other Exams</li>
                  <li><a href="#" title="list of engineering exams"><i class="fa fa-angle-right"></i>Engineering</a></li>
                  <li><a href="#" title="list of hotel management exams"><i class="fa fa-angle-right"></i>Hotel Management</a></li>
                  <li><a href="#" title="list of law exams"><i class="fa fa-angle-right"></i>Law</a></li>
                  <li><a href="#" title="list of mangement study exams"><i class="fa fa-angle-right"></i>Mangement Study</a></li>
                  <li><a href="#" title="list of all LIC / GIC exams"><i class="fa fa-angle-right"></i>L.I.C / G.I.C.</a></li>
                  <a href="javascript:void(0)" title="list of all exams" class="btn btn-dark btn-sm btn-block">More Exams <i class="fa fa-angle-right"></i></a>
                </ul>

              </div>
            </div>
          </div>
        </li>
        
        <li aria-haspopup="true">
          <label for="wsmainlinks-4" class="wsdownopener-sub"></label>
          <a href="#"><i class="fas fa-th-large"></i>Product images <i class="wsdmdownic fas fa-angle-down"></i></a>
          <input type="checkbox" id="wsmainlinks-4" class="wsdexpander" />
          <div class="wsmegamenu clearfix ">
            <div class="container">
              <div class="row">


                <div class="col-lg-4 col-md-12 col-xs-12">
                  <h3 class="title">Product Features</h3>
                  <div class="fluid-width-video-wrapper"><img src="" alt="" /> </div>
                  <p class="wsmwnutxt">Lorem Ipsum is dummy text of the printing specimen book. It has survived not
                    only five centuries, but also typesetting in the the contantly with desktoncluding.</p>
                </div>
                <div class="col-lg-4 col-md-12 col-xs-12">
                  <h3 class="title">Blog Article </h3>
                  <div class="fluid-width-video-wrapper"><img src="" alt="" /> </div>
                  <p class="wsmwnutxt">Lorem Ipsum is dummy text of the printing specimen book. It has survived not
                    only five centuries, but also typesetting in the the contantly with desktoncluding.</p>
                </div>
                <div class="col-lg-4 col-md-12 col-xs-12">
                  <h3 class="title">Highlight Your Services</h3>
                  <div class="fluid-width-video-wrapper"><a href="#"><img src="" alt="" /></a> </div>
                  <p class="wsmwnutxt">Lorem Ipsum is dummy text of the printing specimen book. It has survived not
                    only five centuries, but also typesetting in the the contantly with desktoncluding.</p>
                </div>

              </div>
            </div>
          </div>
        </li>
        <li aria-haspopup="true">
          <label for="wsmainlinks-5" class="wsdownopener-sub"></label>
          <a href="#"><i class="fas fa-paragraph"></i>Typography <i class="wsdmdownic fas fa-angle-down"></i></a>
          <input type="checkbox" id="wsmainlinks-5" class="wsdexpander" />
          <div class="wsmegamenu clearfix">
            <div class="typography-text clearfix">
              <div class="container-fluid">
                <div class="row">

                  <div class="col-lg-6 col-sm-12">
                    <h3 class="title">This is another title</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                      the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                      type and scrambled it to make a
                      type
                      specimen book. It has survived not only five centuries, but also the leap into electronic
                      typesetting, remaining essentially unchanged. It was popularised in the 1960s Ipsum more recently
                      with desktop publishing software like
                      Aldus
                      PageMaker including versions of Lorem Ipsum.</p>
                  </div>

                  <div class="col-lg-3 col-sm-12">
                    <h3 class="title">This is another title</h3>
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of
                      classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin
                      professor at Hampden-Sydney
                      College in
                      Virginia.
                    </p>
                  </div>

                  <div class="col-lg-3 col-sm-12">
                    <h3 class="title">This is another title</h3>
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of
                      classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin
                      professor at Hampden-Sydney
                      College in
                      Virginia.
                    </p>
                  </div>

                </div>

                <div class="row">
                  <div class="cl"></div>

                  <div class="col-lg-3 col-sm-12">
                    <h3 class="title">Other Services</h3>
                    <ul>
                      <li><a href="#"><i class="fab fa-wordpress"></i>Wordpress Development</a></li>
                      <li><a href="#"><i class="fab fa-drupal"></i>Drupal Development</a></li>
                      <li><a href="#"><i class="fas fa-shopping-cart"></i>Shoping Cart Development</a></li>
                    </ul>
                  </div>

                  <div class="col-lg-3 col-sm-12">
                    <h3 class="title">More Services</h3>
                    <ul>
                      <li><a href="#"><i class="fab fa-android"></i> Android App Development</a></li>
                      <li><a href="#"><i class="fab fa-apple"></i>iPhone App Development</a></li>
                      <li><a href="#"><i class="fab fa-windows"></i>Windows App Development</a></li>
                    </ul>
                  </div>

                  <div class="col-lg-3 col-sm-12">
                    <h3 class="title">Other Products</h3>
                    <ul>
                      <li><a href="#"><i class="fab fa-wordpress"></i>Wordpress Development</a></li>
                      <li><a href="#"><i class="fab fa-drupal"></i>Drupal Development</a></li>
                      <li><a href="#"><i class="fab fa-joomla"></i>Joomla Development</a></li>
                    </ul>
                  </div>

                  <div class="col-lg-3 col-sm-12">
                    <h3 class="title">More Services</h3>
                    <ul>
                      <li><a href="#"><i class="fab fa-android"></i> Android App Development</a></li>
                      <li><a href="#"><i class="fab fa-html5"></i>HTML5 App Development</a></li>
                      <li><a href="#"><i class="fab fa-paypal"></i>Paypal Store Integration</a></li>
                    </ul>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </li>
        <li aria-haspopup="true">
          <label for="wsmainlinks-6" class="wsdownopener-sub"></label>
          <a href="#"><i class="fas fa-th-list"></i>Grid system <i class="wsdmdownic fas fa-angle-down"></i></a>
          <input type="checkbox" id="wsmainlinks-6" class="wsdexpander" />
          <div class="wsmegamenu clearfix">
            <div class="container-fluid">
              <div class="row show-grid">

                <div class="col-lg-1 col-md-12">.col-md-1</div>
                <div class="col-lg-1 col-md-12">.col-md-1</div>
                <div class="col-lg-1 col-md-12">.col-md-1</div>
                <div class="col-lg-1 col-md-12">.col-md-1</div>
                <div class="col-lg-1 col-md-12">.col-md-1</div>
                <div class="col-lg-1 col-md-12">.col-md-1</div>
                <div class="col-lg-1 col-md-12">.col-md-1</div>
                <div class="col-lg-1 col-md-12">.col-md-1</div>
                <div class="col-lg-1 col-md-12">.col-md-1</div>
                <div class="col-lg-1 col-md-12">.col-md-1</div>
                <div class="col-lg-1 col-md-12">.col-md-1</div>
                <div class="col-lg-1 col-md-12">.col-md-1</div>

                <div class="col-lg-2 col-md-12">.col-md-2</div>
                <div class="col-lg-2 col-md-12">.col-md-2</div>
                <div class="col-lg-2 col-md-12">.col-md-2</div>
                <div class="col-lg-2 col-md-12">.col-md-2</div>
                <div class="col-lg-2 col-md-12">.col-md-2</div>
                <div class="col-lg-2 col-md-12">.col-md-2</div>

                <div class="col-lg-3 col-md-12">.col-md-3</div>
                <div class="col-lg-3 col-md-12">.col-md-3</div>
                <div class="col-lg-3 col-md-12">.col-md-3</div>
                <div class="col-lg-3 col-md-12">.col-md-3</div>

                <div class="col-lg-4 col-md-12">.col-md-4</div>
                <div class="col-lg-4 col-md-12">.col-md-4</div>
                <div class="col-lg-4 col-md-12">.col-md-4</div>

                <div class="col-lg-6 col-md-12">.col-md-6</div>
                <div class="col-lg-6 col-md-12">.col-md-6</div>

                <div class="col-lg-12 col-md-12">.col-md-12</div>

              </div>
            </div>

          </div>
        </li>
        <li aria-haspopup="true">
          <label for="wsmainlinks-7" class="wsdownopener-sub"></label>
          <a href="#"><i class="fas fa-paper-plane"></i>Contact Us <i class="wsdmdownic fas fa-angle-down"></i></a>
          <input type="checkbox" id="wsmainlinks-7" class="wsdexpander" />
          <div class="wsmegamenu halfdiv">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
                  <h3 class="title">Contact Form</h3>
                  <form name="contact_name" class="menu_form">
                    <input type="text" placeholder="Name">
                    <input type="text" placeholder="Email">
                    <textarea placeholder="Your message..."></textarea>
                    <input type="button" value="Reset">
                    <input type="submit" value="Send">

                  </form>
                  <div class="cl"></div>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </nav>
</div>