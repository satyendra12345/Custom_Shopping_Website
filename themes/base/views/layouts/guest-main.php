<?php

use app\assets\AppAsset;
use app\components\FlashMessage;
use app\models\Cart;
use app\models\Category;
use app\models\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

?>
<?php

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
	<?php

	$this->head() ?>
	<meta charset="<?= Yii::$app->charset ?>" />
	<?= Html::csrfMetaTags() ?>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
	<title><?= Html::encode($this->title) ?></title>

	<!-- Custome theme change -->

	<link href="<?= $this->theme->getUrl('assets_html/css/slick-theme.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $this->theme->getUrl('assets_html/css/slick.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $this->theme->getUrl('assets_html/css/jquery.mCustomScrollbar.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $this->theme->getUrl('assets_html/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $this->theme->getUrl('assets_html/css/styles.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $this->theme->getUrl('assets_html/css/responsive.css') ?>" rel="stylesheet" type="text/css">

</head>

<body>
	<?php

	$this->beginBody() ?>
	<!-- Frntre Topbar -->
	<section class="frntre-topbar">
		<div class="row align-items-center">
			<div class="col-md-6">
				<div class="frntre-column">
					<a href="#0" class="explore-products">Furniture, Decor &amp; More Over $49 SHIP FREE* | Explore</a>
				</div>
			</div>
			<div class="col-md-6 col-dsktp-tblt">
				<div class="frntre-column textright">
					<a href="javascript:void(0);" class="shipping-details" data-toggle="modal" data-target="#ShippingReturns">Shipping Details*</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Frntre Header -->
	<header class="frntre-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-7 col-md-9 col-7">
					<a href="<?=Url::toRoute(['site/index'])?>" class="frntre-brand"><img src=<?= $this->theme->getUrl('assets_html/images/logo.png') ?> alt="Furniture" width="150"></a>
					<form class="frntre-search">
						<svg viewBox="0 0 28 28" class="frntre-icon">
							<path d="M21.7 20.3l-3.4-3.4c2-2.7 1.8-6.4-.6-8.9C15 5.3 10.6 5.3 8 8c-2.7 2.7-2.7 7 0 9.6 1.3 1.3 3.1 2 4.8 2 1.4 0 2.8-.5 4-1.3l3.4 3.4c.2.2.5.3.7.3s.5-.1.7-.3c.5-.4.5-1 .1-1.4zM9.4 16.2a4.77 4.77 0 0 1 0-6.8c.9-.9 2.2-1.4 3.4-1.4s2.5.5 3.4 1.4c1.9 1.9 1.9 4.9 0 6.8a4.77 4.77 0 0 1-6.8 0z"></path>
						</svg>
						<input type="text" name="FindAnything" placeholder="Find anything home..." autocomplete="off" spellcheck="false" class="form-control" id="FindAnything">
						<button type="submit" name="FindSubmit" id="FindSubmit">
							<svg viewBox="0 0 28 28" class="frntre-icon">
								<path d="M21.7 20.3l-3.4-3.4c2-2.7 1.8-6.4-.6-8.9C15 5.3 10.6 5.3 8 8c-2.7 2.7-2.7 7 0 9.6 1.3 1.3 3.1 2 4.8 2 1.4 0 2.8-.5 4-1.3l3.4 3.4c.2.2.5.3.7.3s.5-.1.7-.3c.5-.4.5-1 .1-1.4zM9.4 16.2a4.77 4.77 0 0 1 0-6.8c.9-.9 2.2-1.4 3.4-1.4s2.5.5 3.4 1.4c1.9 1.9 1.9 4.9 0 6.8a4.77 4.77 0 0 1-6.8 0z"></path>
							</svg>
						</button>
						<div class="search-results"></div>
					</form>
				</div>
				<div class="col-lg-5 col-md-3 col-5">
					<ul class="user-menus-wrap">
						<li data-hover="AccountOrders">
							<a href="javascript:void(0);">
								<svg viewBox="0 0 28 28" class="frntre-icon">
									<path d="M14 5a9 9 0 1 0 0 18 9 9 0 0 0 0-18zm-3.65 15v-1.71a2.43 2.43 0 0 1 2.43-2.42h2.44a2.43 2.43 0 0 1 2.43 2.42V20a6.93 6.93 0 0 1-7.3 0zM14 13.51a1.29 1.29 0 1 1 0-2.58 1.29 1.29 0 0 1 0 2.58zm5.63 4.63a4.41 4.41 0 0 0-3-4 3.32 3.32 0 0 0 .62-1.91 3.29 3.29 0 0 0-6.58 0 3.32 3.32 0 0 0 .62 1.91 4.41 4.41 0 0 0-3 4A6.92 6.92 0 0 1 7 14a7 7 0 0 1 14 0 6.92 6.92 0 0 1-1.37 4.14z"></path>
								</svg>
								<span class="user-menu">
									My Account &amp; Orders
									<span>Sign In</span>
								</span>
							</a>
							<div class="account-popup" data-hover-popup="AccountOrders">
								<h2>Welcome</h2>
								<ul>
									<li>
										<a href="javascript:void(0);" data-toggle="modal" data-target="#LoginSignup">
											<svg viewBox="0 0 28 28" class="frntre-icon">
												<path d="M14 5a9 9 0 1 0 0 18 9 9 0 0 0 0-18zm-3.65 15v-1.71a2.43 2.43 0 0 1 2.43-2.42h2.44a2.43 2.43 0 0 1 2.43 2.42V20a6.93 6.93 0 0 1-7.3 0zM14 13.51a1.29 1.29 0 1 1 0-2.58 1.29 1.29 0 0 1 0 2.58zm5.63 4.63a4.41 4.41 0 0 0-3-4 3.32 3.32 0 0 0 .62-1.91 3.29 3.29 0 0 0-6.58 0 3.32 3.32 0 0 0 .62 1.91 4.41 4.41 0 0 0-3 4A6.92 6.92 0 0 1 7 14a7 7 0 0 1 14 0 6.92 6.92 0 0 1-1.37 4.14z"></path>
											</svg>
											<span class="user-menu">My Account</span>
										</a>
									</li>
									<li>
										<a href="javascript:void(0);" data-toggle="modal" data-target="#LoginSignup">
											<svg viewBox="0 0 28 28" class="frntre-icon">
												<path d="M23.71 6.59a1 1 0 0 0-1.06-.24L15.45 9a1 1 0 0 0-.58.56l-1.44 3.57-3.78-1.37 4.7-1.76a1 1 0 0 0 .54-1.38l-1.8-3.58a1 1 0 0 0-1.24-.49l-7.2 2.7a1 1 0 0 0-.58.57 1 1 0 0 0 0 .81L5.8 12v7.82a1 1 0 0 0 .65.93l7.15 2.69a1 1 0 0 0 .35.06 1 1 0 0 0 .53-.14l7-2.61a1 1 0 0 0 .65-.93V12l1.73-4.3a1 1 0 0 0-.15-1.11zm-7.15 4.16L21.23 9l-.79 2-4.67 1.75zm-4.85-4l.9 1.79-5.32 2-.9-1.8zM13 21.08l-5.2-1.95V13.2l5.2 1.94zm2 0v-5.94l5.2-1.94v5.93z"></path>
											</svg>
											<span class="user-menu">My Orders</span>
										</a>
									</li>
									<li><a href="javascript:void(0);" class="btn btn-dark" data-toggle="modal" data-target="#LoginSignup">Sign In or Create an Account</a></li>
								</ul>
							</div>
						</li>
						<li class="right-align" data-hover="Notifications">
							<a href="javascript:void(0);">
								<svg viewBox="0 0 28 28" class="frntre-icon shake-animation">
									<g id="Layer_1">
										<path d="M19.715,17.301c-0.017-0.018-1.717-1.854-1.73-6.32c-0.009-2.607-1.69-4.824-4.019-5.641C13.984,5.229,14,5.117,14,5   c0-1.103-0.896-2-2-2s-2,0.897-2,2c0,0.116,0.016,0.228,0.034,0.338c-2.336,0.816-4.019,3.036-4.019,5.646   c0,4.462-1.711,6.296-1.721,6.306c-0.287,0.286-0.374,0.716-0.22,1.091S4.595,19,5,19h3.143c0.447,1.72,1.999,3,3.857,3   s3.41-1.28,3.857-3H19c0.4,0,0.758-0.243,0.915-0.61S19.991,17.591,19.715,17.301z M12,7c2.189,0,3.978,1.789,3.984,3.987   c0.002,0.728,0.046,1.396,0.118,2.013h-8.2c0.071-0.617,0.113-1.286,0.113-2.016C8.016,8.788,9.803,7,12,7z M12,20   c-0.737,0-1.375-0.405-1.722-1h3.443C13.375,19.595,12.737,20,12,20z M6.814,17c0.352-0.736,0.705-1.731,0.938-3h8.502   c0.234,1.269,0.588,2.264,0.938,3H6.814z" />
									</g>
								</svg>
								<span class="user-menu">Notifications</span>
							</a>
							<div class="notifications-popup" data-hover-popup="Notifications">
								<div class="frntre-scroll">
									<a href="#0" class="notification-item">
										<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h2>
										<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									</a>
									<a href="#0" class="notification-item">
										<h2>Duis aute irure dolor in reprehenderit in voluptate velit</h2>
										<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									</a>
									<a href="#0" class="notification-item">
										<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h2>
										<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									</a>
								</div>
							</div>
						</li>

						<?php 
						  $cart_count = Cart::find()->where(['created_by_id' => $_SERVER['REMOTE_ADDR']])->count();
						
						?>
						<li class="right-align" data-hover="Cart">
                      	<a href="javascript:void(0);">
								<svg viewBox="0 0 28 28" class="frntre-icon">
									<path d="M20.86 18.14H10.19l.91-1.31h9.76a1 1 0 0 0 1-.83L23 9.38a1 1 0 0 0-.23-.81 1 1 0 0 0-.77-.36H9.63l-.38-1.46a1 1 0 0 0-1-.75H6a1 1 0 1 0 0 2h1.51l2 7.64-2 2.93a1 1 0 0 0-.06 1 1 1 0 0 0 .89.53h.46a1.38 1.38 0 1 0 2.4 0h6.74a1.47 1.47 0 0 0-.17.66 1.38 1.38 0 1 0 2.57-.66h.52a1 1 0 1 0 0-2v.04zm-.05-7.93L20 14.83h-8.65l-1.2-4.62h10.66z"></path>
								</svg>
								<span class="user-menu"><?=$cart_count?><a href="<?=Url::toRoute(['listing'])?>"></a></span>
							</a>
							<div class="cart-popup" data-hover-popup="Cart">

							  <?php  
							 $cartItem = Cart::find()->where(['created_by_id' => $_SERVER['REMOTE_ADDR']])->all();
							 foreach($cartItem as $item){
							 ?>
								<h2>Product Id <?=$item->product_id ?></h2>
								<p>Created BY <?=$item->created_by_id?></p>
								<a href="javascript:void(0);" class="btn btn-dark btn-block" data-toggle="modal" data-target="#LoginSignup">Sign In</a>
							<?php  } ?>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</header>
	<!-- Frntre Nav -->
	<?php
	$categoryModel = Menu::find()->where(['state_id' => Category::STATE_ACTIVE])->limit(10)->all();
	?>
   <nav class="frntre-nav">
	<ul>
	<?php foreach ($categoryModel as $category) { ?>
				<li>
					<a href="#0"><span class="menu-text"><?= $category->title ?></span></a>
				</li>
			<?php } ?>
		</ul>
	</nav>

	<?= $content ?>

	<!-- ADD FOOTER -->

	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- All Jquery -->
	<!-- custom theme jquery -->

	<script src="<?= $this->theme->getUrl('assets_html/js/jquery.min.js') ?>"></script>
	<script src="<?= $this->theme->getUrl('assets_html/js/popper.min.js') ?>"></script>
	<script src="<?= $this->theme->getUrl('assets_html/js/bootstrap.min.js') ?>"></script>
	<script src="<?= $this->theme->getUrl('assets_html/js/html5.min.js') ?>"></script>
	<script src="<?= $this->theme->getUrl('assets_html/js/placeholders.min.js') ?>"></script>
	<script src="<?= $this->theme->getUrl('assets_html/js/respond.min.js') ?>"></script>
	<script src="<?= $this->theme->getUrl('assets_html/js/bootstrap-4-autocomplete.min.js') ?>"></script>
	<script src="<?= $this->theme->getUrl('assets_html/js/jquery.elevateZoom-3.0.8.min.js') ?>"></script>
	<script src="<?= $this->theme->getUrl('assets_html/js/jquery.mCustomScrollbar.min.js') ?>"></script>
	<script src="<?= $this->theme->getUrl('assets_html/js/scripts.js') ?>"></script>
	<script src="<?= $this->theme->getUrl('assets_html/js/slick.min.js') ?>"></script>





	<?php

	$this->endBody() ?>
</body>
<?php

$this->endPage() ?>

</html>