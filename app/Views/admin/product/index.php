<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <a href="<?= route_to('admin.product.new'); ?>" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить товар</a>
                </div>

                <div class="card-body">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Фильтр</h3>
                        </div>
                        <div class="card-body">

                            <form action="<?= route_to('admin.product'); ?>" method="get" class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="category_id">Категория товара</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option></option>
                                        <?= view_cell('\App\Libraries\Category::getCategoriesList', ['category_id' => $category_id]) ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="status">Статус</label>
                                    <select class="form-control" name="status" id="status">
                                        <option></option>
                                        <option value="1" <?= $status == 1 ? 'selected' : '' ?>>Включено</option>
                                        <option value="0" <?= $status == 0 ? 'selected' : '' ?>>Отключено</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Фильтр</button>
                                    <a href="<?= route_to('admin.product'); ?>" class="btn btn-danger">Сброс фильтров</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <?php if (!empty($products)): ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Наименование</th>
                            <th>Цена</th>
                            <th>Статус</th>
                            <th>Категория</th>
                            <th style="width: 40px"><i class="fas fa-pencil-alt"></i></th>
                            <th style="width: 40px"><i class="far fa-trash-alt"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['id']; ?></td>
                                <td><?= $product['title']; ?></td>
                                <td><?= $product['price']; ?></td>
                                <td>
                                    <?= $product['status'] ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>' ?>
                                </td>
                                <td><?= $product['category_title']; ?></td>
                                <td>
                                    <a class="btn btn-info btn-sm"
                                       href="<?= route_to('admin.product.edit', $product['id']); ?>"><i
                                            class="fas fa-pencil-alt"></i></a>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm delete"
                                       href="<?= route_to('admin.product.delete', $product['id']); ?>">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <? //= $pager->links(); ?>
                    <?= $pager->links('default', 'admin_pager'); ?>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection(); ?>
