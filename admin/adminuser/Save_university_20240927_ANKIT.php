<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";

if (isset($_GET["getState"])) {
    $qryresult = [];
    $country_id = $_GET["getState"];
	$is_active = 1;
    $sql = "select id,state_name from states WHERE country_id=:country_id AND is_active=:is_active";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":country_id", $country_id, PDO::PARAM_INT);
    $stmt->bindParam(":is_active", $is_active, PDO::PARAM_INT);
    $stmt->execute();

    $qryresult = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //if ($qryresult) {
        $statusarr["status"] = 1;
        $statusarr["record"] = $qryresult;
    // } else {
    //     $statusarr["status"] = 0;
    //     $statusarr["msg"] = "There is some problem with the data. Please Try again";
    // }
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}

if (isset($_GET["eid"])) {
    $record_id = $_GET["eid"];

    $sql = "select * from universities WHERE id=:id";
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

    $sql = "UPDATE universities SET is_active = :is_active WHERE id = :id";
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

$banner_img = "";
$logo_img = "";
$university_name = $_POST["university_name"];
$short_name = sanitize_string($_POST["short_name"]);
$other_name = sanitize_string($_POST["other_name"]);
$discription = sanitize_string($_POST["discription"]);
$university_type_id = sanitize_string($_POST["university_type_id"]);
$address = sanitize_string($_POST["address"]);
$landmark = sanitize_string($_POST["landmark"]);
$country_id = sanitize_string($_POST["country_id"]);
$state_id = sanitize_string($_POST["state_id"]);
$city_id = sanitize_string($_POST["city_id"]);
$district_id = sanitize_string($_POST["district_id"]);
$email = sanitize_string($_POST["email"]);
$email2 = sanitize_string($_POST["email2"]);
$phone = sanitize_string($_POST["phone"]);
$website_url = sanitize_string($_POST["website_url"]);
$website_display = sanitize_string($_POST["website_display"]);
$tags = sanitize_string($_POST["tags"]);
$slug = sanitize_string($_POST["slug"]);
//$slug = "university/".$slug;

$city_name = "";
if(!empty($city_id)){
    $sql = "select city_name from cities WHERE id=:city_id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":city_id", $city_id, PDO::PARAM_INT);
    $stmt->execute();
    $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);
    if($qryresult){
        $city_name = $qryresult['city_name'];
    }
}

$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";



