<?php
session_start();
include 'config/db.php';

// If form not submitted, show simple message or redirect to login form
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // If you used login.html earlier, ensure you open login.php in browser which contains the form.
    echo "Please submit the login form.";
    exit();
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Basic validation
if ($username === '' || $password === '') {
    echo "Please enter username and password.";
    exit();
}

// Query user (simple plain-text password check; you can later replace with hashed)
$sql = "SELECT * FROM users WHERE username='" . mysqli_real_escape_string($conn, $username) .
       "' AND password='" . mysqli_real_escape_string($conn, $password) . "' LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    // Store common session data
    $_SESSION['user_id'] = $user['user_id'];      // users.user_id
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    // If student: fetch student_id and store
    if ($user['role'] === 'student') {
        $q = "SELECT student_id FROM students WHERE user_id = " . intval($user['user_id']) . " LIMIT 1";
        $r = mysqli_query($conn, $q);
        if ($r && mysqli_num_rows($r) == 1) {
            $s = mysqli_fetch_assoc($r);
            $_SESSION['student_id'] = $s['student_id'];
        } else {
            // no student record found
            $_SESSION['student_id'] = null;
        }
        header("Location: student/student_dashboard.php");
        exit();
    }

    // If teacher: fetch teacher_id and store
    if ($user['role'] === 'teacher') {
        $q = "SELECT teacher_id FROM teachers WHERE user_id = " . intval($user['user_id']) . " LIMIT 1";
        $r = mysqli_query($conn, $q);
        if ($r && mysqli_num_rows($r) == 1) {
            $t = mysqli_fetch_assoc($r);
            $_SESSION['teacher_id'] = $t['teacher_id'];
        } else {
            $_SESSION['teacher_id'] = null;
        }
        header("Location: teacher/teacher_dashboard.php");
        exit();
    }

    // Admin
    if ($user['role'] === 'admin') {
        header("Location: admin/admin_dashboard.php");
        exit();
    }

} else {
    echo "Invalid username or password!";
    exit();
}
?>
