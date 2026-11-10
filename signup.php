<?php
require_once 'connect.php';
session_start();
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($fullname) || empty($username) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $error = "Username/Email is already taken.";
        } else {
            $profile_image = null;
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $filename = $_FILES['profile_image']['name'];
                $filetmp = $_FILES['profile_image']['tmp_name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                if (in_array($ext, $allowed)) {
                    $upload_dir = 'uploads/';
                    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
                    $new_filename = uniqid('profile_', true) . '.' . $ext;
                    if (move_uploaded_file($filetmp, $upload_dir . $new_filename)) {
                        $profile_image = $new_filename;
                    }
                }
            }

            if (empty($error)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (fullname, username, password, profile_image) VALUES (?, ?, ?, ?)");
                if ($stmt->execute([$fullname, $username, $hashed_password, $profile_image])) {
                    $success = "Registration successful! <a href='signin.php'>Sign in here</a>";
                } else {
                    $error = "Registration failed.";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">
    <div class="auth-card">
        <h2>Create Account</h2>
        <p class="auth-subtitle">Get started with your free account today</p>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form action="signup.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="fullname" placeholder="Alex Johnson" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="text" name="username" placeholder="alex@example.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="At least 6 characters" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
            <div class="form-group">
                <label>Profile Picture</label>
                <input type="file" name="profile_image" accept="image/*" class="file-input" required>
            </div>
            <button type="submit" class="btn-primary">Sign Up</button>
        </form>
        <p class="auth-footer-text">Already have an account? <a href="signin.php" class="highlight-link">Log in</a></p>
    </div>
</body>
</html>