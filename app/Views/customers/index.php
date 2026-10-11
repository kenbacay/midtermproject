<h1>Customer Accounts</h1>

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
    <a href="<?= base_url('customers/new') ?>">Add Customer</a>
</nav>

<br><br>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($customers)): ?>
            <tr>
                <td colspan="5">No customers found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td>
                        <?= ! empty($customer['phone'])
                            ? esc($customer['phone'])
                            : 'N/A' ?>
                    </td>
                    <td><?= esc($customer['created_at']) ?></td>
                    <td>
                        <a href="<?= base_url('customers/edit/' . $customer['id']) ?>">
                            Edit
                        </a>

                        <form
                            action="<?= base_url('customers/delete/' . $customer['id']) ?>"
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