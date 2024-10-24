<?php include('../settings.php');?>
<?php include("../connection.php");include("../function.php");?>
<?php
//echo "<pre>";
//print_r($_SERVER);

if(isset($_SERVER['PATH_INFO'])){

   
    $slug_url=$_SERVER['PATH_INFO'];

    $sql="select * from colleges where slug='$slug_url'";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo $records[0]['college_name'];
    echo $records[0]['slug'];

    echo "<pre>";
    print_r($records);
}
else {
    echo "All College List";
}

?>


<?php //include("../collegeInfoMainTable.php");?>