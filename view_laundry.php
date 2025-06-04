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
    <title>Laundry Management</title>
    <!-- Add this in your HTML <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<?php include 'navbar.php'; ?> 
    <div class="container table-responsive">
        <h2>Laundry Management</h2>
            <h3>Laundry Records</h3>
            <table>
                <tr>
                    <th>Sr. No.</th>
                    <th>Student Name</th>
                    <th>Hostel Code</th>
                    <th>Date</th>
                    <th>Particular</th>
                    <th>Quantity</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM laundry where student_id=$user_id");
                $sr = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$sr}</td>
                            <td>{$row['student_name']}</td>
                            <td>{$row['hostel_code']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['particular']}</td>
                            <td>{$row['quantity']}</td>
                        </tr>";
                    $sr++;
                }
                ?>
            </table>
    
    </div>
</body>
</html>
