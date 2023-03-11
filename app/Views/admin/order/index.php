<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <?php if (!empty($orders)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID заказа</th>
                                    <th>Статус</th>
                                    <th>Создан</th>
                                    <th>Изменен</th>
                                    <th>Сумма</th>
                                    <td width="50"><i class="fas fa-pencil-alt"></i></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orders as $order): ?>
                                    <tr <?php if (!$order['status']) echo 'class="table-info"' ?>>
                                        <td><?= $order['id'] ?></td>
                                        <td>
                                            <?= $order['status'] ? 'Завершен' : 'Новый' ?>
                                        </td>
                                        <td><?= $order['created_at'] ?></td>
                                        <td><?= $order['updated_at'] ?></td>
                                        <td><?= $order['total'] ?> ₽ </td>
                                        <td width="50">
                                            <a class="btn btn-info btn-sm" href="<?= route_to('admin.order.edit', $order['id']) ?>">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <?= $pager->links('default', 'admin_pager'); ?>
                            </div>
                        </div>

                    <?php else: ?>
                        <p>Заказов не найдено...</p>
                    <?php endif; ?>

                </div>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection(); ?>


