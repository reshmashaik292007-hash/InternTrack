<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "interntrack";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    // Check if database exists by trying without database
    $temp_conn = mysqli_connect($host, $username, $password);
    if ($temp_conn) {
        mysqli_close($temp_conn);
        // Database connection failed but MySQL is running - database doesn't exist
        header("Location: /InternTrack/setup_database.php");
        exit();
    } else {
        // MySQL not running at all
        die("<h2>Database Connection Error</h2>
            <p>Error: " . mysqli_connect_error() . "</p>
            <p>Please ensure:</p>
            <ul>
                <li>MySQL/MariaDB is running</li>
                <li>XAMPP is started</li>
                <li>The database 'interntrack' exists</li>
            </ul>
            <p>If this is your first time, visit: <a href='/InternTrack/setup_database.php'>Setup Database</a></p>");
    }
}

?>