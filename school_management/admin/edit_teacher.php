<?php
session_start();
include "../config/db.php";

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn, "
    SELECT teachers.*, users.username, users.password 
    FROM teachers
    LEFT JOIN users ON teachers.user_id = users.user_id
    WHERE teacher_id = $id
");

$teacher = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];

    mysqli_query($conn, "
        UPDATE users 
        SET username='$username', password='$password'
        WHERE user_id = {$teacher['user_id']}
    ");

    mysqli_query($conn, "
        UPDATE teachers
        SET name='$name', subject='$subject'
        WHERE teacher_id = $id
    ");

    header("Location: manage_teachers.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Teacher</title>
</head>
<body>

<h2>Edit Teacher</h2>

<form method="POST">

    Username: <input type="text" name="username" value="<?= $teacher['username'] ?>"><br><br>
    Password: <input type="text" name="password" value="<?= $teacher['password'] ?>"><br><br>

    Name: <input type="text" name="name" value="<?= $teacher['name'] ?>"><br><br>
    Subject: <input type="text" name="subject" value="<?= $teacher['subject'] ?>"><br><br>

    <button type="submit">Update</button>

</form>

<a href="manage_teachers.php">Back</a>

</body>
</html>
