<?php
session_start();
include 'db.php'; // Database connection

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ./");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $raised_by = $_SESSION['user_id'];
    $subject = $_POST['subject'];
    $details = $_POST['details'];
    $priority = 'normal';

    $sql = "INSERT INTO issues (raised_by, subject, details, priority) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $raised_by, $subject, $details, $priority);

    if ($stmt->execute()) {
        echo "<script>alert('Your Issue has been raised');</script>";
        shell_exec("python raised.py");
        header("Location: student_dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raise Issue</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?> 
    <div class="container">
        <h2>Raise a New Issue</h2>
    <form method="POST">
        <label>Subject:</label>
        <input type="text" name="subject" required>
        <br><br>
        <label>Details:</label>
        <textarea name="details" required></textarea>
        <br><br>
        <button type="submit" class="btn">Submit Issue</button>
    </form>
    </div>
</body>
</html>
