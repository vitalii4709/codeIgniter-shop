<!DOCTYPE html>
<html lang="en">
<head>
        <!--<base href="/">-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shop :: <?= !empty($title) ? esc($title) : '' ?></title>
        <meta name="description" content="<?= $description ?? '' ?>">
        <meta name="keywords" content="<?= $keywords ?? '' ?>">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:700,400&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link href="<?= base_url('assets/front/css/style.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/front/css/elastislide.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/front/css/etalage.css') ?>" rel="stylesheet">
        <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
        
        <base href="<?= base_url() ?>">
</head>
<body id="home">
<header>
    <div class="menu-top" >
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                    <?php if (empty($_SESSION['user'])): ?>    
                        <li><a class="" href="<?= route_to('user.login') ?>">Login</a></li>
                        <li><a class="" href="<?= route_to('user.signup') ?>">Signup</a></li>
                    <?php else: ?>
                        <li><a class="" href="<?= route_to('user.cabinet') ?>">Cabinet</a></li>
                        <li><a class="" href="<?= route_to('user.logout') ?>">Logout</a></li>
                       <?php endif; ?>
                        <li><a href="#" class=" relative" data-bs-toggle="modal" data-bs-target="#cart-modal" id="get-cart">
                                Cart
                                <span class="badge bg-danger rounded-pill count-items"><?= $_SESSION['cart.qty'] ?? 0 ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    
   
    <section class="menu-carousel">
        <div id="carousel" class="carousel fade" data-ride="carousel">
            <div class="main-menu">    
                <nav class="navbar navbar-inverse">
                    <div class="container">
                        <div class="main-menu-bg">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#"><img src="<?= base_url('assets/front/img/logo.png') ?>" alt="StyleTour"><span>StyleTour</span></a>
                            </div>
                            <div class="collapse navbar-collapse" id="main-menu">
                                <ul class="nav navbar-nav">
                                    <?= view_cell('\App\Libraries\Category::getCategoriesMenu') ?>
                                </ul>
                                <div class="nav navbar-nav navbar-right">
                                    <form class="navbar-form navbar-left" role="search" method="get" action="">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-default" name="go"><i class="glyphicon glyphicon-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <i class="search glyphicon glyphicon-search"></i>
                        </div>
                    </div>
                </nav>
            </div> 
                        <!-- Indicators -->
            <div class="carousel-indicators-wrap">
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel" data-slide-to="1"></li>
                    <li data-target="#carousel" data-slide-to="2"></li>
                    <li data-target="#carousel" data-slide-to="3"></li>
                    <li data-target="#carousel" data-slide-to="4"></li>
                    <li data-target="#carousel" data-slide-to="5"></li>
                </ol>
            </div><!-- /.carousel-indicators-wrap -->

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                    <!-- <img src="img/slider.jpg" alt=""> -->
                                    <div class="bgslide" style="background-image: url(<?= base_url('assets/front/img/slider.jpg') ?>);"></div>
                                    <div class="container">
                                            <div class="carousel-caption">
                                                    <h1>Women's Apparel</h1>
                                                    <h3>Clothing, Drinkware, Bags, Gifts Items and More...</h3>
                                                    <a href="#" class="btn-red">Fashion Items Store</a>
                                            </div>
                                    </div>
                            </div>
                            <div class="item">
                                    <!-- <img src="img/slider.jpg" alt=""> -->
                                    <div class="bgslide" style="background-image: url(<?= base_url('assets/front/img/slider3.jpg') ?>);"></div>
                                    <div class="container">
                                            <div class="carousel-caption">
                                                    <h1>Man's Apparel</h1>
                                                    <h3>Clothing, Drinkware, Bags, Gifts Items and More...</h3>
                                                    <a href="#" class="btn-red">Fashion Items Store</a>
                                            </div>
                                    </div>
                            </div>
                            <div class="item">
                                    <!-- <img src="img/slider.jpg" alt=""> -->
                                    <div class="bgslide" style="background-image: url(<?= base_url('assets/front/img/slider4.jpg') ?>);"></div>
                                    <div class="container">
                                            <div class="carousel-caption">
                                                    <h1>Kid's Apparel</h1>
                                                    <h3>Clothing, Drinkware, Bags, Gifts Items and More...</h3>
                                                    <a href="#" class="btn-red">Fashion Items Store</a>
                                            </div>
                                    </div>
                            </div>
                            <div class="item">
                                    <!-- <img src="img/slider.jpg" alt=""> -->
                                    <div class="bgslide" style="background-image: url(<?= base_url('assets/front/img/drink.jpg') ?>);"></div>
                                    <div class="container">
                                            <div class="carousel-caption">
                                                    <h1>Drinkware Items</h1>
                                                    <h3>Clothing, Drinkware, Bags, Gifts Items and More...</h3>
                                                    <a href="#" class="btn-red">Fashion Items Store</a>
                                            </div>
                                    </div>
                            </div>
                            <div class="item">
                                    <!-- <img src="img/slider.jpg" alt=""> -->
                                    <div class="bgslide" style="background-image: url(<?= base_url('assets/front/img/bags.jpg') ?>);"></div>
                                    <div class="container">
                                            <div class="carousel-caption">
                                                    <h1>Bags </h1>
                                                    <h3>Clothing, Drinkware, Bags, Gifts Items and More...</h3>
                                                    <a href="#" class="btn-red">Fashion Items Store</a>
                                            </div>
                                    </div>
                            </div>
                            <div class="item">
                                    <!-- <img src="img/slider.jpg" alt=""> -->
                                    <div class="bgslide" style="background-image: url(<?= base_url('assets/front/img/gifts.jpg') ?>);"></div>
                                    <div class="container">
                                            <div class="carousel-caption">
                                                    <h1>Gifts Items</h1>
                                                    <h3>Clothing, Drinkware, Bags, Gifts Items and More...</h3>
                                                    <a href="#" class="btn-red">Fashion Items Store</a>
                                            </div>
                                    </div>
                            </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                    </a>
            </div>
    </section>
