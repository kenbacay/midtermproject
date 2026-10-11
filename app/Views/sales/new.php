<!DOCTYPE html>
<html>
<head>
    <title>Record Sale</title>
</head>
<body>

<h1>Record Sale</h1>
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
    <a href="<?= base_url('products') ?>">Products</a> |
    <a href="<?= base_url('customers') ?>">Customers</a> |
    <a href="<?= base_url('sales/new') ?>">Record Sale</a> |
    <a href="<?= base_url('sales/history') ?>">Sales History</a> |
    <a href="<?= base_url('logout') ?>">Logout</a>
</nav>

<br>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color: red;">
        <?= esc(session()->getFlashdata('error')) ?>
    </p>
<?php endif; ?>

<form action="<?= site_url('sales/create') ?>" method="post">
    <?= csrf_field() ?>

    <label for="product_id">Product:</label>
    <select name="product_id" id="product_id" required>
        <option value="">-- Select Product --</option>

        <?php foreach ($products as $product): ?>
            <option
                value="<?= esc($product['id']) ?>"
                <?= old('product_id') == $product['id'] ? 'selected' : '' ?>
            >
                <?= esc($product['name']) ?>
                - ₱<?= esc($product['price']) ?>
                - Stock: <?= esc($product['stock_quantity']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label for="customer_id">Customer:</label>
    <select name="customer_id" id="customer_id">
        <option value="">-- Walk-in Customer --</option>

        <?php foreach ($customers as $customer): ?>
            <option
                value="<?= esc($customer['id']) ?>"
                <?= old('customer_id') == $customer['id'] ? 'selected' : '' ?>
            >
                <?= esc($customer['full_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label for="quantity">Quantity:</label>
    <input
        type="number"
        name="quantity"
        id="quantity"
        min="1"
        value="<?= esc(old('quantity', '1')) ?>"
        required
    >

    <br><br>

    <button type="submit">Record Sale</button>
</form>

</body>
</html>