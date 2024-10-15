<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    // Read users from JSON
    $users = json_decode(file_get_contents('data/users.json'), true);

    foreach ($users as $user) {
        if ($user['username'] == $username && $user['password'] == $password) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        }
    }
    $error = "Invalid login credentials!";
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</form>
