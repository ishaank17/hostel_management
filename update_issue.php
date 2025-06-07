<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ./");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $issue_id = $_POST['issue_id'];

    $status = $_POST['status'];
    $admin_comments = $_POST['admin_comments'];
    $action_taken = $_POST['action_taken'];
    $action_resolve_date = $_POST['action_resolve_date'];

    $sql = "UPDATE issues SET status=?, admin_comments=?, action_taken=?, action_resolve_date=?  WHERE issue_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $status, $admin_comments, $action_taken, $action_resolve_date, $issue_id);
    echo $sql;
    if ($stmt->execute()) {
        $sql = "SELECT email from users where id= (SELECT raised_by FROM issues where issue_id=$issue_id)";
        // echo $sql;
        $row=$conn->query($sql)->fetch_assoc();

        // echo var_dump($row["email"]);
        $email=$row['email'];
        echo "change.py $email";
        shell_exec("python change.py $email");
        header("location: manage_issues_admin.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}

$issue_id = $_GET['id'];
$sql = "SELECT * FROM issues WHERE issue_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $issue_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Issue</title>
    <!-- Add this in your HTML <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include"navbar.php"; ?>
    <div class="container">
        <form method="POST">
        <input type="hidden" name="issue_id" value="<?php echo $issue_id; ?>">
        <label>Status:</label>
        <select name="status">
            <option value="open">Open</option>
            <option value="work in progress">Work in Progress</option>
            <option value="postpone">Postpone</option>
            <option value="resolved">Resolved</option>
        </select>
        <br><br>
        <label>Admin Comments:</label>
        <textarea name="admin_comments"></textarea>
        <br><br>
        <label>Action Taken:</label>
        <textarea name="action_taken"></textarea>
        <br><br>
        <label>Action Resolve Date:</label>
        <input type="date" name="action_resolve_date">
        <br><br>
        <button type="submit">Update Issue</button>
    </form>
    </div>
</body>
</html>
