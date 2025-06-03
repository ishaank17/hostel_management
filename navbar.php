<?php ob_start();
 ?>
<div class="navbar">
        <div class="arrow" onclick="window.history.back();">&#8592;</div>
        <?php if($_SESSION['role']=="student"){?>
            <ul>
            <li><a href="student_dashboard.php">Home</a></li>
            <li><a href="raise_issue.php">Raise Issue</a></li>
            <li><a href="view_issues_student.php">My Issues</a></li>
            <li><a href="tuition.php">Tution</a></li>
            <li><a href="laundary.php">Laundary</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
            <?php } else {?>
        <ul>
            <li><a href="admin_dashboard.php">Home</a></li>
            <li><a href="manage_issues_admin.php">Student Issues</a></li>
            <li><a href="tuition.php">Tution</a></li>
            <li><a href="laundary.php">Laundary</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <?php }?>
</div>