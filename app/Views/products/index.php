<h1>Products</h1>

<nav>
    <a href="<?= base_url('products') ?>">Products</a> |
    <a href="<?= base_url('customers') ?>">Customers</a> |
    <a href="<?= base_url('users') ?>">Staff</a> |
    <a href="<?= base_url('sales/new') ?>">Buy / Record Sale</a> |
    <a href="<?= base_url('sales/history') ?>">Sales History</a> |
    <a href="<?= base_url('logout') ?>">Log Out</a>
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
                            src="<?= base_url('products/image/' . $product['image']) ?>"
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