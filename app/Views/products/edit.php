<h1>Edit Product</h1>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form
    action="<?= base_url('products/update/' . $product['id']) ?>"
    method="post"
    enctype="multipart/form-data"
>
    <?= csrf_field() ?>

    <label for="name">Product Name:</label><br>
    <input
        type="text"
        id="name"
        name="name"
        value="<?= old('name', $product['name']) ?>"
        required
    ><br><br>

    <label for="price">Price:</label><br>
    <input
        type="number"
        id="price"
        name="price"
        step="0.01"
        value="<?= old('price', $product['price']) ?>"
        required
    ><br><br>

    <label for="stock_quantity">Stock Quantity:</label><br>
    <input
        type="number"
        id="stock_quantity"
        name="stock_quantity"
        value="<?= old('stock_quantity', $product['stock_quantity']) ?>"
        required
    ><br><br>

    <label for="image">Replace Product Image:</label><br>
    <input
        type="file"
        id="image"
        name="image"
        accept="image/*"
    ><br><br>

    <?php if (! empty($product['image'])): ?>
        <p>Current Image:</p>
        <img
            src="<?= base_url('uploads/products/' . esc($product['image'])) ?>"
            width="120"
            alt="<?= esc($product['name']) ?>"
        >
        <br><br>
    <?php endif; ?>

    <button type="submit">Update Product</button>
</form>

<br>

<a href="<?= base_url('products') ?>">Back to Products</a>