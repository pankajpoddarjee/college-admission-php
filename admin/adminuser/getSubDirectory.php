<?php

// Function to get subdirectories under 2022 directory
function getSubdirectories($directories, $directoryName) {
    $subDir = [];
    foreach ($directories as $directory) {
        if ($directory['name'] === $directoryName && $directory['type'] === 'directory') {
            // Iterate through children and print subdirectories
            foreach ($directory['children'] as $child) {
                if ($child['type'] === 'directory') {
                    //echo "Subdirectory: " . $child['name'] . "\n";
                    $subDir[] = $child['name'];
                    // Recursively print subdirectories of subdirectories
                    if (isset($child['children'])) {
                        getSubdirectories([$child], $child['name']);
                    }
                }
            }
        }
    }
    return $subDir;
}

function getDirectoryStructure($dir) {
    $result = [];
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file !== "." && $file !== "..") {
                $fullPath = $dir . DIRECTORY_SEPARATOR . $file;
                if (is_dir($fullPath)) {
                    $result[] = [
                        'name' => $file,
                        'type' => 'directory',
                        'path' => $fullPath,
                        'children' => getDirectoryStructure($fullPath)
                    ];
                } else {
                    $result[] = [
                        'name' => $file,
                        'type' => 'file',
                        'path' => $fullPath
                    ];
                }
            }
        }
    }
    return $result;
}
$from = $_GET["from"];
$id = $_GET["id"];
$dir = $_GET["dir"];
$baseDirectory = "../../uploads/notices/$from/$id";
$directoryStructure = getDirectoryStructure($baseDirectory);

$sub_directory = getSubdirectories($directoryStructure, $dir);
//echo "<pre>"; print_r($directoryStructure); 
  //  $base_directory = array_column($directoryStructure, 'name');
 //   print_r($base_directory);
// Return the directory structure as JSON
header('Content-Type: application/json');
echo json_encode($sub_directory);
?>
