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
    $additional_contact = [];
    $sql = "select * from universities WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
    $stmt->execute();

    $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "select * from additional_contacts WHERE parent_id=:id and type='university'";
    $stmtAddress = $dbConn->prepare($sql);
    $stmtAddress->bindParam(":id", $record_id, PDO::PARAM_INT);
    $stmtAddress->execute();
    $additional_contact = $stmtAddress->fetchAll(PDO::FETCH_ASSOC);

    if ($qryresult) {
        $statusarr["status"] = 1;
        $statusarr["record"] = $qryresult;
        $statusarr["additional_contact"] = $additional_contact;
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
$html_page ="";

$university_name = trim($_POST["university_name"]);
$short_name = sanitize_string($_POST["short_name"]);
$other_name = sanitize_string($_POST["other_name"]);
$eshtablish = sanitize_string($_POST["eshtablish"]);
$discription = sanitize_string($_POST["discription"]);
$university_type_id = sanitize_string($_POST["university_type_id"]);
$university_sub_type_id = isset($_POST['university_sub_type_id']) ? implode(',', $_POST['university_sub_type_id']) : 0;
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


//Additional Contact
$additional_address_type = isset($_POST['additional_address_type'])?$_POST['additional_address_type']:[];
$additional_address = isset($_POST['additional_address'])?$_POST['additional_address']:[];
$additional_email = isset($_POST['additional_email'])?$_POST['additional_email']:[];
$additional_phone = isset($_POST['additional_phone'])?$_POST['additional_phone']:[];
$additional_website = isset($_POST['additional_website'])?$_POST['additional_website']:[];
$additional_website_display = isset($_POST['additional_website_display'])?$_POST['additional_website_display']:[];

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
        $html_page = $universityRec['html_page'];
        if(isset($_FILES['html_page']['name']) && !empty($_FILES['html_page']['name'])){
            $errors = validateNoticePage($_FILES['html_page']);
            if (empty($errors)) {

                $slugWithCollege = $slug;
                $slugWithoutCollege = str_replace("university/", "", $slugWithCollege);

				$ext = pathinfo($_FILES['html_page']['name'], PATHINFO_EXTENSION);
                //echo "hello".$ext;
                //$uniqueSlug = generateSlug($college_name);
                $tmpFilePath = $_FILES['html_page']['tmp_name'];
                $page_file_name = $slugWithoutCollege.'-page.'.$ext;
               // echo $page_file_name;
                $newFilePath = "../../uploads/university/html_page/" .$page_file_name;

                if(!empty($universityRec['html_page']) && isset($universityRec['html_page']) && $universityRec['html_page'] !=''){
                    if (file_exists("../../uploads/university/html_page/". $universityRec['html_page'])) {unlink("../../uploads/university/html_page/". $universityRec['html_page']);}
                }
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                $html_page = $page_file_name;
                    
                }          
            } else {

                $statusarr["status"] = 0;
                $statusarr["msg"] = implode($errors);
                echo json_encode($statusarr);
                return;
            }
        }
        $sql =
            "UPDATE universities SET banner_img = :banner_img,logo_img = :logo_img,html_page = :html_page,university_name = :university_name, short_name = :short_name, other_name = :other_name,eshtablish = :eshtablish, university_type_id = :university_type_id,university_sub_type_id = :university_sub_type_id,discription = :discription, address = :address, landmark = :landmark,country_id = :country_id, state_id = :state_id, city_id = :city_id,district_id = :district_id, email = :email, email2 = :email2,phone = :phone, website_url = :website_url, website_display = :website_display,tags = :tags, updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":banner_img", $banner_img, PDO::PARAM_STR);
        $stmt->bindParam(":logo_img", $logo_img, PDO::PARAM_STR);
        $stmt->bindParam(":html_page", $html_page, PDO::PARAM_STR);
        $stmt->bindParam(":university_name", $university_name, PDO::PARAM_STR);
        $stmt->bindParam(":short_name", $short_name, PDO::PARAM_STR);
        $stmt->bindParam(":other_name", $other_name, PDO::PARAM_STR);    
        $stmt->bindParam(":eshtablish", $eshtablish, PDO::PARAM_STR);     
        $stmt->bindParam(":university_type_id", $university_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":university_sub_type_id", $university_sub_type_id, PDO::PARAM_STR);
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

            if(isset($additional_address_type) && count($additional_address_type) > 0){
                addAdditionalAddress($dbConn,$record_id,$additional_address_type,$additional_address,$additional_email,$additional_phone,$additional_website,$additional_website_display);
            }else{
                removeAdditionalAddress($dbConn,$record_id);
            }
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
            "INSERT INTO universities (university_name,short_name,other_name,eshtablish,university_type_id,university_sub_type_id,discription,address,landmark,country_id,state_id,city_id,district_id,email,email2,phone,website_url,website_display,tags,created_at, created_by, is_active) VALUES (:university_name, :short_name,:other_name, :eshtablish,  :university_type_id, :university_sub_type_id,:discription,:address, :landmark,:country_id, :state_id, :city_id,:district_id,:email,:email2,:phone,:website_url,:website_display,:tags,:created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        // $stmt->bindParam(":banner_img", $banner_img, PDO::PARAM_STR);
        // $stmt->bindParam(":logo_img", $logo_img, PDO::PARAM_STR);
        $stmt->bindParam(":university_name", $university_name, PDO::PARAM_STR);
        $stmt->bindParam(":short_name", $short_name, PDO::PARAM_STR);
        $stmt->bindParam(":other_name", $other_name, PDO::PARAM_STR);
        $stmt->bindParam(":eshtablish", $eshtablish, PDO::PARAM_STR);  
        $stmt->bindParam(":university_type_id", $university_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":university_sub_type_id", $university_sub_type_id, PDO::PARAM_STR);
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
            $slug = "university/".$slug;
            if(!empty($short_name) && $short_name!="" && isset($short_name)){
                $slug= $slug."-".generateSlug($short_name);
            }
            if(!empty($city_name) && $city_name!=""){
                $slug= $slug."-".generateSlug($city_name);
            }
            $slug= $slug."-".$id;

            if(isset($_FILES['banner_img']['name']) && !empty($_FILES['banner_img']['name'])){

                $errors = validateBannerImage($_FILES['banner_img']);
                $slugWithUniversity = $slug;
                $slugWithoutUniversity = str_replace("university/", "", $slugWithUniversity);
                if (empty($errors)) {
                    $ext = pathinfo($_FILES['banner_img']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($university_name);
                    $tmpFilePath = $_FILES['banner_img']['tmp_name'];
                    $banner_file_name = $slugWithoutUniversity.'.'.$ext;
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
                $slugWithUniversity = $slug;
                $slugWithoutUniversity = str_replace("university/", "", $slugWithUniversity);

                if (empty($errors)) {
                    $ext = pathinfo($_FILES['logo_img']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($university_name);
                    $tmpFilePath = $_FILES['logo_img']['tmp_name'];
                    $logo_file_name = $slugWithoutUniversity.'-logo.'.$ext;
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

            if(isset($_FILES['html_page']['name']) && !empty($_FILES['html_page']['name'])){
                $errors = validateNoticePage($_FILES['html_page']);
                if (empty($errors)) {
                    $ext = pathinfo($_FILES['html_page']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($college_name);
                    $tmpFilePath = $_FILES['html_page']['tmp_name'];
                    $page_file_name = $slug."-".$id.'-page.'.$ext;
					$newFilePath = "../../uploads/university/html_page/" .$page_file_name;
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $html_page = $page_file_name;              
                    }           
                } else {
                    $statusarr["status"] = 0;
                    $statusarr["msg"] = implode($errors);
                    echo json_encode($statusarr);
                    return;
                }
            }


            
            
            $sql = "UPDATE universities SET banner_img = :banner_img,logo_img = :logo_img,html_page = :html_page,slug = :slug WHERE id = :id";           
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(":banner_img", $banner_img, PDO::PARAM_STR);
            $stmt->bindParam(":logo_img", $logo_img, PDO::PARAM_STR);
            $stmt->bindParam(":html_page", $html_page, PDO::PARAM_STR);
            $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if(isset($additional_address_type) && count($additional_address_type) > 0){
                addAdditionalAddress($dbConn,$id,$additional_address_type,$additional_address,$additional_email,$additional_phone,$additional_website,$additional_website_display);
            }
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

function addAdditionalAddress($dbConn, $college_id, $additional_address_type, $additional_address, $additional_email, $additional_phone, $additional_website, $additional_website_display) {

    
    
    // Define the constant type for all entries
    $type = "university";
    $stmt = $dbConn->prepare("DELETE FROM additional_contacts WHERE type=:type AND parent_id = :parent_id");
    $stmt->bindParam(':parent_id', $college_id, PDO::PARAM_INT);
    $stmt->bindValue(":type", $type, PDO::PARAM_STR);
    $stmt->execute();

    // Prepare the SQL statement
    $stmt = $dbConn->prepare("
        INSERT INTO additional_contacts 
        (type, parent_id, additional_address_type, additional_address, additional_email, additional_phone, additional_website, additional_website_display) 
        VALUES 
        (:type, :parent_id, :additional_address_type, :additional_address, :additional_email, :additional_phone, :additional_website, :additional_website_display)
    ");

    // Loop through the data and execute the prepared statement for each row
    for ($i = 0; $i < count($additional_address_type); $i++) {
        // Bind values dynamically for each row
        $stmt->bindValue(":type", $type, PDO::PARAM_STR);
        $stmt->bindValue(":parent_id", $college_id, PDO::PARAM_INT);
        $stmt->bindValue(":additional_address_type", $additional_address_type[$i], PDO::PARAM_STR);
        $stmt->bindValue(":additional_address", $additional_address[$i], PDO::PARAM_STR);
        $stmt->bindValue(":additional_email", $additional_email[$i], PDO::PARAM_STR);
        $stmt->bindValue(":additional_phone", $additional_phone[$i], PDO::PARAM_STR);
        $stmt->bindValue(":additional_website", $additional_website[$i], PDO::PARAM_STR);
        $stmt->bindValue(":additional_website_display", $additional_website_display[$i], PDO::PARAM_STR);

        // Execute the prepared statement
        $stmt->execute();
    }
}

function removeAdditionalAddress($dbConn, $college_id){
    $type = "university";
    $stmt = $dbConn->prepare("DELETE FROM additional_contacts WHERE type=:type AND parent_id = :parent_id");
    $stmt->bindParam(':parent_id', $college_id, PDO::PARAM_INT);
    $stmt->bindValue(":type", $type, PDO::PARAM_STR);
    $stmt->execute();
}


?>