//print_r($_FILES);

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
    $existQuery = $dbConn->prepare(
        "select * from universities WHERE university_name=:university_name and city_id=:city_id and id!=:id"
    );
    $existQuery->bindParam(":university_name", $university_name, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $record_id, PDO::PARAM_INT);
    $existQuery->bindParam(":city_id", $city_id, PDO::PARAM_INT);
    $existQuery->execute();
    $existRecord = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($existRecord) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This university already exist";
        echo json_encode($statusarr);
        return;
    } else {

        $sql = "select * from universities WHERE id=:id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
        $stmt->execute();

        $universityRec = $stmt->fetch(PDO::FETCH_ASSOC);

        $banner_img = $universityRec['banner_img'];
        
        if(isset($_FILES['banner_img']['name']) && !empty($_FILES['banner_img']['name'])){

           
            $errors = validateBannerImage($_FILES['banner_img']);

            if (empty($errors)) {
                $slugWithUniversity = $slug;
                $slugWithoutUniversity = str_replace("university/", "", $slugWithUniversity);

				$ext = pathinfo($_FILES['banner_img']['name'], PATHINFO_EXTENSION);
                //$uniqueSlug = generateSlug($university_name);
                $tmpFilePath = $_FILES['banner_img']['tmp_name'];
                $banner_file_name = $slugWithoutUniversity.'.'.$ext;
                $newFilePath = "../../uploads/university/banner_image/" .$banner_file_name;

                if($universityRec && !empty($universityRec['banner_img']) && isset($universityRec['banner_img']) && $universityRec['banner_img'] !=''){
                    if (file_exists("../../uploads/university/banner_image/".$universityRec['banner_img'])) {
                        unlink("../../uploads/university/banner_image/".$universityRec['banner_img']);
                    }
                }
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $banner_img = $banner_file_name;
                    
                }  
            } else {

                $statusarr["status"] = 0;
                $statusarr["msg"] = implode($errors);
                echo json_encode($statusarr);
                return;
            }
            
        }
        $logo_img = $universityRec['logo_img'];

        if(isset($_FILES['logo_img']['name']) && !empty($_FILES['logo_img']['name'])){
            $errors = validateLogoImage($_FILES['logo_img']);
            if (empty($errors)) {

                $slugWithUniversity = $slug;
                $slugWithoutUniversity = str_replace("university/", "", $slugWithUniversity);

				$ext = pathinfo($_FILES['logo_img']['name'], PATHINFO_EXTENSION);
                //echo "oankaj".$ext;
                //$uniqueSlug = generateSlug($university_name);
                $tmpFilePath = $_FILES['logo_img']['tmp_name'];
                $logo_file_name = $slugWithoutUniversity.'-logo.'.$ext;
               // echo $logo_file_name;
                $newFilePath = "../../uploads/university/logo_image/" .$logo_file_name;

                if(!empty($universityRec['logo_img']) && isset($universityRec['logo_img']) && $universityRec['logo_img'] !=''){
                    if (file_exists("../../uploads/university/logo_image/". $universityRec['logo_img'])) {unlink("../../uploads/university/logo_image/". $universityRec['logo_img']);}
                }
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                $logo_img = $logo_file_name;
                    
                }          
            } else {

                $statusarr["status"] = 0;
                $statusarr["msg"] = implode($errors);
                echo json_encode($statusarr);
                return;
            }
        }
        $sql =
            "UPDATE universities SET banner_img = :banner_img,logo_img = :logo_img,university_name = :university_name, short_name = :short_name, other_name = :other_name, university_type_id = :university_type_id,discription = :discription, address = :address, landmark = :landmark,country_id = :country_id, state_id = :state_id, city_id = :city_id,district_id = :district_id, email = :email, email2 = :email2,phone = :phone, website_url = :website_url, website_display = :website_display,tags = :tags, updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":banner_img", $banner_img, PDO::PARAM_STR);
        $stmt->bindParam(":logo_img", $logo_img, PDO::PARAM_STR);
        $stmt->bindParam(":university_name", $university_name, PDO::PARAM_STR);
        $stmt->bindParam(":short_name", $short_name, PDO::PARAM_STR);
        $stmt->bindParam(":other_name", $other_name, PDO::PARAM_STR);        
        $stmt->bindParam(":university_type_id", $university_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":discription", $discription, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":landmark", $landmark, PDO::PARAM_STR);
        $stmt->bindParam(":country_id", $country_id, PDO::PARAM_INT);
        $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
        $stmt->bindParam(":city_id", $city_id, PDO::PARAM_INT);
        $stmt->bindParam(":district_id", $district_id, PDO::PARAM_INT);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":email2", $email2, PDO::PARAM_STR);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->bindParam(":website_url", $website_url, PDO::PARAM_STR);
        $stmt->bindParam(":website_display", $website_display, PDO::PARAM_STR);
        $stmt->bindParam(":tags", $tags, PDO::PARAM_STR);
        //$stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        // $stmt->bindParam(":file_name", $file_name, PDO::PARAM_STR);
        $stmt->bindParam(":updated_at", $updated_at, PDO::PARAM_STR);
        $stmt->bindParam(":updated_by", $updated_by, PDO::PARAM_STR);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
        // $stmt->execute();

        if ($stmt->execute()) {
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Record updated successfully";
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
        "select * from universities WHERE university_name=:university_name and city_id=:city_id "
    );
    $existQuery->bindParam(":university_name", $university_name, PDO::PARAM_STR);
    $existQuery->bindParam(":city_id", $city_id, PDO::PARAM_INT);
    $existQuery->execute();
    $existRecord = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($existRecord) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This university already exist";
        echo json_encode($statusarr);
        return;
    } else {  
        
        
        
        $active_status = 1;
        $sql =
            "INSERT INTO universities (university_name,short_name,other_name,university_type_id,discription,address,landmark,country_id,state_id,city_id,district_id,email,email2,phone,website_url,website_display,tags,created_at, created_by, is_active) VALUES (:university_name, :short_name,:other_name,  :university_type_id,:discription,:address, :landmark,:country_id, :state_id, :city_id,:district_id,:email,:email2,:phone,:website_url,:website_display,:tags,:created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        // $stmt->bindParam(":banner_img", $banner_img, PDO::PARAM_STR);
        // $stmt->bindParam(":logo_img", $logo_img, PDO::PARAM_STR);
        $stmt->bindParam(":university_name", $university_name, PDO::PARAM_STR);
        $stmt->bindParam(":short_name", $short_name, PDO::PARAM_STR);
        $stmt->bindParam(":other_name", $other_name, PDO::PARAM_STR);
        $stmt->bindParam(":university_type_id", $university_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":discription", $discription, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":landmark", $landmark, PDO::PARAM_STR);
        $stmt->bindParam(":country_id", $country_id, PDO::PARAM_INT);
        $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
        $stmt->bindParam(":city_id", $city_id, PDO::PARAM_INT);
        $stmt->bindParam(":district_id", $district_id, PDO::PARAM_INT);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":email2", $email2, PDO::PARAM_STR);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->bindParam(":website_url", $website_url, PDO::PARAM_STR);
        $stmt->bindParam(":website_display", $website_display, PDO::PARAM_STR);
        $stmt->bindParam(":tags", $tags, PDO::PARAM_STR);

        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $active_status, PDO::PARAM_INT);
      
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();

            if(isset($_FILES['banner_img']['name']) && !empty($_FILES['banner_img']['name'])){

                $errors = validateBannerImage($_FILES['banner_img']);

                if (empty($errors)) {
                    $ext = pathinfo($_FILES['banner_img']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($university_name);
                    $tmpFilePath = $_FILES['banner_img']['tmp_name'];
                    $banner_file_name = $slug."-".$id.'.'.$ext;
					$newFilePath = "../../uploads/university/banner_image/" .$banner_file_name;
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                       $banner_img = $banner_file_name;
                    } 
                } else {

                    $statusarr["status"] = 0;
                    $statusarr["msg"] = implode($errors);
                    echo json_encode($statusarr);
                    return;
                }

                  
            }
            
            if(isset($_FILES['logo_img']['name']) && !empty($_FILES['logo_img']['name'])){
                $errors = validateLogoImage($_FILES['logo_img']);
                if (empty($errors)) {
                    $ext = pathinfo($_FILES['logo_img']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($university_name);
                    $tmpFilePath = $_FILES['logo_img']['tmp_name'];
                    $logo_file_name = $slug."-".$id.'-logo.'.$ext;
					$newFilePath = "../../uploads/university/logo_image/" .$logo_file_name;
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $logo_img = $logo_file_name;              
                    }           
                } else {
                    $statusarr["status"] = 0;
                    $statusarr["msg"] = implode($errors);
                    echo json_encode($statusarr);
                    return;
                }
            }
            $slug = "university/".$slug;
            if(!empty($short_name) && $short_name!="" && isset($short_name)){
                $slug= $slug."-".generateSlug($short_name);
            }
            if(!empty($city_name) && $city_name!=""){
                $slug= $slug."-".generateSlug($city_name);
            }
            $slug= $slug."-".$id;
            
            $sql = "UPDATE universities SET banner_img = :banner_img,logo_img = :logo_img,slug = :slug WHERE id = :id";           
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(":banner_img", $banner_img, PDO::PARAM_STR);
            $stmt->bindParam(":logo_img", $logo_img, PDO::PARAM_STR);
            $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
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
