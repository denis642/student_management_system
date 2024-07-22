<?php
include('config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $role]);
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="learn.php">Learning</a></li>
                <li><a href="lecturers.php">Lecturers</a></li>
                <li><a href="admin.php">Admin</a></li>
                
            </ul>
        </nav>
    </header>
    <form method="post" action="register.php">
        <h2>Register</h2>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <label for="role">Role</label>
        <select id="role" name="role">
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Register</button>
    </form>
    <footer>
    <p><span class="copyright">Copyright 2024 &copy;</span> <span class="system-name">Student Management System</span></p>
    </footer>
</body>
</html>
