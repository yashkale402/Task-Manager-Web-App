<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
    $new_task = $_POST['task'];
    $new_priority = $_POST['priority'];
    $completed = isset($_POST['completed']) ? true : false;

    // Read tasks from JSON
    $tasks = json_decode(file_get_contents('data/tasks.json'), true);

    // Update the task
    if (isset($tasks[$task_id])) {
        $tasks[$task_id]['task'] = $new_task;
        $tasks[$task_id]['priority'] = $new_priority;
        $tasks[$task_id]['completed'] = $completed;
    }

    // Save updated tasks
    file_put_contents('data/tasks.json', json_encode($tasks));
    header("Location: index.php");
    exit();
}
?>
