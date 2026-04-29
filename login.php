<?php
session_start();

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if (isset($_SESSION['user_data']) && 
        $user == $_SESSION['user_data']['username'] && 
        $pass == $_SESSION['user_data']['password']) {
        
        $_SESSION['is_logged_in'] = true;
        header("Location: index.php");
        exit();
    } else {
        $error = "Incorrect username or password!";
    }
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
        .error { color: red; font-size: 13px; margin-bottom: 10px; }
        a { color: #888; text-decoration: none; font-size: 13px; display: block; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Login</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Sign In</button>
        </form>
        <a href="register.php">Don't have an account? Create one</a>
    </div>
</body>
</html>