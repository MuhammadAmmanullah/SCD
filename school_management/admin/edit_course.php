<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include "../config/db.php";

$course_id = $_GET['id'];

// Fetch course
$course = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM courses WHERE course_id = $course_id"
));

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $teacher_id = $_POST['teacher_id'];

    $update = "UPDATE courses 
               SET name='$name', teacher_id='$teacher_id'
               WHERE course_id = $course_id";

    mysqli_query($conn, $update);
    header("Location: manage_courses.php");
    exit;
}

// Fetch teachers for dropdown
$teachers = mysqli_query($conn, "SELECT * FROM teachers");
?>

<form method="POST">
    <h2>Edit Course</h2>

    Course Name: <input type="text" name="name" value="<?= $course['name'] ?>" required><br><br>

    Teacher:
    <select name="teacher_id">
        <?php while ($t = mysqli_fetch_assoc($teachers)) { ?>
            <option value="<?= $t['teacher_id'] ?>"
                <?= ($t['teacher_id'] == $course['teacher_id']) ? "selected" : "" ?>>
                <?= $t['name'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    <button type="submit">Update Course</button>
</form>
