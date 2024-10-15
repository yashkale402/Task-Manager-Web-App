<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['new_task'])) {
    $task = $_POST['task'];
    $priority = $_POST['priority'];
    
    // Read tasks from JSON and add a new task
    $tasks = json_decode(file_get_contents('data/tasks.json'), true);
    $tasks[] = ['task' => $task, 'priority' => $priority, 'completed' => false, 'username' => $_SESSION['username']];
    
    file_put_contents('data/tasks.json', json_encode($tasks));
    header("Location: index.php");
    exit();
}
?>
