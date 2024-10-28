<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";



if (isset($_GET["eid"])) {
    $record_id = $_GET["eid"];

    $sql = "select * from clients WHERE id=:id";
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

    $sql = "UPDATE clients SET is_active = :is_active WHERE id = :id";
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
$client_name = sanitize_string($_POST["client_name"]);
$company_name = sanitize_string($_POST["company_name"]);
$email = sanitize_string($_POST["email"]);
$password = sanitize_string($_POST["password"]);
$address = sanitize_string($_POST["address"]);
$business = sanitize_string($_POST["business"]);

$company_logo = "";
$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";



//print_r($_FILES);

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
   
        $sql = "select * from clients WHERE id=:id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
        $stmt->execute();

        $clientRec = $stmt->fetch(PDO::FETCH_ASSOC);

        

        $company_logo = $clientRec['company_logo'];
        if(isset($_FILES['company_logo']['name']) && !empty($_FILES['company_logo']['name'])){

            $errors = validateAdImage($_FILES['company_logo']);
            
            if (empty($errors)) {
                $ext = pathinfo($_FILES['company_logo']['name'], PATHINFO_EXTENSION);
                //$uniqueSlug = generateSlug($college_name);
                $tmpFilePath = $_FILES['company_logo']['tmp_name'];
                //$notice_file_name = "notice-".$id.'.'.$ext;
            
                if($clientRec && !empty($clientRec['company_logo']) && isset($clientRec['company_logo']) && $clientRec['company_logo'] !=''){
            
                    $upload_path = BASE_URL_UPLOADS."/client/".$company_logo;
            
                    if (file_exists($upload_path)) {
                        unlink($upload_path);
                    }
                    
                }
            
                $upload_path = '../../uploads/client/';    
              
                $ad_file_name =  $record_id.'-client.'.$ext;
            
                $newFilePath = $upload_path.$ad_file_name;
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                   $company_logo = $ad_file_name;
                } 
            } else {
            
                $statusarr["status"] = 0;
                $statusarr["msg"] = implode($errors);
                echo json_encode($statusarr);
                return;
            }
            
              
            }
        
            $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $clientRec['password'];
        $sql = 
            "UPDATE clients SET client_name = :client_name, company_name = :company_name , company_logo = :company_logo, email = :email,password = :password,address = :address,business = :business,updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":client_name", $client_name, PDO::PARAM_STR);
        $stmt->bindParam(":company_name", $company_name, PDO::PARAM_INT);
        $stmt->bindParam(":company_logo", $company_logo, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":business", $business, PDO::PARAM_STR);
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
    
    $dbConn= NULL;
} else {
        
        $is_active = 1;
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT):'';
        $sql =
            "INSERT INTO clients (client_name,company_name,email,password,address,business, created_at, created_by, is_active) VALUES (:client_name,:company_name,:email,:password,:address,:business,:created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":client_name", $client_name, PDO::PARAM_STR);
        $stmt->bindParam(":company_name", $company_name, PDO::PARAM_INT);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":business", $business, PDO::PARAM_STR);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $is_active, PDO::PARAM_INT);
      
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();

            if(isset($_FILES['company_logo']['name']) && !empty($_FILES['company_logo']['name'])){

                $errors = validateAdImage($_FILES['company_logo']);

                

                if (empty($errors)) {
                    $ext = pathinfo($_FILES['company_logo']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($college_name);
                    $tmpFilePath = $_FILES['company_logo']['tmp_name'];
                    //$notice_file_name = "notice-".$id.'.'.$ext;


                        $upload_path = '../../uploads/client/';
                                           
                        //$upload_path = '../../uploads/notices/college/'.$college_name.'/';
                        $ad_file_name =  $id.'-client.'.$ext;

					$newFilePath = $upload_path.$ad_file_name;
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                       $company_logo = $ad_file_name;
                    } 
                } else {
                    $statusarr["status"] = 0;
                    $statusarr["msg"] = implode($errors);
                    echo json_encode($statusarr);
                    return;
                }
            }           
            
            $sql = "UPDATE clients SET  company_logo = :company_logo WHERE id = :id";           
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(":company_logo", $company_logo, PDO::PARAM_STR);
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
    
    $dbConn= NULL;
}




?>
