<?php
include("connection.php");
include("configuration.php");
if (isset($_POST['fromDate']) && isset($_POST['toDate']) && isset($_POST['table'])) {
    $table = $_POST['table'];
    $id = $_POST['id'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $suggestions = [];
    $collegeResult =[];
    $universityResult =[];
    $examResult =[];
    $is_active = 1;

    // SQL query to search data between the date range

    if($table == 'notice_colleges'){

        $qry = "SELECT notice_colleges.notice_title as name,notice_colleges.slug, notice_colleges.url_link, notice_colleges.notice_date, notice_colleges.is_new ,'College Notice' as type, colleges.college_name As college_name , colleges.logo_img as college_logo_img FROM notice_colleges LEFT JOIN colleges ON notice_colleges.college_id = colleges.id WHERE  notice_colleges.is_active= :is_active  AND notice_colleges.notice_date BETWEEN '$fromDate' AND '$toDate'";
        if($id != 'all'){
          $qry .= ' AND notice_colleges.college_id= :id ';
        }
        $stmt_notices_college = $dbConn->prepare($qry);
        $stmt_notices_college->bindParam(':is_active',$is_active);   
        if($id != 'all'){
          $stmt_notices_college->bindParam(':id',$id); 
        }
        
        $stmt_notices_college->execute();
        $collegeResult = $stmt_notices_college->fetchAll(PDO::FETCH_ASSOC);
        $suggestions = array_merge($suggestions, $collegeResult);
    }
    if($table == 'notice_universities'){

        $qry = "SELECT notice_universities.notice_title as name,notice_universities.slug, notice_universities.url_link, notice_universities.notice_date, notice_universities.is_new ,'University Notice' as type,  universities.university_name As university_name , universities.logo_img as university_logo_img FROM notice_universities  LEFT JOIN universities ON notice_universities.university_id = universities.id  WHERE notice_universities.is_active= :is_active  AND notice_universities.notice_date BETWEEN '$fromDate' AND '$toDate'";

        if($id != 'all'){
          $qry .= ' AND notice_universities.university_id= :id ';
        }

        $stmt_notices_university = $dbConn->prepare($qry);
        $stmt_notices_university->bindParam(':is_active',$is_active); 
        if($id != 'all'){
          $stmt_notices_university->bindParam(':id',$id); 
        } 
        $stmt_notices_university->execute();
        $universityResult = $stmt_notices_university->fetchAll(PDO::FETCH_ASSOC);
        $suggestions = array_merge($suggestions, $universityResult);
    }
    if($table == 'notice_exams'){
        $qry = "SELECT notice_exams.notice_title as name,notice_exams.slug, notice_exams.url_link , notice_exams.notice_date,notice_exams.is_new, 'Exam Notice' as type, exams.exam_name As exam_name, exams.logo_img as exam_logo_img FROM notice_exams  LEFT JOIN exams ON notice_exams.exam_id = exams.id WHERE  notice_exams.is_active= :is_active  AND notice_exams.notice_date BETWEEN '$fromDate' AND '$toDate'";
        if($id != 'all'){
          $qry .= ' AND notice_exams.exam_id= :id ';
        }
        $stmt_notices_exam = $dbConn->prepare($qry);
        $stmt_notices_exam->bindParam(':is_active',$is_active); 
        if($id != 'all'){
          $stmt_notices_exam->bindParam(':id',$id); 
        } 
        $stmt_notices_exam->execute();
        $examResult = $stmt_notices_exam->fetchAll(PDO::FETCH_ASSOC);
        $suggestions = array_merge($suggestions, $examResult);
    }

    // Shuffle the array
    shuffle($suggestions);
    // Sort the array by 'notice_date'
    usort($suggestions, function($a, $b) {
    return strtotime($b['notice_date']) - strtotime($a['notice_date']);
    });
   

    // $query = "SELECT * FROM your_table WHERE notice_date BETWEEN '$fromDate' AND '$toDate'";
    // $result = $conn->query($query);

    if (count($suggestions) > 0) {
        echo "<ul class='LatestUpdates'>";
        // while ($row = $result->fetch_assoc()) {
        //     echo "<tr><td>" . $row['id'] . "</td><td>" . $row['date_column'] . "</td><td>" . $row['data_column'] . "</td></tr>";
        // }
        $html = '';
        foreach ($suggestions as $value) {
            $from = "";
            $link = "";
            if(isset($value['college_name'])){
              $from = $value['college_name'];
            }
            if(isset($value['exam_name'])){
              $from = $value['exam_name'];
            }
            if(isset($value['university_name'])){
              $from = $value['university_name'];
            }
            if(isset($value['url_link']) && $value['url_link'] !=''){
              $link = $value['url_link'];
            }else{
              $link = BASE_URL.'/'.$value['slug'];
            }
            $notice_date = isset($value["notice_date"])?date('d M Y', strtotime($value['notice_date'])):"";
            $name = isset($value['name'])?$value['name']:"";
            $newTag = '';
            if($value['is_new'] == 1){
                $newTag = '<span class="new_tag badge text-bg-danger fa-fade">New</span>';  
            }
            $html .= '<li>
                    <span class="PDate">'.$notice_date.' -</span><span class="instituteName">'.$from.'</span>'.$newTag.' <br>
                    <a target="_blank" href="'.$link.'">'.$name.'</a>
                </li>';
            
        }
        $html .= '</ul>';
        echo $html;
    } else {
        echo "<ul><li>No results found for the selected date range.</li></ul>";
    }
}
?>