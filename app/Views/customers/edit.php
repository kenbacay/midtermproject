<h1>Edit Customer</h1>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form
    action="<?= base_url('customers/update/' . $customer['id']) ?>"
    method="post"
>
    <?= csrf_field() ?>

    <label for="full_name">Full Name:</label><br>
    <input
        type="text"
        id="full_name"
        name="full_name"
        value="<?= old('full_name', $customer['full_name']) ?>"
        required
    ><br><br>

    <label for="email">Email:</label><br>
    <input
        type="email"
        id="email"
        name="email"
        value="<?= old('email', $customer['email']) ?>"
        required
    ><br><br>

    <label for="phone">Phone:</label><br>
    <input
        type="text"
        id="phone"
        name="phone"
        value="<?= old('phone', $customer['phone']) ?>"
    ><br><br>

    <button type="submit">Update Customer</button>
</form>

<br>

<a href="<?= base_url('customers') ?>">Back to Customers</a>