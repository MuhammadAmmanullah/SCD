<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$student_id = intval($_SESSION['student_id'] ?? 0);

if ($student_id <= 0) {
    echo "Student record not found. Please contact admin.";
    exit();
}

$sql = "SELECT c.course_name, m.exam_name, m.marks
        FROM marks m
        JOIN courses c ON m.course_id = c.course_id
        WHERE m.student_id = $student_id
        ORDER BY c.course_name";
$res = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head><title>My Marks</title></head>
<body>
<h2>My Marks</h2>

<?php if ($res && mysqli_num_rows($res) > 0) { ?>
    <table border="1" cellpadding="8">
        <tr><th>Course</th><th>Exam</th><th>Marks</th></tr>
        <?php while ($r = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($r['course_name']); ?></td>
                <td><?php echo htmlspecialchars($r['exam_name'] ?? 'Exam'); ?></td>
                <td><?php echo htmlspecialchars($r['marks']); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>No marks recorded yet.</p>
<?php } ?>

<br>
<a href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
