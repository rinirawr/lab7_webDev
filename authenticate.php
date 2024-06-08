<?php
session_start();
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['role'] = $user['role'];
            header("Location: display.php");
        } else {
            // Echo JavaScript to show a pop-up message and redirect to login page
            echo '<script>alert("Invalid matric number or password."); window.location.href = "login.php";</script>';
        }
    } else {
        // Echo JavaScript to show a pop-up message and redirect to login page
        echo '<script>alert("Invalid matric number or password."); window.location.href = "login.php";</script>';
    }
    $conn->close();
}
?>