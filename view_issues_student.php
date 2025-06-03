<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit();
}

$student_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Issues</title>
    <!-- Add this in your HTML <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .btn {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: red;
            color: white;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: darkred;
        }
    </style> -->
</head>
<body>
<?php include 'navbar.php'; ?> 
    <div class="container">
        <h2>My Raised Issues</h2>

        <table>
            <tr>
            <th>#</th>
        <th>Subject</th>
        <th>Details</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Admin Comments</th>
        <th>Action Taken</th>
        <th>Resolved On</th>
        <th>Date of Issue</th>
            </tr>
            <?php
            $sql = "SELECT * FROM issues WHERE raised_by = ? ORDER BY issue_id DESC";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $student_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $sr = 1;
            while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>{$sr}</td>
                    <td>{$row['subject']}</td>
                    <td>{$row['details']}</td>
                    <td>{$row['priority']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['admin_comments']}</td>
                    <td>{$row['action_taken']}</td>
                    <td>{$row['action_resolve_date']}</td>
                    <td>{$row['date_of_issue']}</td>
                    </tr>";
                $sr++;
            }

            $stmt->close();
            ?>
        </table>

        <a href="student_dashboard.php" style="margin-top: 1.5%;" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
