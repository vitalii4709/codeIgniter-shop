<div class="alert alert-danger">
    <ul class="list-unstyled">
        <?php foreach ($errors as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
    <?= session()->getFlashdata('fail'); ?>
</div>

