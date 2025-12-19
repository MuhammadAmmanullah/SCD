<?php
session_start();
include "config/db.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $class = $_POST['class'];

    // Insert into users table
    $user_sql = "INSERT INTO users (username, password, role) 
                 VALUES ('$username', '$password', 'student')";

    if (mysqli_query($conn, $user_sql)) {

        $user_id = mysqli_insert_id($conn);

        // Insert into students table
        $student_sql = "INSERT INTO students (user_id, name, age, class)
                        VALUES ($user_id, '$name', $age, '$class')";

        mysqli_query($conn, $student_sql);

        echo "Student added successfully!";
    } else {
        echo "Error: username already exists!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add Student</h2>

<form method="POST">

    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>

    Name: <input type="text" name="name" required><br><br>
    Age: <input type="number" name="age" required><br><br>
    Class: <input type="text" name="class" required><br><br>

    <button type="submit" name="register">Add Student</button>

</form>

</body>
</html>
