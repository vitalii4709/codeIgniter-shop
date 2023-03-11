<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= route_to('user.cabinet') ?>">Личный кабинет</a></li>
            <li class="breadcrumb-item active">Учетные данные</li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h1 class="section-title">Учетные данные</h1>

            <?= $this->include('layouts/incs/alerts'); ?>

            <form class="row g-3" method="post">

                <?= csrf_field(); ?>

                <div class="col-md-6 offset-md-3 mt20">
                    <div class="form-floating mb-3">
                        <label class="required" for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="<?= esc($_SESSION['user']['email']) ?>">
                    </div>
                </div>

                <div class="col-md-6 offset-md-3 mt20">
                    <div class="form-floating mb-3">
                        <label class="required" for="password">Пароль</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                    </div>
                </div>

                <div class="col-md-6 offset-md-3 mt20">
                    <div class="form-floating mb-3">
                        <label class="required" for="name">Имя</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?= esc($_SESSION['user']['name']) ?>">
                    </div>
                </div>

                <div class="col-md-6 offset-md-3 mt20">
                    <div class="form-floating mb-3">
                        <label class="required" for="address">Адрес</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="<?= esc($_SESSION['user']['address']) ?>">
                    </div>
                </div>

                <div class="col-md-6 offset-md-3 mt20 mb30">
                    <button type="submit" class="btn btn-danger">Отправить</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>

