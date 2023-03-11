<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <?php
                    $errors_data = session()->has('errors') ? esc(session()->getFlashdata('errors')) : [];
                    ?>

                    <form action="<?= route_to('admin.user.create'); ?>" method="post">

                        <?= csrf_field(); ?>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="required" for="email">Email</label>
                                <input type="text" name="email" class="form-control <?= add_error_class($errors_data, 'email'); ?>" id="title" value="<?= old('email') ?>">
                                <?= display_error($errors_data, 'email'); ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="required" for="password">Пароль</label>
                                <input type="password" name="password" class="form-control <?= add_error_class($errors_data, 'password'); ?>" id="password">
                                <?= display_error($errors_data, 'password'); ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="required" for="name">Имя</label>
                                <input type="text" name="name" class="form-control <?= add_error_class($errors_data, 'name'); ?>" id="name" value="<?= old('name') ?>">
                                <?= display_error($errors_data, 'name'); ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="required" for="address">Адрес</label>
                                <input type="text" name="address" class="form-control <?= add_error_class($errors_data, 'address'); ?>" id="address" value="<?= old('address') ?>">
                                <?= display_error($errors_data, 'address'); ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="required" for="role">Роль</label>
                                <select class="form-control" name="role" id="role">
                                    <option value="user" <?= set_select('role', 'user')  ?>>Пользователь</option>
                                    <option value="admin" <?= set_select('role', 'admin')  ?>>Администратор</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Сохранить</button>

                    </form>

                </div>


            </div>

        </div>
    </div>

</div>

<?= $this->endSection(); ?>

