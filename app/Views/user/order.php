<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= route_to('user.cabinet'); ?>">Личный кабинет</a></li>
            <li class="breadcrumb-item"><a href="<?= route_to('user.orders'); ?>">Список заказов</a></li>
            <li class="breadcrumb-item active">Просмотр заказа</li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-12">
            <h1 class="section-title"><?= $title; ?></h1>
        </div>

        <?= $this->include('layouts/incs/user_sidebar'); ?>

        <div class="col-md-9 col-md-pull-3">

            <?php if (!empty($order)): ?>
                <div class="table-responsive">
                    <table class="table text-start table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Наименование товара</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Кол-во</th>
                            <th scope="col">Сумма</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($order as $item): ?>
                            <tr>
                                <td><a href="<?= route_to('product.show', $item['slug']); ?>"><?= $item['title'] ?></a></td>
                                <td><?= $item['price'] ?> ₽</td>
                                <td><?= $item['qty'] ?></td>
                                <td><?= $item['price'] * $item['qty'] ?> ₽</td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="box">
                    <h3 class="box-title">Детали заказа</h3>
                    <div class="box-content">
                        <div class="table-responsive">
                            <table class="table text-start table-striped">
                                <tr>
                                    <td>№ заказа</td>
                                    <td><?= $id ?></td>
                                </tr>
                                <tr>
                                    <td>Статус</td>
                                    <td><?= $order[0]['status'] ? 'Завершен' : 'Новый'; ?></td>
                                </tr>
                                <tr>
                                    <td>Дата создания</td>
                                    <td><?= $order[0]['created_at'] ?></td>
                                </tr>
                                <tr>
                                    <td>Дата изменения</td>
                                    <td><?= $order[0]['updated_at'] ?></td>
                                </tr>
                                <tr>
                                    <td>Итоговая сумма</td>
                                    <td>$<?= $order[0]['total'] ?></td>
                                </tr>
                                <tr>
                                    <td>Примечение</td>
                                    <td><?= $order[0]['note'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>


            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>

