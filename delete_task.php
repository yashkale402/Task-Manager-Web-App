<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $tasks = json_decode(file_get_contents('data/tasks.json'), true);

    foreach ($tasks as $key => $task) {
        if ($task['id'] == $taskId) {
            unset($tasks[$key]);
            break;
        }
    }

    file_put_contents('data/tasks.json', json_encode(array_values($tasks), JSON_PRETTY_PRINT));
    header("Location: index.php");
    exit();
} else {
    echo "Task ID not specified.";
    exit();
}
