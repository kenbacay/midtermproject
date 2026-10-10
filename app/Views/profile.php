<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>

    <h1>Profile</h1>

    <nav>
        <a href="/">Welcome</a> |
        <a href="/tasks">Task List</a> |
        <a href="/profile">Profile</a> |
        <a href="/about">About</a>
    </nav>

    <br>

    <h2>User Information</h2>

    <p>
        <strong>Username:</strong>
        <?= esc($user['username']) ?>
    </p>

    <p>
        <strong>Full Name:</strong>
        <?= esc($user['full_name']) ?>
    </p>

    <p>
        <strong>Email:</strong>
<?= esc($user['email'] ?? 'Not provided') ?>    </p>

    <p>
        <strong>Created At:</strong>
        <?= esc($user['created_at']) ?>
    </p>

</body>
</html>