<?php
session_start();
include "../config/db.php";

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];

    // 1. Create user (login)
    $insertUser = mysqli_query($conn, "
        INSERT INTO users (username, password, role)
        VALUES ('$username', '$password', 'teacher')
    ");

    $user_id = mysqli_insert_id($conn);

    // 2. Create teacher record
    $insertTeacher = mysqli_query($conn, "
        INSERT INTO teachers (user_id, name, subject)
        VALUES ('$user_id', '$name', '$subject')
    ");

    if ($insertUser && $insertTeacher) {
        $message = "Teacher added successfully!";
    } else {
        $message = "Error adding teacher.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Teacher</title>
</head>
<body>

<h2>Add Teacher</h2>
<p><?= $message ?></p>

<form method="POST">

    Username: <input type="text" name="username" required><br><br>
    Password: <input type="text" name="password" required><br><br>

    Name: <input type="text" name="name" required><br><br>
    Subject: <input type="text" name="subject" required><br><br>

    <button type="submit">Add Teacher</button>

</form>

<a href="manage_teachers.php">Back</a>

</body>
</html>
