<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && $role == 'student') {
    if (!empty($_POST['particular']) && !empty($_POST['quantity'])) {
        $student_name = $_SESSION['username'];
        $hostel_code = $_POST['hostel_code'];
        $selected_items = $_POST['particular'];
        $quantities = $_POST['quantity'];

        foreach ($selected_items as $index => $particular) {
            $quantity = intval($quantities[$index]);

            if ($quantity > 0) {
                $sql = "INSERT INTO laundry (student_id, student_name, hostel_code, particular, quantity) 
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isssi", $user_id, $student_name, $hostel_code, $particular, $quantity);
                $stmt->execute();
                $stmt->close();
            }
        }

        echo "<script>alert('Laundry request added successfully!');</script>";
        header("Location: student_dashboard.php");
    } else {
        echo "<script>alert('Please select at least one item and enter quantity.');</script>";
    }
}

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
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .container {
            width: 60%;
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
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        input[type="number"] {
            width: 60px;
            text-align: center;
        }
        .btn {
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
            margin-top: 10px;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style> -->
    <script>
        function calculateTotal() {
            let total = 0;
            let quantityInputs = document.querySelectorAll("input[name='quantity[]']");
            quantityInputs.forEach(input => {
                total += parseInt(input.value) || 0;
            });
            document.getElementById("totalQuantity").innerText = total;
        }
    </script>
</head>
<body>
<?php include 'navbar.php'; ?> 
    <div class="container">
        <h2>Laundry Management</h2>

        <?php if ($role == 'student') { ?>
            <h3>Request Laundry</h3>
            <form action="laundary.php" method="POST">
                <input type="text" name="hostel_code" placeholder="Hostel Code" required>
                
                <table>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Particular</th>
                        <th>Quantity</th>
                    </tr>
                    <?php
                    $items = ['Shirt', 'Pant', 'Towel', 'Bedsheet', 'Other'];
                    foreach ($items as $index => $item) {
                        echo "<tr>
                                <td>".($index+1)."</td>
                                <td>
                                     <input type='hidden' name='particular[]' value='$item'>$item
                                </td>
                                <td>
                                    <input type='number' name='quantity[]' value='0' min='0' onchange='calculateTotal()'>
                                </td>
                              </tr>";
                    }
                    ?>
                    <tr>
                        <td colspan="2"><strong>Total Quantity</strong></td>
                        <td><strong id="totalQuantity">0</strong></td>
                    </tr>
                </table>

                <button type="submit" class="btn" style="margin-top: 0.5%;">Request Laundry</button>
            </form>
        <?php } ?>

        <?php if ($role == 'admin') { ?>
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
                $result = $conn->query("SELECT * FROM laundry");
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
        <?php } ?>
    </div>
</body>
</html>
