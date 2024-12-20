<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";


if (isset($_GET["getClickDetail"])) {  
    $ad_id = $_GET["getClickDetail"];

    // Prepare the SQL statement
    $sql = "SELECT * FROM ad_clicks WHERE ad_id = :ad_id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":ad_id", $ad_id, PDO::PARAM_INT);
    
    // Execute the query
    if ($stmt->execute()) {
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $output = "";

        if (count($records) > 0) {
            $i = 1;
            foreach ($records as $rec) {
                $clicked_at = date('d F Y (H:i:s)', strtotime($rec["clicked_at"]));
                $ip_address = htmlspecialchars($rec["ip_address"], ENT_QUOTES, 'UTF-8');
                $device = htmlspecialchars($rec["device"], ENT_QUOTES, 'UTF-8');
                $browser = htmlspecialchars($rec["browser"], ENT_QUOTES, 'UTF-8');
                $platform = htmlspecialchars($rec["platform"], ENT_QUOTES, 'UTF-8');
                $city = htmlspecialchars($rec["city"], ENT_QUOTES, 'UTF-8');

                // Constructing the table row
                $output .= '<tr>
                                <td class="align-middle">' . $i . '</td>
                                <td class="align-middle">' . $clicked_at . '</td>
                                <td class="align-middle">' . $ip_address . '</td>
                                <td class="align-middle">' . $device . '</td>
                                <td class="align-middle">' . $browser . '</td>
                                <td class="align-middle">' . $platform . '</td>
                                <td class="align-middle">' . $city . '</td>
                            </tr>';
                $i++;
            }
        } 
        
        // else {
        //     // Display a single row indicating no data found
        //     $output .= '<tr><td colspan="7" class="text-center">No Data Found</td></tr>';
        // }
        
        // Echo the generated HTML for the table body
        echo $output;
    } else {
        echo '<tr><td colspan="7" class="text-center">Error executing query.</td></tr>';
    }
}

if (isset($_GET["getImpressionDetail"])) {  
    $ad_id = $_GET["getImpressionDetail"];

    // Prepare the SQL statement
    $sql = "SELECT * FROM ad_impressions WHERE ad_id = :ad_id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":ad_id", $ad_id, PDO::PARAM_INT);
    
    // Execute the query
    if ($stmt->execute()) {
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $output = "";

        if (count($records) > 0) {
            $i = 1;
            foreach ($records as $rec) {
                $clicked_at = date('d F Y (H:i:s)', strtotime($rec["clicked_at"]));
                $ip_address = htmlspecialchars($rec["ip_address"], ENT_QUOTES, 'UTF-8');
                $device = htmlspecialchars($rec["device"], ENT_QUOTES, 'UTF-8');
                $browser = htmlspecialchars($rec["browser"], ENT_QUOTES, 'UTF-8');
                $platform = htmlspecialchars($rec["platform"], ENT_QUOTES, 'UTF-8');
                $city = htmlspecialchars($rec["city"], ENT_QUOTES, 'UTF-8');

                // Constructing the table row
                $output .= '<tr>
                                <td class="align-middle">' . $i . '</td>
                                <td class="align-middle">' . $clicked_at . '</td>
                                <td class="align-middle">' . $ip_address . '</td>
                                <td class="align-middle">' . $device . '</td>
                                <td class="align-middle">' . $browser . '</td>
                                <td class="align-middle">' . $platform . '</td>
                                <td class="align-middle">' . $city . '</td>
                            </tr>';
                $i++;
            }
        } 
        
        // else {
        //     // Display a single row indicating no data found
        //     $output .= '<tr><td colspan="7" class="text-center">No Data Found</td></tr>';
        // }
        
        // Echo the generated HTML for the table body
        echo $output;
    } else {
        echo '<tr><td colspan="7" class="text-center">Error executing query.</td></tr>';
    }
}


