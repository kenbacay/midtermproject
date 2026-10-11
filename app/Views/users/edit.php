<h1>Edit Staff Account</h1>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form
    action="<?= base_url('users/update/' . $user['id']) ?>"
    method="post"
    enctype="multipart/form-data"
>
    <?= csrf_field() ?>

    <label for="username">Username:</label><br>
    <input
        type="text"
        id="username"
        name="username"
        value="<?= old('username', $user['username']) ?>"
        required
    ><br><br>

    <label for="full_name">Full Name:</label><br>
    <input
        type="text"
        id="full_name"
        name="full_name"
        value="<?= old('full_name', $user['full_name']) ?>"
        required
    ><br><br>

    <label for="password">New Password:</label><br>
    <input
        type="password"
        id="password"
        name="password"
        placeholder="Leave blank to keep current password"
    ><br><br>

    <label for="avatar">Replace Avatar:</label><br>
    <input
        type="file"
        id="avatar"
        name="avatar"
        accept="image/*"
    ><br><br>

    <?php if (! empty($user['avatar'])): ?>
        <p>Current Avatar:</p>

        <img
            src="<?= base_url('uploads/avatars/' . esc($user['avatar'])) ?>"
            width="120"
            alt="<?= esc($user['full_name']) ?>"
        >

        <br><br>
    <?php endif; ?>

    <button type="submit">Update Staff Account</button>
</form>

<br>

<a href="<?= base_url('users') ?>">Back to Staff Accounts</a>