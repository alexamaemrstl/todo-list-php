<?php
require 'db.php';

// Fetch tasks from the database
$stmt = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <title>List Nilexi - Aesthetic To-Do List</title>
</head>
<body>

<div class="container">
    <h1> TO DO LIST </h1>

    <!-- Add Task Form -->
    <form action="add_task.php" method="POST">
        <input type="text" name="task_name" placeholder="Enter a new task..." required>
        <button type="submit">Add Task</button>
    </form>

    <!-- Task List -->
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <span class="task-name <?php echo $task['is_completed'] ? 'completed' : ''; ?>">
                    <?php echo htmlspecialchars($task['task_name']); ?>
                </span>

                <div>
                    <?php if (!$task['is_completed']): ?>
                        <a href="complete_task.php?id=<?php echo $task['id']; ?>" class="complete-btn">✔ Complete</a>
                    <?php endif; ?>
                    <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="delete-btn">❌ Delete</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
