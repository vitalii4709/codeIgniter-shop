<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h1 class="section-title"><?= $title; ?></h1>

            <?= $page['content'] ?>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>

