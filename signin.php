<?php
require_once 'connect.php';
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['profile_image'] = $user['profile_image'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In - Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">
    <div class="auth-card">
        <h2>Welcome Back</h2>
        <p class="auth-subtitle">Please enter your details to sign in</p>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="signin.php" method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <input type="text" name="username" placeholder="alex@example.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="********" required>
            </div>
            
            <div class="form-options">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="forgot-password.php" class="forgot-link">Forgot password?</a>
            </div>

            <button type="submit" class="btn-primary">Log In</button>
        </form>
        
        <p class="auth-footer-text">Don't have an account? <a href="signup.php" class="highlight-link">Sign up</a></p>
    </div>
</body>
</html>