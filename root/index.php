<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    header("Location: learn.php");
    exit();
}

$error = "";

// Initialize form values
$username = "";
$password = "";
$role = "";

// Handle form submission for login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    include('config/db.php');

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: learn.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}

// Handle form submission for registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    include('config/db.php');

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $role]);

    // Redirect to login page after registration
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Student Management System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="header">
        <div class="marquee">Welcome to the Student Management System. For any assistance, feel free to contact the Admin. Thank you!</div>
    </div>
    <div class="sidebar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="learn.php">Learning</a></li>
            <li><a href="lecturers.php">Lecturers</a></li>
            <li><a href="admin.php">Admin</a></li>
        </ul>
    </div>
    <div class="main-content">
        <section>
            <div class="auth-container">
                <div id="login-box" class="auth-box">
                    <h2>Login</h2>
                    <form method="post" action="index.php" onsubmit="return clearFields('login')">
                        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
                        <label for="username_login">Username</label>
                        <input type="text" id="username_login" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                        <label for="password_login">Password</label>
                        <input type="password" id="password_login" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
                        <button type="submit" name="login">Login</button>
                        <p>Don't have an account? <a href="#" id="show-register">Register here</a></p>
                    </form>
                </div>

                <div id="register-box" class="auth-box" style="display:none;">
                    <h2>Register</h2>
                    <form method="post" action="index.php" onsubmit="return clearFields('register')">
                        <label for="username_register">Username</label>
                        <input type="text" id="username_register" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                        <label for="password_register">Password</label>
                        <input type="password" id="password_register" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
                        <label for="role_register">Role</label>
                        <select id="role_register" name="role">
                            <option value="student" <?php if ($role == 'student') echo 'selected'; ?>>Student</option>
                            <option value="lecturer" <?php if ($role == 'lecturer') echo 'selected'; ?>>Lecturer</option>
                            <option value="admin" <?php if ($role == 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                        <button type="submit" name="register">Register</button>
                        <p>Already have an account? <a href="#" id="show-login">Login here</a></p>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <p><span class="copyright">Copyright 2024 &copy;</span> <span class="system-name">Student Management System</span></p>
    </footer>

    <script>
        document.getElementById('show-register').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('login-box').style.display = 'none';
            document.getElementById('register-box').style.display = 'block';
        });

        document.getElementById('show-login').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('register-box').style.display = 'none';
            document.getElementById('login-box').style.display = 'block';
        });

        function clearFields(formType) {
            if (formType === 'login') {
                document.getElementById('username_login').value = '';
                document.getElementById('password_login').value = '';
            } else if (formType === 'register') {
                document.getElementById('username_register').value = '';
                document.getElementById('password_register').value = '';
            }
            return true; // Allow form submission
        }
    </script>
</body>
</html>
