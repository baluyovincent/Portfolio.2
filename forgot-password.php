<?php
require_once 'connect.php';
session_start();

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($new_password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } else {
        // Check kung nag-eexist ang user sa database
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() > 0) {
            // I-hash ang bagong password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // I-update ang password sa database
            $update_stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
            if ($update_stmt->execute([$hashed_password, $username])) {
                $success = "Password successfully updated! You can now <a href='signin.php' class='highlight-link'>Sign In</a>.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        } else {
            $error = "Username/Email not found in our database.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">
    <div class="auth-card">
        <h2>Reset Password</h2>
        <p class="auth-subtitle">Enter your username and new password</p>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form action="forgot-password.php" method="POST">
            <div class="form-group">
                <label>Username / Email</label>
                <input type="text" name="username" placeholder="alex@example.com" required>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" placeholder="At least 6 characters" required>
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm your new password" required>
            </div>
            
            <button type="submit" class="btn-primary">Update Password</button>
        </form>
        
        <p class="auth-footer-text">Remember your password? <a href="signin.php" class="highlight-link">Sign in</a></p>
    </div>
</body>
</html>