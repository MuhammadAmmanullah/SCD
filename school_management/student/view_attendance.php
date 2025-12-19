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

$sql = "SELECT c.course_name, a.date, a.status
        FROM attendance a
        JOIN courses c ON a.course_id = c.course_id
        WHERE a.student_id = $student_id
        ORDER BY a.date DESC";
$res = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head><title>My Attendance</title></head>
<body>
<h2>My Attendance</h2>

<?php if ($res && mysqli_num_rows($res) > 0) { ?>
    <table border="1" cellpadding="8">
        <tr><th>Course</th><th>Date</th><th>Status</th></tr>
        <?php while ($r = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($r['course_name']); ?></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['status']); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>No attendance records found.</p>
<?php } ?>

<br>
<a href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
