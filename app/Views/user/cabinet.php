<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid mt10">
    <div class="container">
        <div class="row ">
            <div class="col-xs-3 col-sm-6 " >
                <div class="hidden-xs">
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li class="active">Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-12">
            <h1 class="section-title">Личный кабинет</h1>
        </div>

        <?= $this->include('layouts/incs/user_sidebar'); ?>

        <div class="col-md-9 col-md-pull-3">
            <ul class="list-unstyled">
                <li><a href="<?= route_to('user.orders'); ?>">Заказы</a></li>
                <li><a href="<?= route_to('user.credentials'); ?>">Учетные данные</a></li>
                <li><a href="<?= route_to('user.logout'); ?>">Выход</a></li>
            </ul>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>

