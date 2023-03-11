<?php if(!empty($_SESSION['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th><span class="far fa-trash-alt" aria-hidden="true"></span></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($_SESSION['cart'] as $id => $item): ?>
                <tr>
                    <td><a href="<?= route_to('product.show', $item['slug']) ?>"><img src="<?= $item['img'] ?>" alt="" style="width: 50px;"></a></td>
                    <td><a href="<?= route_to('product.show', $item['slug']) ?>"><?=$item['title'];?></td>
                    <td><?=$item['qty'];?></td>
                    <td><?=$item['price'];?></td>
                    <td><span data-id="<?=$id;?>" class="far fa-trash-alt text-danger del-item" aria-hidden="true"></span></td>
                </tr>
            <?php endforeach; ?>
                <tr>
                    <td>Итого:</td>
                    <td colspan="4" class="text-right cart-qty"><?=$_SESSION['cart.qty'];?></td>
                </tr>
                <tr>
                    <td>На сумму:</td>
                    <td colspan="4" class="text-right cart-sum"><?= $_SESSION['cart.sum'];?> ₽</td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h3>Корзина пуста</h3>
<?php endif; ?>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
    <?php if (!empty($_SESSION['cart'])): ?>
        <a href="<?= route_to('cart.view') ?>" class="btn btn-primary">Оформить заказ</a>
        <button type="button" class="btn btn-danger ripple" id="clear-cart">Очистить корзину</button>
    <?php endif; ?>
</div>

