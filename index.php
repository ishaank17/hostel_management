<?php
session_start();
include 'db.php'; // Make sure this file contains your DB connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Prepare SQL query to fetch user details
    $sql = "SELECT id, username,email, password, role,grade FROM users WHERE username = ? AND role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['grade'] = $user['grade'];
            $_SESSION['email'] = $user['email'];
            // Redirect based on role
            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: student_dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Invalid username or role!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hostel Management</title>
    <!-- Add this in your HTML <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            text-align: center;
        }
        .navbar {
            background: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .container {
            margin-top: 50px;
            padding: 20px;
            max-width: 400px;
            background: white;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style> -->
</head>
<body>

    <div class="navbar">
        <h2>Hostel Management System - Login</h2>
    </div>
    <div class="container">
        <h1>Login</h1>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role">
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
