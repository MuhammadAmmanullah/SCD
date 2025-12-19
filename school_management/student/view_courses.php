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

// This assumes enrollments table links students <-> courses
$sql = "SELECT c.course_id, c.course_name
        FROM enrollments e
        JOIN courses c ON e.course_id = c.course_id
        WHERE e.student_id = $student_id";
$res = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Courses</title>
</head>
<body>
<h2>My Enrolled Courses</h2>

<?php if ($res && mysqli_num_rows($res) > 0) { ?>
    <table border="1" cellpadding="8">
        <tr><th>Course ID</th><th>Course Name</th></tr>
        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['course_id']); ?></td>
                <td><?php echo htmlspecialchars($row['course_name']); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>You are not enrolled in any courses.</p>
<?php } ?>

<br>
<a href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
