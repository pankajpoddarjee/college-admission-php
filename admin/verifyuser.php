<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

header("Content-type: text/javascript");
include("connection.php");

function generateCsrfToken() {
    return bin2hex(random_bytes(32));
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   
    $csrfToken = isset($_SERVER['HTTP_X_CSRF_TOKEN']) ? $_SERVER['HTTP_X_CSRF_TOKEN'] : '';

    if ($csrfToken === $_SESSION['csrf_token']) {
        // Process the request
        $msg="";
        $finalarr=array();
        $record=array();
        $record=[] ;
        //$strsql="select id,name,designation,department,mobile,email,password,usertype,is_active from users where email='".$_POST["username"]."'  and password='" .$_POST["password"]."'  and is_active=1 ";
        //$userPassword =    md5($_POST["password"]); 
        $password =    $_POST["password"]; 
        $strsql='select * from users_admin where email=:username and is_active=1' ;

        $stmt = $dbConn->prepare($strsql);
        $stmt->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
        //$stmt->bindParam(':password', $userPassword, PDO::PARAM_STR);
        $stmt->execute();

        $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($qryresult && password_verify($password, $qryresult['password'])) {
          
            $record = $qryresult;
            $status = 1;
            $msg = "";
           
            $_SESSION['loggedin'] = true;
            $_SESSION['userid'] =$record["id"];
            $_SESSION['user'] = $record["name"];
            $_SESSION['usertype'] = $record["usertype"];
        } else {
           
            $_SESSION['csrf_token'] = generateCsrfToken();
            $status = 0;
            $msg="User name Or Password does not match. Please Try again";
        }

        $finalarr["status"]=$status;
        $finalarr["msg"]=$msg;
        $finalarr["actionurl"]= "adminuser/dashboard.php";
        unset($_SESSION['csrf_token']);
        echo json_encode($finalarr);
    } else {
        // Invalid CSRF token
        $_SESSION['csrf_token'] = generateCsrfToken();
        $finalarr["status"]=0;
        $finalarr["msg"]="Invalid CSRF token!";
        //http_response_code(403); unset($_SESSION['csrf_token']);
        echo json_encode($finalarr);
    }
    // if ($csrfToken === $_SESSION['csrf_token']) {
    //     // Process the request
    //     $msg="";
    //     $finalarr=array();
    //     $record=array();
    //     $record=[] ;
    //     //$strsql="select id,name,designation,department,mobile,email,password,usertype,is_active from users where email='".$_POST["username"]."'  and password='" .$_POST["password"]."'  and is_active=1 ";
    //     $userPassword =    md5($_POST["password"]); 
    //     $strsql='select id,name,designation,mobile,email,password,usertype,is_active from users_admin where email=:username  and password=:password  and is_active=1' ;

    //     $stmt = $dbConn->prepare($strsql);
    //     $stmt->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
    //     $stmt->bindParam(':password', $userPassword, PDO::PARAM_STR);
    //     $stmt->execute();

    //     $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);
    //     if($qryresult){
    //         $record = $qryresult;
    //     }
    //     $qryresult = NULL;

    //     if(count($record)>0)
    //     {
    //         $status = 1;
    //         $msg = "";
    //         $_SESSION['loggedin'] = true;
    //         $_SESSION['userid'] =$record["id"];
    //         $_SESSION['user'] = $record["name"];
    //         //$_SESSION['department_id'] = $record["department"];
    //         //$_SESSION['usertypeid'] = $record[0]["typeid"];
    //         $_SESSION['usertype'] = $record["usertype"];
        
    //     }
    //     else{
    //             $_SESSION['csrf_token'] = generateCsrfToken();
    //             $status = 0;
    //             $msg="User name Or Password does not match. Please Try again";
    //     }

    //     $finalarr["status"]=$status;
    //     $finalarr["msg"]=$msg;
    //     $finalarr["actionurl"]= "adminuser/dashboard.php";
    //     unset($_SESSION['csrf_token']);
    //     echo json_encode($finalarr);
    // } else {
    //     // Invalid CSRF token
    //     $_SESSION['csrf_token'] = generateCsrfToken();
    //     $finalarr["status"]=0;
    //     $finalarr["msg"]="Invalid CSRF token!";
    //     //http_response_code(403); unset($_SESSION['csrf_token']);
    //     echo json_encode($finalarr);
    // }

    // Optionally, regenerate the CSRF token
    //unset($_SESSION['csrf_token']);
}
?>