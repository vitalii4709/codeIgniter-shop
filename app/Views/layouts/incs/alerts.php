<div class="row">
    <div class="col">
        <?php if (session()->has('success')): ?>
            <div class="alert alert-success">
                <?= session()->get('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->has('fail')): ?>
            <div class="alert alert-danger">
                <?= session()->get('fail'); ?>
            </div>
        <?php endif; ?>

        <?php
        $errors_data = session()->has('errors') ? esc(session()->getFlashdata('errors')) : [];
        ?>
        <?php if (!empty($errors_data)): ?>
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    <?php foreach ($errors_data as $error_item): ?>
                        <li><?= $error_item; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>

