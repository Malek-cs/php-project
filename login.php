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
    <link rel="stylesheet" href="css/Home.css">
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