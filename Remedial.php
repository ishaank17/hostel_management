<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ./");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && $role == 'student') {
    $student_name = $_SESSION['username'];
    $day = $_POST['day'];
    $from_time = $_POST['from_time'];
    $to_time = $_POST['to_time'];
    $subject = $_POST['subject'];
    $location = $_POST['location'];
    $tuition_date = $_POST['tuition_date'];

    $sql = "INSERT INTO tuitions (student_id, student_name, day, from_time, to_time, subject, location, tuition_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssss", $user_id, $student_name, $day, $from_time, $to_time, $subject, $location, $tuition_date);
    
    if ($stmt->execute()) {
        echo "<script>alert('Remedial added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding Remedial.');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remedial Management</title>
    <!-- Add this in your HTML <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    
</head>
<body >
<?php include 'navbar.php'; ?> 
    <div class="container table-responsive">
        <h2>Remedial Management</h2>
        
        <?php if ($role == 'student') {?>
            <h3>Register for Remedial</h3>
            <form action="Remedial.php" method="POST">
                <select name="day" required>
                    <option hidden disabled selected>Select Day</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                    <option>Saturday</option>
                    <option>Sunday</option>
                </select>
                <input type="time" name="from_time" required>
                <input type="time" name="to_time" required>
                <select name="subject" required>
                    <option hidden disabled selected>Select Subject</option>
                    <?php if ($_SESSION["grade"]<=10){?>
                        <option>Accounting</option>
                        <option>Biology</option>
                        <option>Business Studies</option>
                        <option>Chemistry</option>
                        <option>Computer-Science</option>
                        <option>Design and Technology</option>
                        <option>Economics</option>
                        <option>English</option>
                        <option>Environmental Studies</option>
                        <option>French</option>
                        <option>Global Perspectives</option>
                        <option>Geography</option>
                        <option>Hindi</option>
                        <option>History</option>
                        <option>ICT</option>
                        <option>Mathematics Additional</option>
                        <option>Mathematics International</option>
                        <option>Mathematics Extended</option>
                        <option>Music</option>
                        <option>PE</option>
                        <option>Physics</option>
                        <option>Psychology</option>
                        <option>Spanish</option>
                    <?php } else if ($_SESSION["grade"]>10){ ?>
                        <option>Math AA [HL]</option>
                        <option>Maths AA [SL]</option>
                        <option>Maths AI [HL]</option>
                        <option>Maths A1 [SL]</option>
                        <option>Physics [HL/SL]</option>
                        <option>Chemistry [HL/SL]</option>
                        <option>Biology [HL/SL]</option>
                        <option>CS [HL/SL]</option>
                        <option>ESAS [HL/SL]</option>
                        <option>History [HL/SL]</option>
                        <option>Visual Arts [HL/SL]</option>
                        <option>Hindi [HL/SL]</option>
                        <option>Spanish Ab [HL/SL]</option>
                        <option>Spanish B [HL/SL]</option>
                        <option>French Ab [HL/SL]</option>
                        <option>French B [HL/SL]</option>
                        <option>English [HL/SL]</option>
                        <option>Economics [HL/SL]</option>
                        <option>Psychology [HL/SL]</option>
                        <option>BM [HL/SL]</option>
                    <?php }?>
                </select>
                <input type="text" name="location" placeholder="Location" required>
                <input type="date" name="tuition_date" required>
                <button type="submit" class="btn">Register</button>
            </form>
        <?php } ?>

        <?php if ($role == 'admin') { ?>
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
                <?php
                $result = $conn->query("SELECT * FROM tuitions");
                while ($row = $result->fetch_assoc()) {
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
            </table>
        <?php } ?>
    </div>
</body>
</html>
