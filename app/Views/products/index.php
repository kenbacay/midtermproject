<h1>Products</h1>

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

<a href="<?= base_url('/') ?>">Home</a> |
<a href="<?= base_url('products/new') ?>">Add Product</a>

<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Image</th>
    </tr>

    <?php if (empty($products)): ?>
        <tr>
            <td colspan="4">No products found.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= esc($product['name']) ?></td>
                <td><?= esc($product['price']) ?></td>
                <td><?= esc($product['stock_quantity']) ?></td>
                <td>
                    <?php if (! empty($product['image'])): ?>
                        <img
                            src="<?= base_url('uploads/products/' . esc($product['image'])) ?>"
                            width="80"
                            alt="<?= esc($product['name']) ?>"
                        >
                    <?php else: ?>
                        No image
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>