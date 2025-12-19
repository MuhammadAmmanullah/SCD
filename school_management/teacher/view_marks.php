<?php
session_start();
include "../config/db.php";

// Check teacher login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../login.php");
    exit();
}

// Fetch teacher ID based on logged-in username
$teacherUser = $_SESSION['username'];
$getTeacher = mysqli_query($conn, "SELECT teacher_id FROM teachers 
                                   JOIN users ON teachers.user_id = users.user_id
                                   WHERE users.username='$teacherUser'");
$rowT = mysqli_fetch_assoc($getTeacher);
$teacher_id = $rowT['teacher_id'];

// Fetch marks entered by this teacher
$sql = "SELECT marks.mark_id, marks.marks, marks.exam_type,
               students.name AS student_name, courses.course_name
        FROM marks
        JOIN students ON marks.student_id = students.student_id
        JOIN courses ON marks.course_id = courses.course_id
        WHERE marks.teacher_id = $teacher_id
        ORDER BY marks.mark_id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Marks</title>
</head>
<body>

<h2>Marks Records</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Student</th>
        <th>Course</th>
        <th>Exam</th>
        <th>Marks</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['student_name'] ?></td>
            <td><?= $row['course_name'] ?></td>
            <td><?= $row['exam_type'] ?></td>
            <td><?= $row['marks'] ?></td>
        </tr>
    <?php } ?>

</table>

<br>
<a href="teacher_dashboard.php">⬅ Back to Dashboard</a>

</body>
</html>
