<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";


//ADD NEW UNIVERSITY
//ADD NEW UNIVERSITY
if (isset($_GET["newUniversity"])) {
    $created_at = date("Y-m-d H:i:s");
    $created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    $university_name = $_GET["newUniversity"];
    $uid = (int)$university_name;
    $existQuery = $dbConn->prepare(
        "select * from universities WHERE university_name=:university_name OR id=:id"
    );
    $existQuery->bindParam(":university_name", $university_name, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $uid, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This university already exist";
        echo json_encode($statusarr);
        return;
    } else {

        $active_status = 1;
        $sql =
            "INSERT INTO universities (university_name, created_at, created_by, is_active) VALUES (:university_name, :created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":university_name", $university_name, PDO::PARAM_STR);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $active_status, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Data inserted successfully";
            $statusarr["insert_id"] = $id;
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
           
        }
    }
        $dbConn= NULL;
		echo json_encode($statusarr);
		return;
}

//ADD NEW COUNTRY
if (isset($_GET["addCountry"])) {
    $created_at = date("Y-m-d H:i:s");
    $created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    $country_name = $_GET["addCountry"];
    $cid = (int)$country_name;
    $existQuery = $dbConn->prepare(
        "select * from countries WHERE country_name=:country_name OR id=:id"
    );
    $existQuery->bindParam(":country_name", $country_name, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $cid, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This country already exist";
        echo json_encode($statusarr);
        return;
    } else {

        $active_status = 1;
        $sql =
            "INSERT INTO countries (country_name, created_at, created_by, is_active) VALUES (:country_name, :created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":country_name", $country_name, PDO::PARAM_STR);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $active_status, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Data inserted successfully";
            $statusarr["insert_id"] = $id;
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
           
        }
    }
        $dbConn= NULL;
		echo json_encode($statusarr);
		return;
}

//ADD NEW STATE
if (isset($_GET["addState"]) && isset($_GET["country_id"])) {
    $created_at = date("Y-m-d H:i:s");
    $created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    $state_name = $_GET["addState"];
    $country_id = $_GET["country_id"];
    $sid = (int)$state_name;
    $cid = (int)$country_id;
    $existQuery = $dbConn->prepare(
        "select * from states WHERE state_name=:state_name OR id=:id"
    );
    $existQuery->bindParam(":state_name", $state_name, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $sid, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This city already exist";
        echo json_encode($statusarr);
        return;
    } else {

        $active_status = 1;
        $sql =
            "INSERT INTO states (state_name,country_id, created_at, created_by, is_active) VALUES (:state_name,:country_id, :created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":state_name", $state_name, PDO::PARAM_STR);
        $stmt->bindParam(":country_id", $cid, PDO::PARAM_INT);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $active_status, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Data inserted successfully";
            $statusarr["insert_id"] = $id;
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
           
        }
    }
        $dbConn= NULL;
		echo json_encode($statusarr);
		return;
}

//ADD NEW CITY
if (isset($_GET["addDistrict"]) && isset($_GET["country_id"]) && isset($_GET["state_id"])) {
    $created_at = date("Y-m-d H:i:s");
    $created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    $district_name = $_GET["addDistrict"];
    $country_id = $_GET["country_id"];
    $state_id = $_GET["state_id"];
    $districtid = (int)$district_name;
    $cid = (int)$country_id;
    $sid = (int)$state_id;
    $existQuery = $dbConn->prepare(
        "select * from districts WHERE district_name=:district_name OR id=:id"
    );
    $existQuery->bindParam(":district_name", $district_name, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $districtid, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This district already exist";
        echo json_encode($statusarr);
        return;
    } else {

        $active_status = 1;
        $sql =
            "INSERT INTO districts (district_name,country_id,state_id, created_at, created_by, is_active) VALUES (:district_name,:country_id,:state_id, :created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":district_name", $district_name, PDO::PARAM_STR);
        $stmt->bindParam(":country_id", $cid, PDO::PARAM_INT);
        $stmt->bindParam(":state_id", $sid, PDO::PARAM_INT);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $active_status, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Data inserted successfully";
            $statusarr["insert_id"] = $id;
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
           
        }
    }
        $dbConn= NULL;
		echo json_encode($statusarr);
		return;
}

//ADD NEW DISTRICT
if (isset($_GET["addCity"]) && isset($_GET["country_id"]) && isset($_GET["state_id"])) {
    $created_at = date("Y-m-d H:i:s");
    $created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    $city_name = $_GET["addCity"];
    $country_id = $_GET["country_id"];
    $state_id = $_GET["state_id"];
    $cityid = (int)$city_name;
    $cid = (int)$country_id;
    $sid = (int)$state_id;
    $existQuery = $dbConn->prepare(
        "select * from cities WHERE city_name=:city_name OR id=:id"
    );
    $existQuery->bindParam(":city_name", $city_name, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $cityid, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This state already exist";
        echo json_encode($statusarr);
        return;
    } else {

        $active_status = 1;
        $sql =
            "INSERT INTO cities (city_name,country_id,state_id, created_at, created_by, is_active) VALUES (:city_name,:country_id,:state_id, :created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":city_name", $city_name, PDO::PARAM_STR);
        $stmt->bindParam(":country_id", $cid, PDO::PARAM_INT);
        $stmt->bindParam(":state_id", $sid, PDO::PARAM_INT);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $active_status, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Data inserted successfully";
            $statusarr["insert_id"] = $id;
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
           
        }
    }
        $dbConn= NULL;
		echo json_encode($statusarr);
		return;
}
//GET STATES BY COUNTRY ID
//GET ALL COUNTRY

if (isset($_GET["getCountry"])) {
    $countryRecords = [];
    $activeStatus = 1;
    $strsql="select id,country_name from countries where is_active = :is_active order by country_name";
    $stmt = $dbConn->prepare($strsql);
    $stmt->bindParam(':is_active',$activeStatus);
    $stmt->execute();
    $countryRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $statusarr["status"] = 1;
    $statusarr["record"] = $countryRecords;
   
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}


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


//GET CITIES BY STATE ID

if (isset($_GET["getCity"])) {
    $qryresult = [];
    $state_id = $_GET["getCity"];
	$is_active = 1;
    $sql = "select id,city_name from cities WHERE state_id=:state_id AND is_active=:is_active";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
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

//GET DISTRICTS BY STATE ID

if (isset($_GET["getDistrict"])) {
    $qryresult = [];
    $state_id = $_GET["getDistrict"];
	$is_active = 1;
    $sql = "select id,district_name from districts WHERE state_id=:state_id AND is_active=:is_active";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
    $stmt->bindParam(":is_active", $is_active, PDO::PARAM_INT);
    $stmt->execute();

    $qryresult = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // if ($qryresult) {
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
?>