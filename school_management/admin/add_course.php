<?php
session_start();
include "../config/db.php";

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$message = "";

$teachers = mysqli_query($conn, "SELECT * FROM teachers");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $course_name = $_POST['course_name'];
    $teacher_id = $_POST['teacher_id'];

    $insert = mysqli_query($conn, "
        INSERT INTO courses (course_name, teacher_id)
        VALUES ('$course_name', '$teacher_id')
    ");

    $message = $insert ? "Course added successfully!" : "Error adding course.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
</head>
<body>

<h2>Add Course</h2>
<p><?= $message ?></p>

<form method="POST">
    Course Name: <input type="text" name="course_name" required><br><br>

    Teacher:
    <select name="teacher_id" required>
        <option value="">-- Select Teacher --</option>
        <?php while ($t = mysqli_fetch_assoc($teachers)) { ?>
            <option value="<?= $t['teacher_id'] ?>"><?= $t['name'] ?></option>
        <?php } ?>
    </select><br><br>

    <button type="submit">Add Course</button>
</form>

<a href="manage_courses.php">Back</a>

</body>
</html>
