<?php
include("connection.php");
include("configuration.php");

if (isset($_GET['search_query'])) {
    $search_query = '%'. $_GET['search_query'] . '%'; // Prepare the query for LIKE clause
    $suggestions = [];

    // Query for suggestions
    //COLLEGE
    $stmt_colleges = $dbConn->prepare("SELECT college_name as name, short_name, logo_img as college_logo_img, slug, 'College' as type FROM colleges WHERE college_name LIKE :search_query OR short_name LIKE :search_short_name OR tags LIKE :tags");
    $stmt_colleges->bindParam(':search_query',$search_query);
    $stmt_colleges->bindParam(':search_short_name',$search_query);
    $stmt_colleges->bindParam(':tags',$search_query);
   // $stmt_colleges->bindValue(':search_query', $search_query, PDO::PARAM_STR);
    $stmt_colleges->execute();
    $suggestions = array_merge($suggestions, $stmt_colleges->fetchAll());
    
    //UNIVERSITY
    $stmt_universities = $dbConn->prepare("SELECT university_name as name,short_name, logo_img as university_logo_img, slug, 'University' as type FROM universities WHERE university_name LIKE :search_query OR short_name LIKE :search_short_name OR tags LIKE :tags");
    $stmt_universities->bindParam(':search_query',$search_query);
    $stmt_universities->bindParam(':search_short_name',$search_query);
    $stmt_universities->bindParam(':tags',$search_query);
    $stmt_universities->execute();
    $suggestions = array_merge($suggestions, $stmt_universities->fetchAll());

    //EXAM
    $stmt_exams = $dbConn->prepare("SELECT exam_name as name,short_name, logo_img as exam_logo_img, slug, 'Exam' as type FROM exams WHERE exam_name LIKE :search_query OR short_name LIKE :search_short_name OR tags LIKE :tags");
    $stmt_exams->bindParam(':search_query',$search_query);
    $stmt_exams->bindParam(':search_short_name',$search_query);
    $stmt_exams->bindParam(':tags',$search_query);
    $stmt_exams->execute();
    $suggestions = array_merge($suggestions, $stmt_exams->fetchAll());
    
    //STREAM
    $stmt_courses = $dbConn->prepare("SELECT stream_name as name, 'Courses' as type FROM streams WHERE stream_name LIKE :search_query ");
    $stmt_courses->execute(['search_query' => $search_query]);
    $suggestions = array_merge($suggestions, $stmt_courses->fetchAll());


    //NOTICE
    $stmt_notices = $dbConn->prepare("SELECT notices.notice_title as name,notices.slug, notices.url_link ,'Notice' as type, colleges.college_name As college_name , colleges.logo_img as college_logo_img, universities.university_name As university_name , universities.logo_img as university_logo_img,  exams.exam_name As exam_name FROM notices LEFT JOIN colleges ON notices.college_id = colleges.id LEFT JOIN universities ON notices.university_id = universities.id LEFT JOIN exams ON notices.exam_id = exams.id WHERE notices.notice_title LIKE :search_query OR notices.tags LIKE :tags");
    $stmt_notices->bindParam(':search_query',$search_query);
    $stmt_notices->bindParam(':tags',$search_query);    
    $stmt_notices->execute();
    $suggestions = array_merge($suggestions, $stmt_notices->fetchAll());

    //SLUG MASTER
    $stmt_master = $dbConn->prepare("SELECT title as name, slug, 'Listing' as type  FROM slug_master WHERE title LIKE :search_query ");
    $stmt_master->execute(['search_query' => $search_query]);
    $suggestions = array_merge($suggestions, $stmt_master->fetchAll());
    // echo "<pre>";
    // print_r($suggestions);

    $suggestions = sortArrayByKeywordMatch($suggestions, $_GET['search_query']);

    if (!empty($suggestions)) {
//echo "<pre>"; print_r($suggestions); die;
        echo "<ul class='site_Search' style='max-height:320px; overflow-y:scroll'>";
        foreach ($suggestions as $suggestion) {
            $slug = !empty($suggestion['slug'])?$suggestion['slug']:'';
            $type = !empty($suggestion['type'])?$suggestion['type']:'';
            $Notice_for ="";
            if(!empty($suggestion['college_name'])){
                $Notice_for = !empty($suggestion['college_name'])?$suggestion['college_name']:'';
            }
            if(!empty($suggestion['university_name'])){
                $Notice_for = !empty($suggestion['university_name'])?$suggestion['university_name']:'';
            }
            if(!empty($suggestion['exam_name'])){
                $Notice_for = !empty($suggestion['exam_name'])?$suggestion['exam_name']:'';
            }
            if(!empty($suggestion['college_logo_img']) || !empty($suggestion['university_logo_img']) || !empty($suggestion['exam_logo_img'])){

                if(!empty($suggestion['college_logo_img'])){
                    $logo_img = !empty($suggestion["college_logo_img"])?BASE_URL_UPLOADS."/college/logo_image/".$suggestion["college_logo_img"]:BASE_URL."/images/no-logo.jpg";
                }
                if(!empty($suggestion['university_logo_img'])){
                    $logo_img = !empty($suggestion["university_logo_img"])?BASE_URL_UPLOADS."/university/logo_image/".$suggestion["university_logo_img"]:BASE_URL."/images/no-logo.jpg";
                }
                if(!empty($suggestion['exam_logo_img'])){
                    $logo_img = !empty($suggestion["exam_logo_img"])?BASE_URL_UPLOADS."/exam/logo_image/".$suggestion["exam_logo_img"]:BASE_URL."/images/no-logo.jpg";
                }


            }else{
               
                $logo_img = !empty($suggestion["logo_img"])?BASE_URL_UPLOADS."/college/logo_image/".$suggestion["logo_img"]:BASE_URL.'/'.SITE_LOGO;
                
            }
            if(!empty($suggestion["url_link"]) && isset($suggestion["url_link"]) && $suggestion["url_link"]!=""){
                $slug_link = '<a target="_blank" href="'.$suggestion["url_link"].'">';
            }else{
                $slug_link = '<a href="'.BASE_URL.'/'.$slug.'">';
            }
            
            $short_name = !empty($suggestion['short_name'])?"[".$suggestion['short_name']."]":'';
            
            echo '<li><div class="suggestion-item bg-light bg-opacity-75">'.$slug_link.''.'<img src="'.$logo_img.'" width="35" height="35" class="me-2 rounded-circle">'. $Notice_for .' '. htmlspecialchars($suggestion['name']) . ' ' . $short_name . '</a><span class="list_type float-end mt-2 text-secondary text-capitalize">'.$type.'</span></div></li>';
        }
        echo "</ul>";

    } else {

        echo '<ul class="site_Search"><li><div class="suggestion-item bg-light bg-opacity-75">Record Not Found</div></li></ul>';

    }

}

function sortArrayByKeywordMatch($array, $keyword) {
    // Custom comparison function
    usort($array, function($a, $b) use ($keyword) {
        $keyword = strtolower($keyword);
        
        // Compare by the number of occurrences of the keyword in the name
        $scoreA = substr_count(strtolower($a['name']), $keyword);
        $scoreB = substr_count(strtolower($b['name']), $keyword);
        
        // Sort by the number of occurrences (more is better)
        if ($scoreA === $scoreB) {
            // If scores are equal, you can sort by name alphabetically or any other criteria
            return strcmp($a['name'], $b['name']);
        }
        return $scoreB - $scoreA;
    });

    return $array;
}

?>

<style>
    .site_Search {list-style-type:none; padding:0; margin:0}
    .site_Search li {border-bottom:1px dashed #c9c9c9}
    .site_Search li .suggestion-item {padding:7px; font-family:Viga !important; font-size:15px}
    .site_Search li .suggestion-item .list_type {font-family:Nunito !important; font-size:15px}
</style>