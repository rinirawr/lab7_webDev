<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Lab_7";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM users WHERE matric='$matric'";
    if ($conn->query($sql) === TRUE) {
        // Echo JavaScript to show a pop-up message and redirect to display page again
        echo '<script>alert("Record deleted successfully."); window.location.href = "display.php";</script>';
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>