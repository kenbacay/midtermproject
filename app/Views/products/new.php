<h1>Add Product</h1>

<?php if (session()->getFlashdata('errors')): ?>
    <ul style="color: red;">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color: red;">
        <?= esc(session()->getFlashdata('error')) ?>
    </p>
<?php endif; ?>

<form action="<?= base_url('products/create') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <label>Product Name:</label>
    <input
        type="text"
        name="name"
        value="<?= esc(old('name')) ?>"
        required
    >
    <br><br>

    <label>Price:</label>
    <input
        type="number"
        name="price"
        value="<?= esc(old('price')) ?>"
        step="0.01"
        min="0"
        required
    >
    <br><br>

    <label>Stock Quantity:</label>
    <input
        type="number"
        name="stock_quantity"
        value="<?= esc(old('stock_quantity')) ?>"
        min="0"
        required
    >
    <br><br>

    <label>Product Image:</label>
    <input
        type="file"
        name="image"
        accept="image/*"
    >
    <br><br>

    <button type="submit">Save Product</button>
</form>

<br>

<a href="<?= base_url('products') ?>">Back to Products</a>