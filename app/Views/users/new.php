<h1>Add Staff Account</h1>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form
    action="<?= base_url('users/create') ?>"
    method="post"
    enctype="multipart/form-data"
>
    <?= csrf_field() ?>

    <label for="username">Username:</label><br>
    <input
        type="text"
        id="username"
        name="username"
        value="<?= old('username') ?>"
        required
    ><br><br>

    <label for="full_name">Full Name:</label><br>
    <input
        type="text"
        id="full_name"
        name="full_name"
        value="<?= old('full_name') ?>"
        required
    ><br><br>

    <label for="password">Password:</label><br>
    <input
        type="password"
        id="password"
        name="password"
        required
    ><br><br>

    <label for="avatar">Avatar:</label><br>
    <input
        type="file"
        id="avatar"
        name="avatar"
        accept="image/*"
    ><br><br>

    <button type="submit">Save Staff Account</button>
</form>

<br>

<a href="<?= base_url('users') ?>">Back to Staff Accounts</a>