</header>
    
<?= $this->renderSection('content') ?>

<footer>
    <div class="footer-menu mt20">
        <div class="container">
            <div class="row" style="color: #fff;">
                <div class="col-md-4 col-12">
                    <h4>Информация</h4>
                    <?= view_cell('\App\Libraries\Page::getPagesMenu') ?>
                </div>

                <div class="col-md-4 col-12">
                    <h4>Время работы</h4>
                    <ul class="list-unstyled">
                        <li>г. Санкт-Петербург, ул. Морская, 10</li>
                        <li>пн-вс: 9:00 - 18:00</li>
                        <li>без перерыва</li>
                    </ul>
                </div>

                <div class="col-md-4 col-12">
                    <h4>Контакты</h4>
                    <ul class="list-unstyled">
                        <li><a href="tel:5551234567">555 123-45-67</a></li>
                        <li><a href="tel:5551234567">555 123-45-68</a></li>
                        <li><a href="tel:5551234567">555 123-45-69</a></li>
                    </ul>
                </div>                       
            </div>
        </div>
        <div class="up-arrow" style="text-align: right;">
                <a class="scroll" href="#home"><img src="<?= base_url('assets/front/img/up.png') ?>" alt=""></a>
        </div>
    </div>

    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>&copy; 2023 Fashion Store. All Rights Reserved.</p>
                </div>
                <div class="col-md-8 text-right pay">
                    <a href="#"><img src="<?= base_url('assets/front/img/pay1.jpg') ?>" alt=""></a>
                    <a href="#"><img src="<?= base_url('assets/front/img/pay3.jpg') ?>" alt=""></a>
                    <a href="#"><img src="<?= base_url('assets/front/img/pay4.jpg') ?>" alt=""></a>
                    <a href="#"><img src="<?= base_url('assets/front/img/pay7.jpg') ?>" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</footer>
    
    <!-- Modal -->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cart</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

    <script>
        const baseUrl = '<?= base_url() ?>';
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/front/js/simpleCart.min.js') ?>"></script>
    <script src="<?= base_url('assets/front/js/jquery.elastislide.js') ?>"></script>
    <script src="<?= base_url('assets/front/js/jquery.etalage.min.js') ?>"></script>
    <script>
        jQuery(document).ready(function($){

            $('#etalage').etalage({
                thumb_image_width: 300,
                thumb_image_height: 400,
                source_image_width: 800,
                source_image_height: 1000,
                show_hint: true,
                click_callback: function(image_anchor, instance_id){
                        alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
                }
            });

        });
    </script>
    <script src="<?= base_url('assets/front/js/scripts.js') ?>"></script>
    <script src="<?= base_url('assets/front/js/main.js') ?>"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){		
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
            });
        });
    </script>
</body>

</html>


