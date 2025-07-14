<?php 
ob_start();
session_start();
include 'db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ./");
    exit();
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendence Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <style>
      
form {
    display: flex;
    flex-direction: row;
}
input, select, textarea {
      padding: initial;
    margin: initial;
    border: initial;
    border-radius: initial;
    font-size: initial;
}
  .year-filter-container {
    background-color: #ffffffff;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    max-width: 500px;
    margin: 2rem auto;
    font-family: 'Poppins', sans-serif;
  }

  .year-filter-container label {
    font-weight: 500;
    color: #333;
  }

  .year-filter-container input[type="number"] {
    border: 2px solid #2196f3;
    border-radius: 0.75rem;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    transition: all 0.2s ease-in-out;
  }

  .year-filter-container input[type="number"]:focus {
    border-color: #2196f3;
    box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
    outline: none;
  }

  .year-filter-container .btn-primary {
    background-color: #2196f3;
    border: none;
    border-radius: 0.75rem;
    padding: 0.5rem 1.25rem;
    font-weight: 500;
  }

  .year-filter-container .btn-secondary {
    
    border-radius: 0.75rem;
    padding: 0.5rem 1.25rem;
    font-weight: 500;
  }
</style>
</head>
<body style="
  background-image: url('./background.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;">
 <?php include 'navbar.php'?> 

<div class="container table-responsive">

    <table>
    <thead>
        <tr>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th>Attandence %</th>
        <th scope="col">Send Mail</th>
        </tr>
    </thead>
    <tbody>
        <?php 
    
        $sql = "SELECT distinct (student_id) FROM attendence";
        


        $res=$conn->query($sql);
        while($row=$res->fetch_assoc()){
            $id=$row['student_id'];
            $sql1 = "SELECT * FROM users where id=$id ";
            // echo $sql1;
            $row1=$conn->query($sql1)->fetch_assoc();

            $totalQuery = "SELECT COUNT(*) as total FROM attendence WHERE student_id = $id";
            $total = $conn->query($totalQuery)->fetch_assoc()['total'];

            $presentQuery = "SELECT COUNT(*) as present FROM attendence WHERE student_id = $id AND status = 'Present'";
            $present = $conn->query($presentQuery)->fetch_assoc()['present'];

            $percentage = ($total > 0) ? round(($present / $total) * 100, 2) : 0;
            
        ?>
            <tr>
                <td><?=$row1['first_name']?></td>
                <td><?=$row1['last_name']?></td>
                <td><?=$percentage?>%</td>
                <td><a href="mail.php?id=<?=$row1['id']?>">Click Here</a></td>
                
            </tr>
        <?php }?>
    </tbody>
    </table>  
</div>

<script>
  const dateInput = document.getElementById('selectedDate');
  dateInput.addEventListener('change', function () {
    const newDate = this.value;
    const hiddenDates = document.querySelectorAll('.attendanceDate');
    hiddenDates.forEach(input => {
      input.value = newDate;
    });
  });

function submitWithValidation() {
  console.log("started")
  const form = document.getElementById("myForm");
  if (form.checkValidity()) {
    console.log("submit")
    form.submit(); // only if valid
  } else {
    form.reportValidity(); // show browser error popup
  }
}
</script>
</body>

</html>
