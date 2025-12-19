<?php
session_start();

// Only teachers can access this page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../login.php");
    exit;
}

include "../config/db.php";

// Fetch all students
$query = "SELECT student_id, name, age, class FROM students ORDER BY class, name";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
</head>
<body>

<h2>All Students</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Class</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['student_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['age'] ?></td>
            <td><?= $row['class'] ?></td>
        </tr>
    <?php } ?>
</table>

<br>
<a href="../teacher_dashboard.php">Back to Dashboard</a>

</body>
</html>
