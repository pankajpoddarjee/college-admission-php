<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";

if (isset($_GET["get_attachment"]) && isset($_GET["notice_id"])) {
    $from = $_GET["get_attachment"];
    $notice_id = $_GET["notice_id"];
    $statusarr = [];
    if($from=='college'){
        $sql = "select * from notice_college_attachments WHERE notice_id=:notice_id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":notice_id", $notice_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($qryresult) {
            $statusarr["status"] = 1;
            $statusarr["record"] = $qryresult;
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
        }
    }
    if($from=='university'){

        $sql = "select * from notice_university_attachments WHERE notice_id=:notice_id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":notice_id", $notice_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($qryresult) {
            $statusarr["status"] = 1;
            $statusarr["record"] = $qryresult;
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

if (isset($_GET["from"]) && isset($_GET["notice_id"])  && isset($_GET["id"])) {


    $from = $_GET["from"];
    $notice_id = $_GET["notice_id"];
    $id = $_GET["id"];
    $year_directory = $_POST["year_directory"];
    $new_directory = sanitize_string($_POST["new_directory"]);
    $created_at = date("Y-m-d H:i:s");
    $created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    $statusarr = [];
    // print_r($_FILES);
    // print_r($_POST); die;
    //if($from=='college'){
       // $college_id = $id;
        //Attachments
        if (isset($_FILES['attachments']['name']) && !empty($_FILES['attachments']['name'][0])) {
            
                $parentDirectory = '../../uploads/notices'; // Specify the path to the parent folder
                $newDirectoryName = $from . '/' .$id . '/' . $year_directory . '/' . $new_directory;                    
                $uploadDir = $parentDirectory . '/' . $newDirectoryName;

                if (!is_dir($uploadDir)) {
                    // Attempt to create the directory
                    if (mkdir($uploadDir, 0755, true)) {
                        //echo "Directory created successfully.";
                    } else {
                        
                        $statusarr["status"] = 0;
                        $statusarr["msg"] = "Failed to create directory.";
                        echo json_encode($statusarr);
                        return;
                    }
                } 

                foreach ($_FILES['attachments']['name'] as $key => $fileName) {
                    // Define the path to store the uploaded file
                    $attachment_file_name =  time().'-'.basename($fileName);
                    $targetFilePath = $uploadDir.'/'. $attachment_file_name;
            
                    // Check if the file is a valid PDF
                    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                    if ($fileType === 'pdf') {
                        // Check for any errors during the upload process
                        if ($_FILES['attachments']['error'][$key] === 0) {
                            // Move the file to the server's directory
                            if (move_uploaded_file($_FILES['attachments']['tmp_name'][$key], $targetFilePath)) {
                               
                               
                                $statusarr["status"] = 1;
                                $statusarr["msg"] = "Uploaded successfully";

                            } else {
                                //echo "Error uploading file {$fileName}.<br>";
                                $statusarr["status"] = 0;
                                $statusarr["msg"] = "Error uploading file {$fileName}.<br>";
                                echo json_encode($statusarr);
                                return;
                            }
                        } else {
                           // echo "Error occurred with file {$fileName}. Error code: {$_FILES['attachments']['error'][$key]}<br>";
                            $statusarr["status"] = 0;
                            $statusarr["msg"] = "Error occurred with file {$fileName}. Error code: {$_FILES['attachments']['error'][$key]}<br>";
                            echo json_encode($statusarr);
                            return;
                        }
                    } else {
                        //echo "{$fileName} is not a valid PDF file.<br>";
                        $statusarr["status"] = 0;
                        $statusarr["msg"] = "{$fileName} is not a valid PDF file.<br>";
                        echo json_encode($statusarr);
                        return;
                    }
                }
            
        }
    //}
    // if($from=='university'){
    //     $university_id = $id;
    //     //Attachments
    //     if (isset($_FILES['attachments']['name']) && !empty($_FILES['attachments']['name'][0])) {
            
    //             $parentDirectory = '../../uploads/notices/university'; // Specify the path to the parent folder
    //             $newDirectoryName = $university_id . '/' . $year_directory . '/' . $new_directory;                    
    //             $uploadDir = $parentDirectory . '/' . $newDirectoryName;

    //             if (!is_dir($uploadDir)) {
    //                 // Attempt to create the directory
    //                 if (mkdir($uploadDir, 0755, true)) {
    //                     //echo "Directory created successfully.";
    //                 } else {
                        
    //                     $statusarr["status"] = 0;
    //                     $statusarr["msg"] = "Failed to create directory.";
    //                     echo json_encode($statusarr);
    //                     return;
    //                 }
    //             } 

    //             foreach ($_FILES['attachments']['name'] as $key => $fileName) {
    //                 // Define the path to store the uploaded file
    //                 $attachment_file_name =  time().'-'.basename($fileName);
    //                 $targetFilePath = $uploadDir.'/'. $attachment_file_name;
            
    //                 // Check if the file is a valid PDF
    //                 $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    //                 if ($fileType === 'pdf') {
    //                     // Check for any errors during the upload process
    //                     if ($_FILES['attachments']['error'][$key] === 0) {
    //                         // Move the file to the server's directory
    //                         if (move_uploaded_file($_FILES['attachments']['tmp_name'][$key], $targetFilePath)) {
                               
    //                             // $sql ="INSERT INTO notice_university_attachments (notice_id,university_id,notice_year,directory_name,path, created_at, created_by) VALUES (:notice_id,:university_id,:notice_year, :directory_name, :path, :created_at,:created_by)";
    //                             // $stmt = $dbConn->prepare($sql);
    //                             // $stmt->bindParam(":notice_id", $notice_id, PDO::PARAM_INT);
    //                             // $stmt->bindParam(":university_id", $id, PDO::PARAM_INT);
    //                             // $stmt->bindParam(":notice_year", $year_directory, PDO::PARAM_STR);
    //                             // $stmt->bindParam(":directory_name", $new_directory, PDO::PARAM_STR);
    //                             // $stmt->bindParam(":path", $attachment_file_name, PDO::PARAM_STR);
    //                             // $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
    //                             // $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
    //                             // if ($stmt->execute()) {
    //                             //     $statusarr["status"] = 1;
    //                             //     $statusarr["msg"] = "Data inserted successfully";
    //                             // } else {
    //                             //     $statusarr["status"] = 0;
    //                             //     $statusarr["msg"] =
    //                             //         "There is some problem with the data. Please Try again";
                                
    //                             // }

    //                             $statusarr["status"] = 1;
    //                             $statusarr["msg"] = "Uploaded successfully";

    //                         } else {
    //                             echo "Error uploading file {$fileName}.<br>";
    //                         }
    //                     } else {
    //                         echo "Error occurred with file {$fileName}. Error code: {$_FILES['attachments']['error'][$key]}<br>";
    //                     }
    //                 } else {
    //                     echo "{$fileName} is not a valid PDF file.<br>";
    //                 }
    //             }
            
    //     }
       
    // }
	$dbConn= NULL;
    echo json_encode($statusarr);
    return;
}

if (isset($_GET["newYearDirectory"]) && isset($_GET["from"]) && isset($_GET["id"])) {
    $year_directory = $_GET["newYearDirectory"];
    $from = $_GET["from"];
    $id = $_GET["id"];

    $statusarr = [];

    //if($from=='college'){
        //$college_id = $id;
        $parentDirectory = '../../uploads/notices'; // Specify the path to the parent folder
        $newDirectoryName = $from . '/' .$id . '/' . $year_directory;                    
        $uploadDir = $parentDirectory . '/' . $newDirectoryName;

        if (!is_dir($uploadDir)) {
            // Attempt to create the directory
            if (mkdir($uploadDir, 0755, true)) {
                $statusarr["status"] = 1;
                $statusarr["msg"] = "Directory created successfully";
            } else {
                
                $statusarr["status"] = 0;
                $statusarr["msg"] = "Failed to create directory.";
            }
        }
    //}

    // if($from=='university'){
    //     $university_id = $id;
    //     $parentDirectory = '../../uploads/notices/university'; // Specify the path to the parent folder
    //     $newDirectoryName = $university_id . '/' . $year_directory;                    
    //     $uploadDir = $parentDirectory . '/' . $newDirectoryName;

    //     if (!is_dir($uploadDir)) {
    //         // Attempt to create the directory
    //         if (mkdir($uploadDir, 0755, true)) {
    //             $statusarr["status"] = 1;
    //             $statusarr["msg"] = "Directory created successfully";
    //         } else {
                
    //             $statusarr["status"] = 0;
    //             $statusarr["msg"] = "Failed to create directory.";
    //         }
    //     }
    // }
    
    
	$dbConn= NULL;
    echo json_encode($statusarr);
    return;
}

if (isset($_GET["newDirectory"]) && isset($_GET["from"]) && isset($_GET["id"]) && isset($_GET["year_directory"])) {
    $new_directory = $_GET["newDirectory"];
    $from = $_GET["from"];
    $id = $_GET["id"];
    $year_directory = $_GET["year_directory"];

    $statusarr = [];

    //if($from=='college'){
        //$college_id = $id;
        $parentDirectory = '../../uploads/notices'; // Specify the path to the parent folder
        $newDirectoryName = $from . '/' .$id . '/' . $year_directory . '/' . $new_directory;                    
        $uploadDir = $parentDirectory . '/' . $newDirectoryName;

        if (!is_dir($uploadDir)) {
            // Attempt to create the directory
            if (mkdir($uploadDir, 0755, true)) {
                $statusarr["status"] = 1;
                $statusarr["msg"] = "Directory created successfully";
            } else {
                
                $statusarr["status"] = 0;
                $statusarr["msg"] = "Failed to create directory.";
            }
        }
   // }

    // if($from=='university'){
    //     $university_id = $id;
    //     $parentDirectory = '../../uploads/notices/university'; // Specify the path to the parent folder
    //     $newDirectoryName = $university_id . '/' . $year_directory . '/' . $new_directory;                    
    //     $uploadDir = $parentDirectory . '/' . $newDirectoryName;

    //     if (!is_dir($uploadDir)) {
    //         // Attempt to create the directory
    //         if (mkdir($uploadDir, 0755, true)) {
    //             $statusarr["status"] = 1;
    //             $statusarr["msg"] = "Directory created successfully";
    //         } else {
                
    //             $statusarr["status"] = 0;
    //             $statusarr["msg"] = "Failed to create directory.";
    //         }
    //     }
    // }
    
    
	$dbConn= NULL;
    echo json_encode($statusarr);
    return;
}

if (isset($_GET["removeAttachmentFile"]) && isset($_GET["from"])) {
    $statusarr = [];
    $from = $_GET["from"];
    $path = $_GET["removeAttachmentFile"];
    $dir = $_GET["dir"];



    //if ($from == 'college') {
            // Check if the file exists, then delete it
            if (file_exists($path)) {
                unlink($path);
                $statusarr["status"] = 1;
                $statusarr["msg"] = "File removed successfully";
                $statusarr["dir_name"] = $dir;
            }else{
                $statusarr["status"] = 0;
                $statusarr["msg"] = "There is some problem with the data. Please try again";
            }
    //}
    
    // if($from == 'university'){
    //     if (file_exists($path)) {
    //         unlink($path);
    //         $statusarr["status"] = 1;
    //         $statusarr["msg"] = "File removed successfully";
    //         $statusarr["dir_name"] = $dir;
    //     }else{
    //         $statusarr["status"] = 0;
    //         $statusarr["msg"] = "There is some problem with the data. Please try again";
    //     }
    // }
    


    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}
