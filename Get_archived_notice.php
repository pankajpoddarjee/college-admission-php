<?php
include_once "connection.php";
include_once "configuration.php";

if (isset($_GET["year"])  && isset($_GET["type"]) && isset($_GET["college_id"]) && $_GET["type"] == 'college') {
    $output="";
    $statusarr = [];
    $year = $_GET["year"];
    $college_id  = $_GET["college_id"];
    $for  = isset($_GET["for"])??$_GET["for"];
    $is_active = 1;
    $sql = "";
    $sql .= "select * from notice_colleges WHERE college_id=:college_id AND notice_year=:year and is_active = :is_active";
    if(isset($for) && $for == 'merit_list'){
        $sql .= " AND notice_category='Merit List'";
    }
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":college_id", $college_id, PDO::PARAM_STR);
    $stmt->bindParam(":year", $year, PDO::PARAM_STR);
    $stmt->bindParam(":is_active", $is_active, PDO::PARAM_STR);
    $stmt->execute();

    $qryresult = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($qryresult) {
        foreach ($qryresult as  $record) {
            $custom_link = "";
            $target = "";
            if($record['notice_type'] == 'page'){
                $custom_link = BASE_URL."/".$record['slug'];
                $target = "_self";
            }
            if($record['notice_type'] == 'url'){
                $custom_link = $record['url_link']; 
                $target = "_blank";
            }
            // $output .= '<li>
            //                 <a target="'.$target.'" href="'. $custom_link.'" title="'.strtolower($record["notice_title"]).'">
            //                     <img src="'.BASE_URL.'/'.SITE_LOGO.'" alt="" class="float-start me-2 rounded-circle">'.$record["notice_title"];

            //                     if($record['is_new']==1){
            //                         $output .= '<span class="new_tag badge text-bg-danger fa-fade">New</span>';
            //                      }

            //                     $output .= '<br>
            //                     <span class="p_date">
            //                         <i class="fa-solid fa-calendar-days"></i> '. date("d M Y", strtotime($record["notice_date"])).'
            //                         </span>
            //                 </a>
            //             </li>';

                $output .= '<tr>
                                        <td>
                                            <a target="'.$target.'" href="'. $custom_link.'">
                                                <span class="publishDetails">
                                                    <i class="fa fa-calendar"></i>  '. date("d M Y", strtotime($record["notice_date"]));
                                        if($record["course_for"] != 'NA'){
                                            $output .= '| <i class="fa fa-graduation-cap"></i> '. $record["course_for"];
                                        }           
                                        $output .= '| <i class="fa fa-file-text-o"></i> '. $record["notice_category"].'
                                                </span>
												'.$record["notice_title"];
                                               
                                        if($record['is_new']==1){
                                            $output .= '<span class="new_tag badge text-bg-danger fa-fade">New</span>';
                                        }
                                                
                                    $output .= '</a>
                                        </td>
                                    </tr>';
        }
    } else {
        $output .= '<li> No Record Found </li>';
    }
    echo $output;
}

if (isset($_GET["year"])  && isset($_GET["type"]) && isset($_GET["university_id"]) && $_GET["type"] == 'university') {
    $output="";
    $statusarr = [];
    $year = $_GET["year"];
    $university_id  = $_GET["university_id"];
    $is_active = 1;
    $for  = isset($_GET["for"])??$_GET["for"];
    $sql = "select * from notice_universities WHERE university_id=:university_id AND notice_year=:year and is_active = :is_active";
    if(isset($for) && $for == 'merit_list'){
        $sql .= " AND notice_category='Merit List'";
    }
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":university_id", $university_id, PDO::PARAM_STR);
    $stmt->bindParam(":year", $year, PDO::PARAM_STR);
    $stmt->bindParam(":is_active", $is_active, PDO::PARAM_STR);
    $stmt->execute();

    $qryresult = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($qryresult) {
        foreach ($qryresult as  $record) {
            $custom_link = "";
            $target = "";
            if($record['notice_type'] == 'page'){
                $custom_link = BASE_URL."/".$record['slug'];
                $target = "_self";
            }
            if($record['notice_type'] == 'url'){
                $custom_link = $record['url_link']; 
                $target = "_blank";
            }
            // $output .= '<li>
            //                 <a target="'.$target.'" href="'. $custom_link.'" title="'.strtolower($record["notice_title"]).'">
            //                     <img src="'.BASE_URL.'/'.SITE_LOGO.'" alt="" class="float-start me-2 rounded-circle">'.$record["notice_title"];

            //                     if($record['is_new']==1){
            //                         $output .= '<span class="new_tag badge text-bg-danger fa-fade">New</span>';
            //                      }

            //                     $output .= '<br>
            //                     <span class="p_date">
            //                         <i class="fa-solid fa-calendar-days"></i> '. date("d M Y", strtotime($record["notice_date"])).'
            //                         </span>
            //                 </a>
            //             </li>';

            $output .= '<tr>
                                        <td>
                                            <a target="'.$target.'" href="'. $custom_link.'">
                                                <span class="publishDetails">
                                                    <i class="fa fa-calendar"></i>  '. date("d M Y", strtotime($record["notice_date"]));
                                        if($record["course_for"] != 'NA'){
                                            $output .= '| <i class="fa fa-graduation-cap"></i> '. $record["course_for"];
                                        }           
                                        $output .= '| <i class="fa fa-file-text-o"></i> '. $record["notice_category"].'
                                                </span>
												'.$record["notice_title"];
                                               
                                        if($record['is_new']==1){
                                            $output .= '<span class="new_tag badge text-bg-danger fa-fade">New</span>';
                                        }
                                                
                                    $output .= '</a>
                                        </td>
                                    </tr>';
        }
    } else {
        $output .= '<li> No Record Found </li>';
    }
    echo $output;
}