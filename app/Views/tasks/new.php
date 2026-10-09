<!DOCTYPE html>
<html>
<head>
    <title>New Task</title>
</head>
<body>

    <h1>New Task</h1>

    <?php if (isset($validation)): ?>
        <?= $validation->listErrors() ?>
    <?php endif; ?>

    <form action="<?= site_url('tasks/create') ?>" method="post">
        <?= csrf_field() ?>

        <label>Title:</label>
        <input
            type="text"
            name="title"
            value="<?= old('title') ?>"
            required
        >

        <br><br>

        <label>Description:</label>
        <textarea name="description"><?= old('description') ?></textarea>

        <br><br>

        <label>Task Date:</label>
        <input
            type="date"
            name="task_date"
            value="<?= old('task_date') ?>"
            required
        >

        <br><br>

        <button type="submit">Save Task</button>
    </form>

    <br>

    <a href="<?= site_url('tasks') ?>">Back to Task List</a>

</body>
</html>