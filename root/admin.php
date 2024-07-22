<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Student Management System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header class="header">
        <div class="marquee">Welcome to the Student Management System.For any assistance feel free to contact the Admin.Thank you!</div>
    </header>
    <div class="sidebar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="learn.php">Learning</a></li>
            <li><a href="lecturers.php">Lecturers</a></li>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    
    <div class="main-content">
        <h1>Welcome to the Admin Page</h1>
        <!-- Admin-specific content goes here -->
         <p>Here is your tasks as the system Admin</p>
    </div>
    <footer>
    <p><span class="copyright">Copyright 2024 &copy;</span> <span class="system-name">Student Management System</span></p>
    </footer>


    <script src="js/scripts.js"></script>
</body>
</html>
