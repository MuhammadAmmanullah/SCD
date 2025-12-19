<?php
session_start();
include "../config/db.php";

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

// Find user_id
$result = mysqli_query($conn, "SELECT user_id FROM teachers WHERE teacher_id = $id");
$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];

// Delete teacher
mysqli_query($conn, "DELETE FROM teachers WHERE teacher_id = $id");

// Delete login user
mysqli_query($conn, "DELETE FROM users WHERE user_id = $user_id");

header("Location: manage_teachers.php");
exit();
