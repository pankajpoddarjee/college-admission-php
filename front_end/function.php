<?php
include("connection.php");
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
?>