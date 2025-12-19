<?php
session_start();
include "config/db.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch all students
$query = "SELECT students.student_id, students.name, students.age, students.class, users.username 
          FROM students 
          JOIN users ON students.user_id = users.user_id";

$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
</head>
<body>

<h2>Manage Students</h2>

<a href="add_student.php">➕ Add New Student</a><br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>Age</th>
        <th>Class</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['student_id'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['age'] ?></td>
            <td><?= $row['class'] ?></td>

            <td>
                <a href="edit_student.php?id=<?= $row['student_id'] ?>">Edit</a> |
                <a href="delete_student.php?id=<?= $row['student_id'] ?>" onclick="return confirm('Delete student?');">Delete</a>
            </td>
        </tr>
    <?php } ?>

</table>

</body>
</html>
