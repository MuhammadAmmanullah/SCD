<?php
include("config/db.php");

// Delete enrollment
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM enrollments WHERE enrollment_id = $id");
}

// Fetch enrollments with student + course names
$sql = "
SELECT enrollments.enrollment_id, students.name AS student_name, courses.course_name 
FROM enrollments
JOIN students ON enrollments.student_id = students.student_id
JOIN courses ON enrollments.course_id = courses.course_id
";

$enrollments = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Enrollments</title>
</head>
<body>

<h2>All Enrollments</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Student</th>
        <th>Course</th>
        <th>Action</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($enrollments)) { ?>
        <tr>
            <td><?= $row['enrollment_id'] ?></td>
            <td><?= $row['student_name'] ?></td>
            <td><?= $row['course_name'] ?></td>
            <td><a href="?delete=<?= $row['enrollment_id'] ?>">Delete</a></td>
        </tr>
    <?php } ?>
</table>

<br>
<a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
