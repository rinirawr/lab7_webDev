<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 3px;
        }

        .actions a.delete {
            background-color: #f44336;
        }

        .actions a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Registration</h1>

        <?php
        session_start();
        if (!isset($_SESSION['loggedin'])) {
            header('Location: login.php');
            exit;
        }

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

        $sql = "SELECT matric, name, role FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Matric</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["matric"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["role"] . "</td>
                        <td class='actions'>
                            <a href='update.php?matric=" . $row["matric"] . "'>Update</a>
                            <a class='delete' href='delete.php?matric=" . $row["matric"] . "'>Delete</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No users found.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>