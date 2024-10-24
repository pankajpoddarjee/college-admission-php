<?php
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
// Set the base directory
// $baseDirectory = "../../uploads/notices";
// if(isset($from)){
//     $baseDirectory = "../../uploads/notices/$from"; 
// }
// if(isset($from) && isset($id)){
// $baseDirectory = "../../uploads/notices/$from/$id";
// }
$baseDirectory = "../../uploads/notices/$from/$id";
$directoryStructure = getDirectoryStructure($baseDirectory);

// Return the directory structure as JSON
header('Content-Type: application/json');
echo json_encode($directoryStructure);
?>
