<h1>Add Product</h1>

<form action="<?= base_url('products/create') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <label>Product Name:</label>
    <input type="text" name="name" required><br><br>

    <label>Price:</label>
    <input type="number" name="price" step="0.01" required><br><br>

    <label>Stock Quantity:</label>
    <input type="number" name="stock_quantity" required><br><br>

    <label>Product Image:</label>
    <input type="file" name="image" accept="image/*"><br><br>

    <button type="submit">Save Product</button>
</form>

<a href="<?= base_url('products') ?>">Back to Products</a>