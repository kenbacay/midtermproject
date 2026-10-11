<h1>Staff Accounts</h1>

<nav>
    <?php if (session()->get('logged_in')): ?>

        <a href="/index.php/products">
            <button type="button">Products</button>
        </a>

        <a href="/index.php/customers">
            <button type="button">Customers</button>
        </a>

        <a href="/index.php/users">
            <button type="button">Staff</button>
        </a>

        <a href="/index.php/sales/new">
            <button type="button">Buy / Record Sale</button>
        </a>

        <a href="/index.php/sales/history">
            <button type="button">Sales History</button>
        </a>

        <a href="/index.php/logout">
            <button type="button">Log Out</button>
        </a>

    <?php else: ?>

        <a href="/index.php/login">
            <button type="button">Log In</button>
        </a>

    <?php endif; ?>
</nav>

<br>

<nav>
    <a href="/index.php/">Home</a> |
    <a href="/index.php/products">Products</a> |
    <a href="/index.php/customers">Customers</a> |
    <a href="/index.php/users">Staff Accounts</a> |
    <a href="/index.php/users/new">Add Staff</a>
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
                                src="/uploads/avatars/<?= esc($user['avatar'], 'url') ?>"
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
                        <a href="/index.php/users/edit/<?= esc($user['id']) ?>">
                            Edit
                        </a>

                        <form
                            action="/index.php/users/delete/<?= esc($user['id']) ?>"
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