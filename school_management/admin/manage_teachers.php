<?php
session_start();
include "../config/db.php";

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$teachers = mysqli_query($conn, "
    SELECT teachers.*, users.username 
    FROM teachers 
    LEFT JOIN users ON teachers.user_id = users.user_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Teachers</title>
</head>
<body>

<h2>Manage Teachers</h2>
<a href="add_teacher.php">+ Add New Teacher</a><br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>Subject</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($teachers)) { ?>
        <tr>
            <td><?= $row['teacher_id'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['subject'] ?></td>
            <td>
                <a href="edit_teacher.php?id=<?= $row['teacher_id'] ?>">Edit</a> |
                <a href="delete_teacher.php?id=<?= $row['teacher_id'] ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

<br>
<a href="../admin_dashboard.php">Back to Dashboard</a>

</body>
</html>
