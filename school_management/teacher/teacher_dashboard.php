<?php
session_start();

// Teacher role check
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
</head>
<body>

<h1>Teacher Dashboard</h1>
<p>Welcome, <?php echo $_SESSION['username']; ?> (Teacher)</p>

<h3>Teacher Functions</h3>
<ul>
    <li><a href="mark_attendance.php">Mark Attendance</a></li>
    <li><a href="view_attendance.php">View Attendance</a></li>
    <li><a href="add_marks.php">Add Marks</a></li>
    <li><a href="view_marks.php">View Marks</a></li>
    <li><a href="teacher_view_students.php">View Students</a></li>  <!-- NEW FIXED LINK -->
</ul>

<a href="../logout.php">Logout</a>

</body>
</html>
