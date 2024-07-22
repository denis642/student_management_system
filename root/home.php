<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Home Page.</h1>
    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="learn.php">Learning</a></li>
                <li><a href="lecturers.php">Lecturers</a></li>
                <li><a href="admin.php">Admin</a></li>
                <?php if (!isset($_SESSION['user_id'])) : ?>
                    <!-- Show login and register links if user is not logged in -->
                    <li><a href="login.php">Login</a></li>
                    
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <footer>
        <p>&copy; 2024 Student Management System</p>
    </footer>
    <script src="js/scripts.js"></script>
</body>
</html>
