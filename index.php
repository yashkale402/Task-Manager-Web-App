<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$tasks = json_decode(file_get_contents('data/tasks.json'), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .task-card {
            margin-bottom: 20px;
        }
    </style>
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
        <h2 class="text-center">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <h4>Your Tasks</h4>
        <a href="task.php" class="btn btn-primary mb-3">Add New Task</a>

        <?php if ($tasks): ?>
            <?php foreach ($tasks as $task): ?>
                <div class="card task-card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($task['task']); ?></h5>
                        <p class="card-text">Priority: <?php echo htmlspecialchars($task['priority']); ?></p>
                        <a href="edit_task.php?id=<?php echo $task['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info">No tasks found.</div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
