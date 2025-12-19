<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include "../config/db.php";

$student_id = $_GET['id'];

// Delete student record
mysqli_query($conn, "DELETE FROM students WHERE student_id = $student_id");

// You MAY also delete from users table if needed
// mysqli_query($conn, "DELETE FROM users WHERE user_id = (SELECT user_id FROM students WHERE student_id = $student_id)");

header("Location: manage_students.php");
exit;
?>
