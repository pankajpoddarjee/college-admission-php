<?php
include("connection.php");
include_once "configuration.php"; // Ensure this file is included


function IndianThousandFormat($num){
$explrestunits = "" ;
$num=preg_replace('/,+/', '', $num);
$words = explode(".", $num);
$des="00";
if(count($words)<=2){
    $num=$words[0];
    if(count($words)>=2){$des=$words[1];}
    if(strlen($des)<2){$des="$des0";}else{$des=substr($des,0,2);}
}
if(strlen($num)>3){
    $lastthree = substr($num, strlen($num)-3, strlen($num));
    $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
    $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
    $expunit = str_split($restunits, 2);
    for($i=0; $i<sizeof($expunit); $i++){
        // creates each of the 2's group and adds a comma to the end
        if($i==0)
        {
            $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
        }else{
            $explrestunits .= $expunit[$i].",";
        }
    }
    $thecash = $explrestunits.$lastthree;
} else {
    $thecash = $num;
}
return "$thecash"; // writes the final format where $currency is the currency symbol.

}
//Date Format
function changeDateFormat($datestr) {
	if($datestr!=''){
	$newdate = strtotime($datestr);
	$displaydate = date(' d M Y',$newdate);
	}
	else{
	$displaydate ="";
	}
	return $displaydate ;
}

function getCityNameById($city_id){
    global $dbConn;
    $sql = "select city_name from cities WHERE id=:city_id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":city_id", $city_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    return $city_name = !empty($records['city_name'])?$records['city_name']:"";      
}
function getStateNameById($state_id){
    global $dbConn;
    $sql = "select state_name from states WHERE id=:state_id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    return $state_name = !empty($records['state_name'])?$records['state_name']:"";      
}
function getCountryNameById($country_id){
    global $dbConn;
    $sql = "select country_name from countries WHERE id=:country_id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":country_id", $country_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    return $country_name = !empty($records['country_name'])?$records['country_name']:"";      
}

function getSubjectNameById($subject_id){
    $records = [];
    $subjectArr = [];
    global $dbConn;
    $sql = "select subject_name from subjects WHERE id IN ($subject_id)";
    $stmt = $dbConn->prepare($sql);
    //$stmt->bindParam(":id", $subject_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($records)>0){
        foreach ($records as  $value) {
            $subjectArr[] =  $value['subject_name'];
        }
    }
    return $subject_name = (count($subjectArr)>0)?implode(", ",$subjectArr):"N/A";     
}

function getBrowserAndPlatform() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
    // Initialize variables for platform and browser
    $platform = "Unknown OS Platform";
    $browser = "Unknown Browser";

    // Detect platform (Operating System)
    if (preg_match('/linux/i', $user_agent)) {
        $platform = 'Linux';
    } elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
        $platform = 'Mac';
    } elseif (preg_match('/windows|win32/i', $user_agent)) {
        $platform = 'Windows';
    }

    // Detect browser
    if (preg_match('/MSIE|Trident/i', $user_agent)) {
        $browser = 'Internet Explorer';
    } elseif (preg_match('/Firefox/i', $user_agent)) {
        $browser = 'Firefox';
    } elseif (preg_match('/Chrome/i', $user_agent)) {
        $browser = 'Chrome';
    } elseif (preg_match('/Safari/i', $user_agent)) {
        $browser = 'Safari';
    } elseif (preg_match('/Opera|OPR/i', $user_agent)) {
        $browser = 'Opera';
    } elseif (preg_match('/Edge/i', $user_agent)) {
        $browser = 'Edge';
    }

    // Return the result as an array
    return array(
        'platform' => $platform,
        'browser' => $browser,
    );
}
function getDeviceType() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    // Check for mobile devices
    if (preg_match('/mobile/i', $user_agent)) {
        return 'Mobile';
    } elseif (preg_match('/tablet|ipad/i', $user_agent)) {
        return 'Tablet';
    } else {
        return 'Desktop';
    }
    return 'UNKNOWN';
}
function getUserIP() {
    if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP from shared internet
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP passed from proxy
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
        // Regular IP address
        return $_SERVER['REMOTE_ADDR'];
    }
    return 'UNKNOWN';
}

function getUserCity($ip) {
    //$ip='2401:4900:8829:b469:cdf7:dad6:4b54:4be8';
    // API URL (you can use any geolocation service, e.g., ipinfo.io)
    //$url = "http://ipinfo.io/{$ip}/json";
    $url = "http://ip-api.com/json/{$ip}";

    // Fetch the data from the API
    $response = file_get_contents($url);
    $data = json_decode($response);

    // Check if city is found
    if (isset($data->city)) {
        return $data->city;
    } else {
        return 'City not found';
    }
}

function getAdById($adId){
    global $dbConn;
    $records = [];
    $sql = "select * from ads WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $adId, PDO::PARAM_INT);
    $stmt->execute();
    return $records = $stmt->fetch(PDO::FETCH_ASSOC);
    //return $add_ = !empty($records['course_type_name'])?$records['course_type_name']:"N/A";     
}

function getTopAd($ad_for="", $position="") {
    $date = date("Y-m-d");

    global $dbConn;
    $sql = "SELECT TOP 1 * 
            FROM ads 
            WHERE ad_for = :ad_for AND position = :position
            AND :current_date BETWEEN from_date AND to_date 
            AND is_active = 1;";
            
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":ad_for", $ad_for, PDO::PARAM_STR);
    $stmt->bindParam(":position", $position, PDO::PARAM_STR);
    $stmt->bindParam(":current_date", $date, PDO::PARAM_STR);
    $stmt->execute();

    return $record = $stmt->fetch(PDO::FETCH_ASSOC);

   
}
function getUniversityNameById($university_id){
    global $dbConn;
    $short_name = "";
    $sql = "select university_name,short_name from universities WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $university_id, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($records['short_name']) && !empty($records['short_name'])){
        $short_name = "[".$records['short_name']."]";
    }
    return $university_name = !empty($records['university_name'])?$records['university_name'].' '.$short_name:"NA";     
}

?>