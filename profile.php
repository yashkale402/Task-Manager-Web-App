<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Update profile logic
if (isset($_POST['update_profile'])) {
    $new_username = $_POST['new_username'];
    $new_password = md5($_POST['new_password']); // Encrypt the new password
    
    // Read the users file
    $users = json_decode(file_get_contents('data/users.json'), true);
    
    // Update user details
    foreach ($users as &$user) {
        if ($user['username'] == $_SESSION['username']) {
            $user['username'] = $new_username;
            $user['password'] = $new_password;
            $_SESSION['username'] = $new_username; // Update session username
        }
    }
    
    // Save updated users
    file_put_contents('data/users.json', json_encode($users));
    $success = "Profile updated successfully!";
}
?>

<?php include 'templates/header.php'; ?>

<div class="container">
    <h2>Edit Profile</h2>
    
    <?php if (isset($success)) { echo "<p>$success</p>"; } ?>
    
    <form method="POST">
        <label for="new_username">New Username</label>
        <input type="text" id="new_username" name="new_username" required value="<?php echo $_SESSION['username']; ?>">
        
        <label for="new_password">New Password</label>
        <input type="password" id="new_password" name="new_password" required>
        
        <button type="submit" name="update_profile">Update Profile</button>
    </form>
</div>

<?php include 'templates/footer.php'; ?>
