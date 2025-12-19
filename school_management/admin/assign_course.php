<?php
include("config/db.php");

// Fetch students
$students = mysqli_query($conn, "SELECT student_id, name FROM students");

// Fetch courses
$courses = mysqli_query($conn, "SELECT course_id, course_name FROM courses");

// Handle form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $course_id = $_POST["course_id"];

    $sql = "INSERT INTO enrollments (student_id, course_id) VALUES ('$student_id', '$course_id')";

    if (mysqli_query($conn, $sql)) {
        $message = "Course assigned successfully!";
    } else {
        $message = "Error assigning course: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Courses</title>
</head>
<body>
<h2>Assign Course to Student</h2>

<?php if ($message) echo "<p><b>$message</b></p>"; ?>

<form method="post">
    <label>Select Student:</label><br>
    <select name="student_id" required>
        <option value="">--Select--</option>
        <?php while ($s = mysqli_fetch_assoc($students)) { ?>
            <option value="<?= $s['student_id'] ?>"><?= $s['name'] ?></option>
        <?php } ?>
    </select>
    <br><br>

    <label>Select Course:</label><br>
    <select name="course_id" required>
        <option value="">--Select--</option>
        <?php while ($c = mysqli_fetch_assoc($courses)) { ?>
            <option value="<?= $c['course_id'] ?>"><?= $c['course_name'] ?></option>
        <?php } ?>
    </select>
    <br><br>

    <button type="submit">Assign Course</button>
</form>

<br>
<a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
