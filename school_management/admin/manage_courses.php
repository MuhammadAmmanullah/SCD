<?php
session_start();
include "../config/db.php";

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$courses = mysqli_query($conn, "
    SELECT courses.*, teachers.name AS teacher_name
    FROM courses
    LEFT JOIN teachers ON courses.teacher_id = teachers.teacher_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Courses</title>
</head>
<body>

<h2>Manage Courses</h2>
<a href="add_course.php">+ Add New Course</a><br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Course Name</th>
        <th>Teacher</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($courses)) { ?>
        <tr>
            <td><?= $row['course_id'] ?></td>
            <td><?= $row['course_name'] ?></td>
            <td><?= $row['teacher_name'] ?></td>
            <td>
                <a href="edit_course.php?id=<?= $row['course_id'] ?>">Edit</a> |
                <a href="delete_course.php?id=<?= $row['course_id'] ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

<br>
<a href="../admin_dashboard.php">Back</a>

</body>
</html>
