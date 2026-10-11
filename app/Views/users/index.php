<h1>Staff Accounts</h1>

<nav>
    <?php if (session()->get('logged_in')): ?>

        <a href="<?= base_url('products') ?>">
            <button type="button">Products</button>
        </a>

        <a href="<?= base_url('customers') ?>">
            <button type="button">Customers</button>
        </a>

        <a href="<?= base_url('users') ?>">
            <button type="button">Staff</button>
        </a>

        <a href="<?= base_url('sales/new') ?>">
            <button type="button">Buy / Record Sale</button>
        </a>

        <a href="<?= base_url('sales/history') ?>">
            <button type="button">Sales History</button>
        </a>

        <a href="<?= base_url('logout') ?>">
            <button type="button">Log Out</button>
        </a>

    <?php else: ?>

        <a href="<?= base_url('login') ?>">
            <button type="button">Log In</button>
        </a>

    <?php endif; ?>
</nav>

<br>

<nav>
    <a href="<?= base_url('/') ?>">Home</a> |
    <a href="<?= base_url('products') ?>">Products</a> |
    <a href="<?= base_url('customers') ?>">Customers</a> |
    <a href="<?= base_url('users') ?>">Staff Accounts</a> |
    <a href="<?= base_url('users/new') ?>">Add Staff</a>
</nav>

<br><br>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Avatar</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($users)): ?>
            <tr>
                <td colspan="5">No staff accounts found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?php if (! empty($user['avatar'])): ?>
                            <img
                                src="<?= base_url('users/avatar/' . $user['avatar']) ?>"
                                width="80"
                                alt="<?= esc($user['full_name']) ?>"
                            >
                        <?php else: ?>
                            No avatar
                        <?php endif; ?>
                    </td>

                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><?= esc($user['created_at']) ?></td>

                    <td>
                        <a href="<?= base_url('users/edit/' . $user['id']) ?>">
                            Edit
                        </a>

                        <form
                            action="<?= base_url('users/delete/' . $user['id']) ?>"
                            method="post"
                            style="display: inline;"
                        >
                            <?= csrf_field() ?>

                            <button type="submit">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>