<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt10">
    <div class="container">
        <div class="row ">
            <div class="col-xs-9 col-sm-6">
                <h3><span id="">Product: <?= esc($product['title']) ?></span></h3>
            </div>
            <div class="col-xs-3 col-sm-6 " style="text-align:right;">
                <div class="hidden-xs">
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item">
                            <a href="<?= route_to('category.show', $product['category_slug']) ?>"><?= $product['category_title'] ?></a>
                        </li>
                        <li class="active"><?= esc($product['title']) ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="row single">
            <div class="col-md-12 span-single">
                <div class="single_left">
                    <div class="col-md-6 grid images_3_of_2">
                        <?php
                            if (!empty($product['gallery'])) {
                                $gallery = explode(',', $product['gallery']);
                            }
                        ?>
                        <ul id="etalage">
                            <li>
                                <a href="optionallink.html">
                                    <img class="etalage_thumb_image" src="<?= $product['img'] ?>" class="img-responsive" />
                                    <img class="etalage_source_image" src="<?= $product['img'] ?>" class="img-responsive" title="" />
                                </a>
                            </li>
                            <?php if (!empty($gallery)): ?>
                                <?php foreach ($gallery as $item): ?>
                                    <li><img class="etalage_thumb_image" src="<?= $item ?>" alt=""></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <div class="clearfix"></div>		
                    </div>
                    <div class="col-md-6 desc1 span_3_of_2">
                        <h3><?= $product['title'] ?></h3>
                        <h5>Category: <?= $product['category_title'] ?></h5>
                        <div class="mt20">
                            <p class="product-price">Price: <?= $product['price'] ?> ₽</p>
                            <!--<input id="input-quantity" type="text" class="form-control" name="quantity" value="1">-->
                            <a href="<?= route_to('cart.add', $product['id']) ?>" class="add-to-cart button" data-id="<?= $product['id'] ?>">add to cart</a>
                            <!--<a style="max-width: 320px;"  href="javascript:void(0)" class="button" data-id="<?= $product['id'] ?>" data-title="<?= $product['title'] ?>" data-price="<?= $product['price'] ?>" data-img="<?= $product['img'] ?>" data-count="100502">add to cart</a>-->
                        </div><!-- /.product-buy -->
                        <div class="mt20">
                            <h4>Details</h4>
                        </div>
                    </div>
                </div>
                <div class="single-bottom1" >
                    <p class="prod-desc"><?= $product['content'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
