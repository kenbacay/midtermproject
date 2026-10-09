<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

    <h1>Dashboard</h1>

    <p>
        Welcome, <?= esc(session('username')) ?>!
    </p>

    <a href="<?= base_url('logout') ?>">Logout</a>

</body>
</html>