<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    // Read tasks from JSON
    $tasks = json_decode(file_get_contents('data/tasks.json'), true);

    // Remove the task
    unset($tasks[$task_id]);

    // Save updated tasks
    file_put_contents('data/tasks.json', json_encode(array_values($tasks)));
    header("Location: index.php");
    exit();
}
?>
