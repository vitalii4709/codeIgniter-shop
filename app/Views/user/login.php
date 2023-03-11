<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid mt10">
    <div class="container">
        <div class="row ">
            <div class="col-xs-9 col-sm-6">
                <h3><span id="">Login</span></h3>
            </div>
            <div class="col-xs-3 col-sm-6 " style="text-align:right;">
                <div class="hidden-xs">
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li class="active">Login</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
label.required::before {
    content: '* ';
    color: #F00;
    font-weight: bold;
}
</style>

<section class="bottom-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-3">
                <?= $this->include('layouts/incs/alerts') ?>
                <form class="form-block" method="post">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label class="required" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">

                        </div>
                        <div class="form-group col-sm-12">
                            <label class="required" for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">

                        </div>
                        <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-danger ">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>