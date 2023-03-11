<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header mb-3">
                    <h3 class="card-title">Dashboard</h3>
                </div>

                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3><?= $orders_cnt ?></h3>
                                        <p>Заказов</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                    <a href="<?= route_to('admin.order') ?>" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3><?= $orders_new_cnt ?></h3>
                                        <p>Новых заказов</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-luggage-cart"></i>
                                    </div>
                                    <a href="<?= route_to('admin.order') ?>" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3><?= $users_cnt ?></h3>
                                        <p>Пользователей</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    <a href="<?= route_to('admin.user') ?>" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3><?= $products_cnt ?></h3>
                                        <p>Товаров</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-barcode"></i>
                                    </div>
                                    <a href="<?= route_to('admin.product') ?>" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>

                    <form action="<?= route_to('admin.main'); ?>" method="get" class="form-row">

                        <div class="form-group col-md-6">
                            <label for="year">Год продаж</label>
                            <select class="form-control" name="year" id="year">
                                <?php for ($i = 2019; $i <= date('Y'); $i++): ?>
                                    <option value="<?= $i; ?>" <?= $i == $year ? 'selected' : '' ?>><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Получить данные</button>
                        </div>

                    </form>

                </div>


            </div>

        </div>
    </div>

</div>

<script>
    $(function () {

        var areaChartData = {
            labels: [<?= $labels ?>],
            datasets: [
                {
                    label: 'Продажи за <?= $year ?> год',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1,
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [<?= $values ?>]
                },
            ]
        }

        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        barChartData.datasets[0] = temp0

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        suggestedMin: 0,
                        // suggestedMax: 120
                        //suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                        // OR //
                        //beginAtZero: true   // minimum value will be 0.
                    }
                }]
            }
        }

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })


    });
</script>

<?= $this->endSection(); ?>

