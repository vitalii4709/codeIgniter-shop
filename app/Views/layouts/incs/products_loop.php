<?php /** @var array $products */ ?>
<?php foreach ($products as $product): ?>
    <div class="col-xs-12 col-sm-6 col-md-4 mt10">
        <div class="product">
            <div class="product-img mt10">
                <a href="<?= route_to('product.show', $product['slug']) ?>"><img src="<?= $product['img'] ?>" style="width: 123px;" alt=""></a>
            </div>
            <p class="product-title mt10">
                <a href="<?= route_to('product.show', $product['slug']) ?>"><?= $product['title'] ?></a>
            </p>
            <p class="product-desc"><?= $product['excerpt'] ?></p>
            <div class="product-buy">
                <p class="product-price">
                    Price: <?= $product['price'] ?> ₽
                </p>
                <!--<a href="javascript:void(0)" class="button" data-id="<?= $product['id'] ?>" data-title="<?= $product['title'] ?>" data-price="<?= $product['price'] ?>" data-img="<?= $product['img'] ?>" data-count="100502">add to cart</a>-->
                <a href="<?= route_to('cart.add', $product['id']) ?>" class="add-to-cart button" data-id="<?= $product['id'] ?>">add to cart</a>
            </div>
            
            
        </div>
    </div>
<?php endforeach; ?>



