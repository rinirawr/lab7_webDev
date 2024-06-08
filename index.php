<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        form {
            width: 300px;
            margin: 0 auto;
            margin-top: 30px;
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

        .center-text {
            text-align: center;  /* Align the text in this class to the center */
        }

    </style>
</head>
<body>
    <form action="register.php" method="post">
        <h1>Registration</h1>
        <label for="matric">Matric:</label>
        <input type="text" name="matric" id="matric" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="Student">Student</option>
            <option value="Lecturer">Lecturer</option>
        </select><br>

        <input type="submit" value="Register">
    </form>
    
    <p class="center-text">Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>