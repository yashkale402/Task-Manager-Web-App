<?php
session_start();

// Check if the form is submitted
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt the password

    // Load existing users
    $users = json_decode(file_get_contents('data/users.json'), true);

    // Check for existing username
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            $error = "Username already exists!";
            break;
        }
    }

    // Add new user if not existing
    if (!isset($error)) {
        $users[] = ['username' => $username, 'password' => $password];
        file_put_contents('data/users.json', json_encode($users));
        header("Location: login.php");
        exit();
    }
}
?>

<?php include 'templates/header.php'; ?>

<div class="container">
    <h2 class="mt-4">Register</h2>

    <form method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="register">Register</button>
    </form>

    <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
</div>

<?php include 'templates/footer.php'; ?>
