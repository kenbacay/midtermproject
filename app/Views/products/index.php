<h1>Products</h1>

<nav>
    <a href="/index.php/products">Products</a> |
    <a href="/index.php/customers">Customers</a> |
    <a href="/index.php/users">Staff</a> |
    <a href="/index.php/sales/new">Buy / Record Sale</a> |
    <a href="/index.php/sales/history">Sales History</a> |
    <a href="/index.php/logout">Log Out</a>
</nav>

<br>

<a href="/index.php/">Home</a> |
<a href="/index.php/products/new">Add Product</a>

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
                            src="/uploads/products/<?= esc($product['image'], 'url') ?>"
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