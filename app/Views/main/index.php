<?= $this->extend('layouts/default') ?>


<?= $this->section('content') ?>

<?php if (!empty($products)): ?>
	<section class="main-content mt10">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="content">
							<h3>Recommended items</h3>
							
                                                        <?= view_cell('\App\Libraries\Product::productsLoop', ['products' => $products]); ?>
							
						</div> 
					</div>
				</div>
				
			</div>
		</div>
	</section>
<?php endif; ?>

	<section class="bottom-content">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h3>Get Discounts and Free Offers</h3>
					<h4>Get free coupens, discounts and new arivals</h4>
				</div>
				<div class="col-md-8">
					<form class="form-inline">
						<div class="row">
							<div class="form-group col-sm-4">
								<input type="text" name="name" class="form-control" placeholder="your full name">
							</div>
							<div class="form-group col-sm-4">
								<input type="email" name="email" class="form-control" placeholder="your email address">
							</div>
							<div class="form-group col-sm-4">
								<button type="submit" class="btn btn-default">Subscribe</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

<?= $this->endSection() ?>