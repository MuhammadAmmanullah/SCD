<?php
session_start();
include "../config/db.php";

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM courses WHERE course_id = $id");

header("Location: manage_courses.php");
exit();
