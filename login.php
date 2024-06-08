<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        form {
            width: 300px;
            margin: 0 auto;
            margin-top: 90px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 93%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            color: blue;  /* Make the hyperlink blue */
            text-decoration: underline;  /* Underline the hyperlink */
        }

        .center-text {
            text-align: center;  /* Align the text in this class to the center */
        }

        .error-message {
            width: 300px;
            margin: 20px auto;
            padding: 10px;
            background-color: #ffdddd;
            border: 1px solid #ff8888;
            border-radius: 6px;
            color: #d8000c;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo "<div class='error-message'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']);
    }
    ?>
    <form action="authenticate.php" method="post">
        <h1>Login</h1>
        Matric: <input type="text" name="matric" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <p class="center-text"> <a href="index.php">Register</a> here if you do not have an account.</p>
</body>
</html>