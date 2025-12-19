<?php
session_start();
if ($_SESSION['role'] !== 'teacher') {
    header("Location: ../login.php");
    exit;
}

include "../config/db.php";

// Fetch students
$students = mysqli_query($conn, "SELECT * FROM students");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    $query = "INSERT INTO marks (student_id, subject, marks)
              VALUES ($student_id, '$subject', $marks)";

    mysqli_query($conn, $query);
    echo "Marks Saved!";
}
?>

<h2>Add Marks</h2>
<form method="POST">

Student:
<select name="student_id">
<?php while ($s = mysqli_fetch_assoc($students)) { ?>
    <option value="<?= $s['student_id'] ?>"><?= $s['name'] ?></option>
<?php } ?>
</select><br><br>

Subject: <input type="text" name="subject" required><br><br>
Marks: <input type="number" name="marks" required><br><br>

<button type="submit">Save Marks</button>

</form>
