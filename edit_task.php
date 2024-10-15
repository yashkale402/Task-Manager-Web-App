<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$tasks = json_decode(file_get_contents('data/tasks.json'), true);

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $taskToEdit = null;

    foreach ($tasks as &$task) {
        if ($task['id'] == $taskId) {
            $taskToEdit = $task;
            break;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_task'])) {
        $taskToEdit['task'] = $_POST['task'];
        $taskToEdit['priority'] = $_POST['priority'];

        // Save updated tasks
        file_put_contents('data/tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));
        header("Location: index.php");
        exit();
    }
} else {
    echo "Task ID not specified.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Task Manager</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center">Edit Task</h2>
        <form method="POST">
            <div class="form-group">
                <label for="task">Task</label>
                <input type="text" class="form-control" id="task" name="task" value="<?php echo htmlspecialchars($taskToEdit['task']); ?>" required>
            </div>
            <div class="form-group">
                <label for="priority">Priority</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="Low" <?php echo $taskToEdit['priority'] === 'Low' ? 'selected' : ''; ?>>Low</option>
                    <option value="Medium" <?php echo $taskToEdit['priority'] === 'Medium' ? 'selected' : ''; ?>>Medium</option>
                    <option value="High" <?php echo $taskToEdit['priority'] === 'High' ? 'selected' : ''; ?>>High</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="edit_task">Save Changes</button>
        </form>
    </div>
</body>
</html>
