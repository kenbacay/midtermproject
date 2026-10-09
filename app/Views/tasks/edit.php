<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>

    <h1>Edit Task</h1>

    <?php if (isset($validation)): ?>
        <?= $validation->listErrors() ?>
    <?php endif; ?>

    <form action="<?= site_url('tasks/update/' . $task['id']) ?>" method="post">
        <?= csrf_field() ?>

        <label>Title:</label>
        <input
            type="text"
            name="title"
            value="<?= esc($task['title']) ?>"
            required
        >

        <br><br>

        <label>Description:</label>
        <textarea name="description"><?= esc($task['description'] ?? '') ?></textarea>

        <br><br>

        <label>Task Date:</label>
        <input
            type="date"
            name="task_date"
            value="<?= esc($task['task_date']) ?>"
            required
        >

        <br><br>

        <button type="submit">Update Task</button>
    </form>

    <br>

    <a href="<?= site_url('tasks') ?>">Back to Task List</a>

</body>
</html>