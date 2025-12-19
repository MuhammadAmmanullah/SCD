<?php
session_start();

// If not logged in → redirect
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

echo "<h1>Admin Dashboard</h1>";
echo "<p>Welcome, " . $_SESSION['username'] . " (Admin)</p>";

echo "<h3>Admin Functions</h3>";

echo "<ul>
        <li><a href='manage_students.php'>Manage Students</a></li>
        <li><a href='manage_teachers.php'>Manage Teachers</a></li>
        <li><a href='manage_courses.php'>Manage Courses</a></li>
        <li><a href='assign_course.php'>Assign Course to Student</a></li>
        <li><a href='view_enrollments.php'>View Enrollments</a></li>
      </ul>";

echo "<a href='logout.php'>Logout</a>";
?>
