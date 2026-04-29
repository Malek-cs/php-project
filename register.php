<?php
session_start();
if (isset($_POST['register'])) {
    $_SESSION['user_data'] = [
        'username' => $_POST['username'],
        'password' => $_POST['password']
    ];
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/Home.css">
</head>
<body>
    <div class="card">
        <h2>Create Account</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Choose Username" required>
            <input type="password" name="password" placeholder="Choose Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <a href="login.php">Back to Login</a>
    </div>
</body>
</html>