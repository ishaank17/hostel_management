<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ./");
    exit();
}

$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remedial  Management</title>
    <!-- Add this in your HTML <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    
</head>
<body >
<?php include 'navbar.php'; ?> 
    <div class="container table-responsive">
        <h2>Remedial Management</h2>
            <h3>Remedial Records</h3>
            <table border="1" cellpadding="10" cellspacing="0" width="100%" >
                <tr>
                    <th>Student Name</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Subject</th>
                    <th>Location</th>
                    <th>Date</th>
                </tr>
                <tbody>
                    <?php
                $sql="SELECT * FROM tuitions WHERE student_id=$user_id";
                    $res = $conn->query($sql);
                // echo "SELECT * FROM tuitions WHERE student_id=$user_id";

                while ($row = $res->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['student_name']}</td>
                            <td>{$row['day']}</td>
                            <td>{$row['from_time']} - {$row['to_time']}</td>
                            <td>{$row['subject']}</td>
                            <td>{$row['location']}</td>
                            <td>{$row['tuition_date']}</td>
                        </tr>";
                }
                ?>
                </tbody>
            </table>
    </div>
</body>
</html>
