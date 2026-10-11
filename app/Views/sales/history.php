<!DOCTYPE html>
<html>
<head>
    <title>Sales History</title>
</head>
<body>

<h1>Sales History</h1>

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

<?php if (session()->getFlashdata('success')): ?>
    <p style="color: green;">
        <?= esc(session()->getFlashdata('success')) ?>
    </p>
<?php endif; ?>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Product</th>
            <th>Customer</th>
            <th>Staff</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($sales)): ?>
            <tr>
                <td colspan="6">No sales found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= esc($sale['product_name']) ?></td>

                    <td>
                        <?= ! empty($sale['customer_name'])
                            ? esc($sale['customer_name'])
                            : 'Walk-in Customer' ?>
                    </td>

                    <td><?= esc($sale['staff_name']) ?></td>
                    <td><?= esc($sale['quantity']) ?></td>
                    <td>₱<?= esc(number_format($sale['total_price'], 2)) ?></td>
                    <td><?= esc($sale['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>