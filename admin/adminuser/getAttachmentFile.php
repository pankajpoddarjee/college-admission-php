<?php
include_once "../configuration.php";

// Function to get all files under a specified directory (non-recursive)
function getFilesInDirectory($dir, $from, $id, $year_directory, $newdirectory) {
    $filesList = [];

    if (is_dir($dir)) {
        // Scan the directory
        $files = scandir($dir);

        // Loop through each item in the directory
        foreach ($files as $file) {
            if ($file !== "." && $file !== "..") {
                $fullPath = $dir . DIRECTORY_SEPARATOR . $file;

                // Check if it's a file and not a directory
                if (is_file($fullPath)) {
                    $filesList[] = [
                        'link' => BASE_URL_UPLOADS.'/notices/'.$from.'/'.$id.'/'.$year_directory.'/'.$newdirectory.'/'.$file, // File link
                        'path' => $dir.'/'.$file, 
                        'id' => $id         // Full path to the file on the server
                    ];
                }
            }
        }
    }

    return $filesList;
}

// Get values from URL parameters
$from = $_GET["from"];
$notice_id = $_GET["notice_id"];
$id = $_GET["id"];
$year_directory = $_GET["year_directory"];
$dir = $_GET["dir"];

// Define the base directory based on the URL parameters
$baseDirectory = "../../uploads/notices/$from/$id/$year_directory/$dir";

// Get all files in the specified directory
$files = getFilesInDirectory($baseDirectory, $from, $id, $year_directory, $dir);

// Print the files array (for debugging)
// echo "<pre>";
// print_r($files); die;

// Return the list of files as JSON
header('Content-Type: application/json');
echo json_encode($files);
?>
