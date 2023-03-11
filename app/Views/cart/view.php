<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid mt10">
    <div class="container">
        <div class="row ">
            <div class="col-xs-9 col-sm-6">
                <h3><span id="">Корзина</span></h3>
            </div>
            <div class="col-xs-3 col-sm-6 " style="text-align:right;">
                <div class="hidden-xs">
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li class="active">Корзина</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            
            <?= $this->include('layouts/incs/alerts'); ?>

            <?php if (!empty($_SESSION['cart'])): ?>
                <div class="table-responsive cart-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Фото</th>
                                <th scope="col">Наименование</th>
                                <th scope="col">Кол-во</th>
                                <th scope="col">Цена</th>
                                <th scope="col"><i class="far fa-trash-alt"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                            <tr>
                                <td>
                                    <a href="<?= route_to('product.show', $item['slug']); ?>"><img src="<?= $item['img'] ?>" alt="" style="max-height: 50px;"></a>
                                </td>
                                <td><a href="<?= route_to('product.show', $item['slug']); ?>"><?= $item['title'] ?></a></td>
                                <td><?= $item['qty'] ?></td>
                                <td>$<?= $item['price'] ?></td>
                                <td><a href="<?= route_to('cart.delete', $id); ?>" data-id="<?= $id ?>" class="del-item"><i class="far fa-trash-alt"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="text-end">Итого кол-во</td>
                            <td class="cart-qty-basket"><?= $_SESSION['cart.qty'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end">Всего</td>
                            <td class="cart-sum-basket">$<?= $_SESSION['cart.sum'] ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <form class="row g-3" method="post" action="<?= route_to('cart.checkout'); ?>">
                    <?= csrf_field(); ?>

                    <?php if (!isset($_SESSION['user'])): ?>
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <label class="required" for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="<?= old('email') ?>">
                            </div>
                        </div>

                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <label class="required" for="password">Пароль</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                        </div>

                        <div class="col-md-6 offset-md-3 mt20">
                            <div class="form-floating mb-3">
                                <label class="required" for="name">Имя</label>
                                <input type="text" name="name" class="form-control" id="name" value="<?= old('name') ?>">
                            </div>
                        </div>

                        <div class="col-md-6 offset-md-3 mt20">
                            <div class="form-floating mb-3">
                                <label class="required" for="address">Адрес</label>
                                <input type="text" name="address" class="form-control" id="address" value="<?= old('address') ?>">
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-md-6 offset-md-3 mt20 mb30">
                        <div class="form-floating mb-3">
                            <label for="note">Примечание</label>
                            <textarea name="note" class="form-control" id="note" style="height: 100px"><?= old('note') ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-3 mt20">
                        <button type="submit" class="btn btn-danger btn-lg">Отправить</button>
                    </div>
                </form>

            <?php else: ?>
                <h4 class="text-start">Корзина пуста</h4>
            <?php endif; ?>

        </div>

    </div>
</div>

<?= $this->endSection(); ?>

