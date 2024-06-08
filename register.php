<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_7";

// Cconnection created
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (matric, name, role, password) VALUES ('$matric', '$name', '$role', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Echo JavaScript to show a pop-up message and redirect to login page again
        echo '<script>alert("New record created successfully"); window.location.href = "login.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>