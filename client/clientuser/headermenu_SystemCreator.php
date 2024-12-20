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
            <li>
                <a href="ad_dashboard.php"><i class="fa fa-tachometer mr-2"></i>Ad Dashboard</a>
            </li> 

          
        </ul>
    </nav>
	