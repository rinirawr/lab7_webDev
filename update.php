<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

//database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_7";

$updated_message = '';

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT matric, name, role FROM users WHERE matric=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "No user found with the given matric.";
        exit;
    }
    $stmt->close();
    $conn->close();
}

if (isset($_POST['update'])) {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET name=?, role=? WHERE matric=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $role, $matric);

    if ($stmt->execute() === TRUE) {
        $updated_message = "Updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 300px;
            padding: 20px;
            margin: auto;
            margin-top: 60px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"], select {
            width: calc(100% - 12px);
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            width: calc(100% - 12px);
            padding: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .cancel-link {
            display: inline-block;
            margin-top: 10px;
            text-align: center;
            width: 100%;
        }

        .cancel-link a {
            color: #0000EE;
            text-decoration: none;
        }

        .cancel-link a:hover {
            text-decoration: underline;
        }

        .updated-message {
            text-align: center;
            color: green;
            margin-bottom: 10px;
        }
    </style>
    <script>
        window.onload = function() {
            <?php if (!empty($updated_message)) : ?>
                alert("<?php echo $updated_message; ?>");
                window.location.href = "display.php";
            <?php endif; ?>
        };
    </script>
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <?php if (!empty($updated_message)) : ?>
            <div class="updated-message"><?php echo $updated_message; ?></div>
        <?php endif; ?>
        <form action="update.php" method="POST">
            <label for="matric">Matric:</label>
            <input type="text" name="matric" value="<?php echo $user['matric']; ?>" readonly style="background-color: #f2f2f2; color: #666;"><br>
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>
            <label for="role">Access Level:</label>
            <select name="role" required>
                <option value="lecturer" <?php if ($user['role'] == 'lecturer') echo "selected"; ?>>Lecturer</option>
                <option value="student" <?php if ($user['role'] == 'student') echo "selected"; ?>>Student</option>
            </select><br>
            <input type="submit" name="update" value="Update">
            <div class="cancel-link"><a href="display.php">Cancel</a></div>
        </form>
    </div