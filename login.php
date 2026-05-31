<?php
session_start();
require 'Data/config.php';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND status='active'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['is_admin']     = (bool) $user['is_admin'];
        $_SESSION['user_data']    = [
            'id'       => $user['id'],
            'username' => $user['username']
        ];
        header("Location: " . ($user['is_admin'] ? 'admin_dashboard.php' : 'index.php'));
        exit();
    } else {
        $error = "Incorrect username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | StudySpaces</title>
    <link rel="stylesheet" href="css/Home.css">
</head>
<body>
    <div class="card">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Sign In</button>
        </form>
        <a href="register.php">Don't have an account? Create one</a>
    </div>
</body>
</html>
