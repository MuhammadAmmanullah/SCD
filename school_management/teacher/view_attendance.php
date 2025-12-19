<?php
session_start();
include "../config/db.php";

// Check teacher login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../login.php");
    exit();
}

// Fetch teacher ID from users table
$teacherUser = $_SESSION['username'];
$getTeacher = mysqli_query($conn, "SELECT teacher_id FROM teachers 
                                   JOIN users ON teachers.user_id = users.user_id
                                   WHERE users.username='$teacherUser'");
$rowT = mysqli_fetch_assoc($getTeacher);
$teacher_id = $rowT['teacher_id'];

// Get attendance records entered by this teacher
$sql = "SELECT attendance.attendance_id, attendance.date, attendance.status,
               students.name AS student_name, courses.course_name
        FROM attendance
        JOIN students ON attendance.student_id = students.student_id
        JOIN courses ON attendance.course_id = courses.course_id
        WHERE attendance.teacher_id = $teacher_id
        ORDER BY attendance.date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Attendance</title>
</head>
<body>

<h2>Attendance Records</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Date</th>
        <th>Student</th>
        <th>Course</th>
        <th>Status</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['date'] ?></td>
            <td><?= $row['student_name'] ?></td>
            <td><?= $row['course_name'] ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
    <?php } ?>

</table>

<br>
<a href="teacher_dashboard.php">⬅ Back to Dashboard</a>

</body>
</html>
