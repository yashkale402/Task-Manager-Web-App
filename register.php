<?php
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    // Read users and add new user
    $users = json_decode(file_get_contents('data/users.json'), true);
    $users[] = ['username' => $username, 'password' => $password];
    
    file_put_contents('data/users.json', json_encode($users));
    header("Location: login.php");
    exit();
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="register">Register</button>
</form>
