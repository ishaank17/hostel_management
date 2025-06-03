<?php
include 'db.php'; // Make sure db.php has DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = $_POST['role'];

    $phone = $email = $grade = $parent_name = $parent_phone = $address = $date_of_admission = NULL;

    if ($role == 'student') {
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $grade = $_POST['grade'];
        $parent_name = $_POST['parent_name'];
        $parent_phone = $_POST['parent_phone'];
        $address = $_POST['address'];
        $date_of_admission = $_POST['date_of_admission'];
    }

    $sql = "INSERT INTO users (first_name, last_name, username, password, phone, email, grade, parent_name, parent_phone, address, role, date_of_admission) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssss", $first_name, $last_name, $username, $password, $phone, $email, $grade, $parent_name, $parent_phone, $address, $role, $date_of_admission);

    if ($stmt->execute()) {
        $success = "Registration successful!";
    } else {
        $error = "Error: " . $stmt->error;
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
    <title>Register - Hostel Management</title>
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
        .message {
            margin-top: 15px;
            font-weight: bold;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style> -->
    <script>
        function toggleFields() {
            var role = document.getElementById("role").value;
            var studentFields = document.getElementById("studentFields");

            if (role === "admin") {
                studentFields.style.display = "none";
                document.querySelectorAll("#studentFields input").forEach(input => {
                    input.removeAttribute("required");
                });
            } else {
                studentFields.style.display = "block";
                document.querySelectorAll("#studentFields input").forEach(input => {
                    input.setAttribute("required", "required");
                });
            }
        }

        window.onload = toggleFields; // Run on page load
    </script>
</head>
<body>

    <div class="navbar">
        <h2>Hostel Management System - Register</h2>
    </div>
    <div class="container">
        <h1>Register</h1>
        <?php
        if (!empty($success)) echo "<p class='message success'>$success</p>";
        if (!empty($error)) echo "<p class='message error'>$error</p>";
        ?>
        <form action="register.php" method="POST">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select id="role" name="role" onchange="toggleFields()">
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
            <div id="studentFields">
                <input type="text" name="phone" placeholder="Phone Number">
                <input type="email" name="email" placeholder="Email ID">
                <input type="text" name="grade" placeholder="Grade">
                <input type="text" name="parent_name" placeholder="Parent Name">
                <input type="text" name="parent_phone" placeholder="Parent Phone Number">
                <input type="text" name="address" placeholder="Address">
                <input type="date" name="date_of_admission">
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>
</html>