if (isset($_GET["getClickCustomizeDetail"])) { 

    $ad_id = isset($_GET['ad_id']) ? $_GET['ad_id'] : null;
    $fromDate = isset($_GET['fromDate']) ? $_GET['fromDate'] : null;
    $toDate = isset($_GET['toDate']) ? $_GET['toDate'] : null;
    $output='<table id="master-table" class="table table-bordered order-table" style="font-family:Rubik">
                                        <thead class="bg-light text-center font-weight-bold">
                                            <tr>
                                            <td class="align-middle">SL No.</td>
                                                <td class="align-middle">Click Date Time</td>
                                                <td class="align-middle">IP Address </td>
                                                <td class="align-middle">Device</td>
                                                <td class="align-middle">Browser</td>
                                                <td class="align-middle">Platform</td>
                                                <td class="align-middle">City</td>
                                            </tr></thead>';
    $qry = "SELECT  * from ad_clicks WHERE ad_id=:ad_id  AND clicked_at BETWEEN :fromDate AND :toDate";
        
        $stmt = $dbConn->prepare($qry);
        $stmt->bindParam(":ad_id", $ad_id, PDO::PARAM_INT);  
        $stmt->bindParam(":fromDate", $fromDate, PDO::PARAM_STR);
        $stmt->bindParam(":toDate", $toDate, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

       // print_r($result);
        if(count($result)>0){
            $i = 1;
            foreach ($result as  $rec) {
                $clicked_at = date('d F Y (H:i:s)',strtotime($rec["clicked_at"])) ;
                $ip_address = $rec["ip_address"];
                $device = $rec["device"];            
                $browser =  $rec["browser"];
                $platform =  $rec["platform"];
                $city =  $rec["city"];

                $output .='<tr><td>'.$i.'</td><td>'.$clicked_at.'</td><td>'.$ip_address.'</td><td>'.$device.'</td><td>'.$browser.'</td><td>'.$platform.'</td><td>'.$city.'</td></tr>';
                $i++;
            }

        }
        // else{
        //     $output .= '<tr> <td colspan="7" class="align-middle">No Record Found</td> </tr>';
        // }
    $output .= '</table>';
    echo $output;
}

if (isset($_GET["getImpressionCustomizeDetail"])) { 

    $ad_id = isset($_GET['ad_id']) ? $_GET['ad_id'] : null;
    $fromDate = isset($_GET['fromDate']) ? $_GET['fromDate'] : null;
    $toDate = isset($_GET['toDate']) ? $_GET['toDate'] : null;
    $output='<table id="master-table" class="table table-bordered order-table" style="font-family:Rubik">
                                        <thead class="bg-light text-center font-weight-bold">
                                            <tr>
                                            <td class="align-middle">SL No.</td>
                                                <td class="align-middle">Click Date Time</td>
                                                <td class="align-middle">IP Address </td>
                                                <td class="align-middle">Device</td>
                                                <td class="align-middle">Browser</td>
                                                <td class="align-middle">Platform</td>
                                                <td class="align-middle">City</td>
                                            </tr></thead>';
    $qry = "SELECT  * from ad_impressions WHERE ad_id=:ad_id  AND clicked_at BETWEEN :fromDate AND :toDate";
        
        $stmt = $dbConn->prepare($qry);
        $stmt->bindParam(":ad_id", $ad_id, PDO::PARAM_INT);  
        $stmt->bindParam(":fromDate", $fromDate, PDO::PARAM_STR);
        $stmt->bindParam(":toDate", $toDate, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

       // print_r($result);
        if(count($result)>0){
            $i = 1;
            foreach ($result as  $rec) {
                $clicked_at = date('d F Y (H:i:s)',strtotime($rec["clicked_at"])) ;
                $ip_address = $rec["ip_address"];
                $device = $rec["device"];            
                $browser =  $rec["browser"];
                $platform =  $rec["platform"];
                $city =  $rec["city"];

                $output .='<tr><td>'.$i.'</td><td>'.$clicked_at.'</td><td>'.$ip_address.'</td><td>'.$device.'</td><td>'.$browser.'</td><td>'.$platform.'</td><td>'.$city.'</td></tr>';
                $i++;
            }

        }
        // else{
        //     $output .= '<tr> <td colspan="7" class="align-middle">No Record Found</td> </tr>';
        // }
    $output .= '</table>';
    echo $output;
}
?>