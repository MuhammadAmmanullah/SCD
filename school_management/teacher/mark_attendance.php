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
    foreach ($_POST['attendance'] as $student_id => $status) {
        mysqli_query($conn,
            "INSERT INTO attendance (student_id, status, date)
             VALUES ($student_id, '$status', CURDATE())"
        );
    }
    echo "Attendance Saved!";
}
?>

<h2>Mark Attendance</h2>

<form method="POST">
<table border="1" cellpadding="5">
<tr>
    <th>Student</th>
    <th>Status</th>
</tr>

<?php while ($s = mysqli_fetch_assoc($students)) { ?>
    <tr>
        <td><?= $s['name'] ?></td>
        <td>
            <select name="attendance[<?= $s['student_id'] ?>]">
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
            </select>
        </td>
    </tr>
<?php } ?>

</table>
<br>
<button type="submit">Submit Attendance</button>

</form>
