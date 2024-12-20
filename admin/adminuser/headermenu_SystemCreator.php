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
        <?php
            $leftMenuRecords = [];
            $strsql="select * from permission_master LEFT JOIN permissions ON permission_master.id = permissions.parent_id";
            $stmt = $dbConn->prepare($strsql);
            $stmt->execute();
            $leftMenuRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
           // echo "<pre>"; print_r($records);

            $groupedByParentId = [];

            foreach ($leftMenuRecords as $item) {
                $parentId = $item['parent_id'] ?? null; // Handle potential missing keys
                if (!isset($groupedByParentId[$parentId])) {
                    $groupedByParentId[$parentId] = [];
                }
                $groupedByParentId[$parentId][] = $item;
            }

            // Output the grouped array
            // echo '<pre>';
            // print_r($groupedByParentId);
        ?>

        <ul class="list-unstyled components">
            <?php if (isset($groupedByParentId)) { 
                foreach ($groupedByParentId as $parentId => $modules) { 
                    if (!empty($modules)) { ?>
                        <li>
                            <a href="#submenu-<?php echo $parentId; ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <?php echo  $modules[0]['master_icon']; ?>
                                <?php echo htmlspecialchars($modules[0]['master_module']); // Display the parent module name ?>
                            </a>
                            <ul class="collapse list-unstyled" id="submenu-<?php echo $parentId; ?>">
                                <?php foreach ($modules as $module) { 

                                    $user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";
                                    if (isset($user_id)) {
                                        // Split the comma-separated user_ids into an array
                                        $permission_array = explode(',', $module['user_ids']);
                                        
                                        // Check if the user_id exists in the array
                                        if (in_array($user_id, $permission_array)) { ?>
                                            <li>
                                                <a href="<?php echo htmlspecialchars($module['page_url']); ?>">
                                                    <?php echo  $module['icon']; ?>
                                                    <?php echo htmlspecialchars($module['module']); // Display the child module name ?>
                                                </a>
                                            </li>
                                    <?php    }
                                    }
                                    
                                    ?>
                                    


                                    <!-- <li>
                                        <a href="<?php echo htmlspecialchars($module['page_url']); ?>">
                                            <?php echo  $module['icon']; ?>
                                            <?php echo htmlspecialchars($module['module']); // Display the child module name ?>
                                        </a>
                                    </li> -->
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } 
                } 
            } ?>
        </ul>
       
    </nav>
	