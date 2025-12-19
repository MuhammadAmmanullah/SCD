<?php
session_start();
include "../config/db.php";

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "
    SELECT students.*, users.username, users.password 
    FROM students 
    LEFT JOIN users ON students.user_id = users.user_id
    WHERE student_id = $id
");

$student = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $class = $_POST['class'];

    mysqli_query($conn, "UPDATE users SET username='$username', password='$password'
        WHERE user_id = {$student['user_id']}");

    mysqli_query($conn, "
        UPDATE students SET 
        name='$name', age='$age', class='$class'
        WHERE student_id = $id
    ");

    header("Location: manage_students.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h2>Edit Student</h2>

<form method="POST">
    Username: <input type="text" name="username" value="<?= $student['username'] ?>"><br><br>
    Password: <input type="text" name="password" value="<?= $student['password'] ?>"><br><br>

    Name: <input type="text" name="name" value="<?= $student['name'] ?>"><br><br>
    Age: <input type="number" name="age" value="<?= $student['age'] ?>"><br><br>
    Class: <input type="text" name="class" value="<?= $student['class'] ?>"><br><br>

    <button type="submit">Update</button>
</form>

<a href="manage_students.php">Back</a>

</body>
</html>
