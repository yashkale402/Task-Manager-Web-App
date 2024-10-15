function fetchTasks() {
    fetch('data/tasks.json')
    .then(response => response.json())
    .then(data => {
        let taskContainer = document.getElementById('taskContainer');
        taskContainer.innerHTML = '';

        data.forEach((task, index) => {
            taskContainer.innerHTML += `
                <div>
                    <span>${task.task} - ${task.priority}</span>
                    <form method="POST" action="delete_task.php">
                        <input type="hidden" name="task_id" value="${index}">
                        <button type="submit">Delete</button>
                    </form>
                    <form method="POST" action="update_task.php">
                        <input type="text" name="task" value="${task.task}" required>
                        <select name="priority">
                            <option value="High" ${task.priority == 'High' ? 'selected' : ''}>High</option>
                            <option value="Medium" ${task.priority == 'Medium' ? 'selected' : ''}>Medium</option>
                            <option value="Low" ${task.priority == 'Low' ? 'selected' : ''}>Low</option>
                        </select>
                        <label for="completed">Completed:</label>
                        <input type="checkbox" name="completed" ${task.completed ? 'checked' : ''}>
                        <input type="hidden" name="task_id" value="${index}">
                        <button type="submit">Update</button>
                    </form>
                </div>
            `;
        });
    });
}
