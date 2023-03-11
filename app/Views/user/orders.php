<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</i></a></li>
            <li class="breadcrumb-item"><a href="<?= route_to('user.cabinet'); ?>">Личный кабинет</a></li>
            <li class="breadcrumb-item active">Список заказов</li>
        </ol>
    </nav>
</div>

<div class="container py-3 mt20 mb30">
    <div class="row">

        <div class="col-12">
            <h1 class="section-title">Список заказов</h1>
        </div>

        <?= $this->include('layouts/incs/user_sidebar'); ?>

        <div class="col-md-9 col-md-pull-3">

            <?php if (!empty($orders)): ?>

                <div class="table-responsive">
                    <table class="table text-start table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">№ заказа</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Сумма</th>
                            <th scope="col">Дата создания</th>
                            <th scope="col"><i class="far fa-eye"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr <?php if ($order['status']) echo 'class="table-info"' ?>>
                                <td><?= $order['id'] ?></td>
                                <td><?= $order['status'] ? 'Завершен' : 'Новый' ?></td>
                                <td><?= $order['total'] ?> ₽</td>
                                <td><?= $order['created_at'] ?></td>
                                <td><a href="<?= route_to('user.order', $order['id']); ?>"><i class="far fa-eye"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation example">
                            <?= $pager->links('default', 'admin_pager'); ?>
                        </nav>
                    </div>

                </div>

            <?php else: ?>
                <p>Заказов не найдено</p>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>

