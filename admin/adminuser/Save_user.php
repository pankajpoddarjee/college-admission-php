<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";



if (isset($_GET["eid"])) {
    $record_id = $_GET["eid"];

    $sql = "select * from users_admin WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
    $stmt->execute();

    $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($qryresult) {
        $statusarr["status"] = 1;
        $statusarr["record"] = $qryresult;
    } else {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "There is some problem with the data. Please Try again";
    }
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}

if (isset($_GET["statusid"])) {
    $id = $_GET["statusid"];
    $status = $_GET["status"];
    if ($status == 1) {
        $newStatus = 0;
    } else {
        $newStatus = 1;
    }

    $sql = "UPDATE users_admin SET is_active = :is_active WHERE id = :id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":is_active", $newStatus, PDO::PARAM_INT);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    //$stmt->execute();

    if ($stmt->execute()) {
        $statusarr["status"] = 1;
        $statusarr["msg"] = "Record updated successfully";
    } else {
        $statusarr["status"] = 0;
        $statusarr["msg"] =
            "There is some problem with the data. Please Try again";
    }
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}


//print_r($_POST); die;
$statusarr = [];
$action = sanitize_string($_POST["action"]);
$record_id = sanitize_string($_POST["record_id"]);

$usertype = sanitize_string($_POST["usertype"]);
$name = sanitize_string($_POST["name"]);
$email = sanitize_string($_POST["email"]);
$password = sanitize_string($_POST["password"]);
$mobile = sanitize_string($_POST["mobile"]);
$designation = sanitize_string($_POST["designation"]);

$user_img = "";
$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";



//print_r($_FILES);

if ($action == "edit" && !empty($record_id) && isset($record_id)) {

    $existQuery = $dbConn->prepare(
        "select * from users_admin WHERE email=:email and id!=:id"
    );
    $existQuery->bindParam(":email", $email, PDO::PARAM_STR);    
    $existQuery->bindParam(":id", $record_id, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This user already exist";
        echo json_encode($statusarr);
        return;
    } else {   
   
        $sql = "select * from users_admin WHERE id=:id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
        $stmt->execute();

        $userRec = $stmt->fetch(PDO::FETCH_ASSOC);

        

        $user_img = $userRec['user_img'];
        if(isset($_FILES['user_img']['name']) && !empty($_FILES['user_img']['name'])){

            $errors = validateAdImage($_FILES['user_img']);
            
            if (empty($errors)) {
                $ext = pathinfo($_FILES['user_img']['name'], PATHINFO_EXTENSION);
                //$uniqueSlug = generateSlug($college_name);
                $tmpFilePath = $_FILES['user_img']['tmp_name'];
                //$notice_file_name = "notice-".$id.'.'.$ext;
            
                if($userRec && !empty($userRec['user_img']) && isset($userRec['user_img']) && $userRec['user_img'] !=''){
            
                    $upload_path = BASE_URL_UPLOADS."/user/".$user_img;
            
                    if (file_exists($upload_path)) {
                        unlink($upload_path);
                    }
                    
                }
            
                $upload_path = '../../uploads/user/';    
              
                $ad_file_name =  $record_id.'-user.'.$ext;
            
                $newFilePath = $upload_path.$ad_file_name;
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                   $user_img = $ad_file_name;
                } 
            } else {
            
                $statusarr["status"] = 0;
                $statusarr["msg"] = implode($errors);
                echo json_encode($statusarr);
                return;
            }
            
              
            }
        
            $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $userRec['password'];
        $sql = 
            "UPDATE users_admin SET usertype = :usertype, name = :name , user_img = :user_img, email = :email,password = :password,mobile = :mobile,designation = :designation,updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":usertype", $usertype, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":user_img", $user_img, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":mobile", $mobile, PDO::PARAM_STR);
        $stmt->bindParam(":designation", $designation, PDO::PARAM_STR);
        $stmt->bindParam(":updated_at", $updated_at, PDO::PARAM_STR);
        $stmt->bindParam(":updated_by", $updated_by, PDO::PARAM_STR);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
        // $stmt->execute();

        if ($stmt->execute()) {
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Record updated successfully  ";
            echo json_encode($statusarr);
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
            echo json_encode($statusarr);
        }
    }
    $dbConn= NULL;
} else {
    $existQuery = $dbConn->prepare(
        "select * from users_admin WHERE email=:email"
    );
    $existQuery->bindParam(":email", $email, PDO::PARAM_STR);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This User already exist";
        echo json_encode($statusarr);
        return;
    } else {

        
            $is_active = 1;
            $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT):'';
            $sql =
                "INSERT INTO users_admin (usertype,name,email,password,mobile,designation, created_at, created_by, is_active) VALUES (:usertype,:name,:email,:password,:mobile,:designation,:created_at,:created_by, :is_active)";
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(":usertype", $usertype, PDO::PARAM_STR);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":mobile", $mobile, PDO::PARAM_STR);
            $stmt->bindParam(":designation", $designation, PDO::PARAM_STR);
            $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
            $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
            $stmt->bindParam(":is_active", $is_active, PDO::PARAM_INT);
        
            if ($stmt->execute()) {
                $id = $dbConn->lastInsertId();

                if(isset($_FILES['user_img']['name']) && !empty($_FILES['user_img']['name'])){

                    $errors = validateAdImage($_FILES['user_img']);

                    

                    if (empty($errors)) {
                        $ext = pathinfo($_FILES['user_img']['name'], PATHINFO_EXTENSION);
                        //$uniqueSlug = generateSlug($college_name);
                        $tmpFilePath = $_FILES['user_img']['tmp_name'];
                        //$notice_file_name = "notice-".$id.'.'.$ext;


                            $upload_path = '../../uploads/user/';
                                            
                            //$upload_path = '../../uploads/notices/college/'.$college_name.'/';
                            $ad_file_name =  $id.'-user.'.$ext;

                        $newFilePath = $upload_path.$ad_file_name;
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $user_img = $ad_file_name;
                        } 
                    } else {
                        $statusarr["status"] = 0;
                        $statusarr["msg"] = implode($errors);
                        echo json_encode($statusarr);
                        return;
                    }
                }           
                
                $sql = "UPDATE users_admin SET  user_img = :user_img WHERE id = :id";           
                $stmt = $dbConn->prepare($sql);
                $stmt->bindParam(":user_img", $user_img, PDO::PARAM_STR);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();


                $statusarr["status"] = 1;
                $statusarr["msg"] = "Data inserted successfully";
                echo json_encode($statusarr);
                return;
            } else {
                $statusarr["status"] = 0;
                $statusarr["msg"] =
                    "There is some problem with the data. Please Try again";
                echo json_encode($statusarr);
                return;
            }
    }
    $dbConn= NULL;
}




?>
