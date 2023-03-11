<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt10">
    <div class="container">
        <div class="row ">
            <div class="col-xs-9 col-sm-6">
                <h3><span id="">Category: <?= esc($category['title']) ?></span></h3>
            </div>
            <div class="col-xs-3 col-sm-6 " style="text-align:right;">
                <div class="hidden-xs">
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li class="active"><?= esc($category['title']) ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 category-content">
            <?php if (!empty($products)): ?>
                <div class="row">
                    <div class="col-sm-6 mt10">
                        <div class="input-group mb30">
                            <label class="input-group-text" for="input-sort">Сортировка:</label>
                            <select class="form-select" id="input-sort">
                                <option selected disabled>По умолчанию</option>
                                <option value="sort=title_asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'title_asc') echo 'selected' ?>>Название (А - Я)</option>
                                <option value="sort=title_desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'title_desc') echo 'selected' ?>>Название (Я - А)</option>
                                <option value="sort=price_asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') echo 'selected' ?>>Цена (низкая &gt; высокая)</option>
                                <option value="sort=price_desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') echo 'selected' ?>>Цена (высокая &gt; низкая)</option>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <section class=" main-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="content">
                                    <?php if (!empty($products)): ?>
                                        <?= view_cell('\App\Libraries\Product::productsLoop', ['products' => $products]); ?>
                                    <?php else: ?>
                                        <p>There are no products in this category yet...</p>
                                    <?php endif; ?>
                                </div> <!-- /.content -->
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <?php if (!empty($products)): ?>
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation example"  style="background: #ececec;">
                            <?= $pager->links('default', 'admin_pager'); ?>
                        </nav>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

