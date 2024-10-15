<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'templates/header.php';
?>

<div class="container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    
    <!-- Task Form -->
    <form id="addTaskForm" method="POST" action="task.php">
        <input type="text" name="task" placeholder="Enter your task" required>
        <select name="priority" required>
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
        </select>
        <button type="submit" name="new_task">Add Task</button>
    </form>

    <!-- Task List -->
    <div id="taskContainer"></div>
</div>

<script src="assets/js/main.js"></script>

<?php include 'templates/footer.php'; ?>
