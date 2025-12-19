<?php
session_start();

// Check if student is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body>

<h1>Student Dashboard</h1>
<p>Welcome, <?php echo $_SESSION['username']; ?> (Student)</p>

<h3>Student Options</h3>
<ul>
    <li><a href="view_attendance.php">View Attendance</a></li>
    <li><a href="view_marks.php">View Marks</a></li>
    <li><a href="view_courses.php">View Enrolled Courses</a></li>
</ul>

<a href="../logout.php">Logout</a>

</body>
</html>
