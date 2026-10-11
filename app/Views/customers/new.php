<h1>Add Customer</h1>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="<?= base_url('customers/create') ?>" method="post">
    <?= csrf_field() ?>

    <label for="full_name">Full Name:</label><br>
    <input
        type="text"
        id="full_name"
        name="full_name"
        value="<?= old('full_name') ?>"
        required
    ><br><br>

    <label for="email">Email:</label><br>
    <input
        type="email"
        id="email"
        name="email"
        value="<?= old('email') ?>"
        required
    ><br><br>

    <label for="phone">Phone:</label><br>
    <input
        type="text"
        id="phone"
        name="phone"
        value="<?= old('phone') ?>"
    ><br><br>

    <button type="submit">Save Customer</button>
</form>

<br>

<a href="<?= base_url('customers') ?>">Back to Customers</a>