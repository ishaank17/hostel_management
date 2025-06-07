<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ./");
    exit();
}

$sql = "SELECT issues.*, users.username FROM issues JOIN users ON issues.raised_by = users.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>Manage Issues</title>
    <!-- Add this in your HTML <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include"navbar.php"; ?>
    <div class="container table-responsive">
        <h2>Manage Student Issues</h2>
    <table border="1" >
        <tr>
            <th scope="col">Issue ID</th>
            <th scope="col">Raised By</th>
            <th scope="col">Subject</th>
            <th scope="col">Details</th>
            <th scope="col">Date</th>
            <th scope="col">Priority</th>
            <th scope="col">Status</th>
            <th scope="col">Admin Comments</th>
            <th scope="col">Action</th>
            <th scope='col'>Priority</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr scope="row">
                <td><?php echo $row['issue_id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['details']; ?></td>
                <td><?php echo $row['date_of_issue']; ?></td>
                <td><?php echo ucfirst($row['priority']); ?></td>
                <td><?php echo ucfirst($row['status']); ?></td>
                <td><?php echo $row['admin_comments'] ?: 'No Comments'; ?></td>
                <td>
                    <a href="update_issue.php?id=<?php echo $row['issue_id']; ?>">Update</a>
                </td>
                <td>
                    <a href="change_priority.php?id=<?=$row['issue_id']?>&p=<?=$row['priority']?>">Change Priority</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
</body>
</html>
