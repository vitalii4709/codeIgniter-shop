<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <a href="<?= route_to('admin.category.new'); ?>" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить категорию</a>
                </div>


                <div class="card-body">

                    <?php if (!empty($categories)): ?>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Наименование</th>
                                <th style="width: 40px"><i class="fas fa-pencil-alt"></i></th>
                                <th style="width: 40px"><i class="far fa-trash-alt"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td><?= $category['id']; ?></td>
                                    <td><?= $category['title']; ?> (<?= $category['cnt']; ?>)</td>
                                    <td>
                                        <a class="btn btn-info btn-sm"
                                           href="<?= route_to('admin.category.edit', $category['id']); ?>"><i class="fas fa-pencil-alt"></i></a>
                                    </td>
                                    <td>
                                        <?php if (!$category['cnt']): ?>
                                            <a class="btn btn-danger btn-sm delete"
                                               href="<?= route_to('admin.category.delete', $category['id']); ?>">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

                <div class="card-footer clearfix">
                    <?= $pager->links('default', 'admin_pager'); ?>
                </div>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection(); ?>
