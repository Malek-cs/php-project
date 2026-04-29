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
    <style>
        body { font-family: sans-serif; background-color: #fdfdfd; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); width: 320px; text-align: center; }
        input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #1a1a1a; color: white; border: none; border-radius: 30px; cursor: pointer; }
        a { color: #888; text-decoration: none; font-size: 13px; display: block; margin-top: 20px; }
    </style>
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