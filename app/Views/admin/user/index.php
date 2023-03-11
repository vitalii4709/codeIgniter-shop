<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <a href="<?= route_to('admin.user.new'); ?>" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить пользователя</a>
                </div>


                <div class="card-body">

                    <?php if (!empty($users)): ?>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Email</th>
                                <th>Имя</th>
                                <th>Роль</th>
                                <th style="width: 40px"><i class="fas fa-eye"></i></th>
                                <th style="width: 40px"><i class="fas fa-pencil-alt"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td><?= $user['name']; ?></td>
                                    <td><?= ($user['role'] == 'user') ? 'Пользователь' : 'Администратор'; ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm"
                                           href="<?= route_to('admin.user.show', $user['id']); ?>"><i class="fas fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning btn-sm"
                                           href="<?= route_to('admin.user.edit', $user['id']); ?>"><i class="fas fa-pencil-alt"></i></a>
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


