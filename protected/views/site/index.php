<?php

use app\components\TActiveForm;
use app\models\Category as ModelsCategory;
use app\modules\blog\models\search\Category;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>


<!-- Frntre Banner -->
<section class="frntre-banner">
	<div class="item">
		<video loop="loop" autoplay="autoplay">
			<source src="https://secure.img1-ag.wfcdn.com//media/video/35/355501.mp4" type="video/mp4">
		</video>
	</div>
	<div class="item">
		<video loop="loop" autoplay="autoplay">
			<source src="https://secure.img1-ag.wfcdn.com//media/video/34/346607.mp4" type="video/mp4">
		</video>
	</div>
	<div class="item">
		<video loop="loop" autoplay="autoplay">
			<source src="https://secure.img1-ag.wfcdn.com//media/video/35/355792.mp4" type="video/mp4">
		</video>
	</div>
</section>
<?php
$categoryModel = ModelsCategory::find()->where(['state_id' => Category::STATE_ACTIVE])->all();
?>
<!-- Frntre Products -->
<section class="frntre-products">
	<diuv class="container">
		<h2 class="section-title">Shop by Department</h2>
		<div class="row">
			<?php foreach ($categoryModel as $category) { ?>
				<div class="col-lg-2 col-md-4 col-6">
					<a href="<?=Url::toRoute(['site/listing','category_id'=>$category->id,'menu_id'=>$category->id]) ?>" class="product-item">
						<div class="frntre-image"><img src="<?= $this->theme->getUrl('assets_html/images/product1.png') ?>" alt="Furniture"></div>
						<div class="product-name"><?= $category->title ?></div>
					</a>
				</div>
			<?php } ?>
		</div>
		</div>
</section>

<!-- Frntre Services -->
<section class="frntre-services">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="service-item">
					<img src="<?= $this->theme->getUrl('assets_html/images/service1.png') ?>" alt="Amazing Value Every Day" width="110">
					<h2>Amazing Value Every Day</h2>
					<p>Items you love at prices that fit your budget.</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="service-item">
					<img src="<?= $this->theme->getUrl('assets_html/images/service2.png') ?>" alt="Fast &amp; Free Shipping Over $49*" width="110">
					<h2>Fast &amp; Free Shipping Over $49*</h2>
					<p>Plus, two-day delivery on thousands of items.</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="service-item">
					<img src="<?= $this->theme->getUrl('assets_html/images/service3.png') ?>" alt="Expert Customer Service" width="110">
					<h2>Expert Customer Service</h2>
					<p>Our friendly team’s on hand seven days a week.</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="service-item">
					<img src="<?= $this->theme->getUrl('assets_html/images/service4.png') ?>" alt="Unbeatable Selection" width="110">
					<h2>Unbeatable Selection</h2>
					<p>All things home, all in one place.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Frntre Footer -->
<footer class="frntre-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-6">
				<h4>About Us</h4>
				<ul>
					<li><a href="#0">About Wayfair</a></li>
					<li><a href="#0">Wayfair Professional</a></li>
					<li><a href="#0">MyWay Loyalty Program</a></li>
					<li><a href="#0">Gift Cards</a></li>
					<li><a href="#0">Wayfair Credit Card</a></li>
					<li><a href="#0">Careers</a></li>
					<li><a href="#0">Sell on Wayfair</a></li>
					<li><a href="#0">Investor Relations</a></li>
					<li><a href="#0">Advertise with Us</a></li>
					<li><a href="#0">Locations</a></li>
				</ul>
			</div>
			<div class="col-md-4 col-6">
				<h4>Customer Service</h4>
				<ul>
					<li><a href="#0">My Orders</a></li>
					<li><a href="#0">Track My Order</a></li>
					<li><a href="#0">Return Policy</a></li>
					<li><a href="#0">Help Center</a></li>
					<li><a href="#0">Report a Bug</a></li>
				</ul>
			</div>
			<div class="col-md-4 col-6">
				<h4>Customer Service</h4>
				<ul>
					<li><a href="#0">My Orders</a></li>
					<li><a href="#0">Track My Order</a></li>
					<li><a href="#0">Return Policy</a></li>
					<li><a href="#0">Help Center</a></li>
					<li><a href="#0">Report a Bug</a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>

<!-- Frntre Copyright -->
<section class="frntre-copyright">
	<div class="container">
		<ul>
			<li><a href="#0">Terms of Use</a></li>
			<li><a href="#0">Privacy Policy</a></li>
			<li><a href="#0">Interest-Based Ads</a></li>
			<li><a href="#0">Shop Wayfair International</a></li>
		</ul>
		<p>&copy; 2002 - 2020 by Wayfair LLC, 4 Copley Place, 7th Floor, Boston, MA 02116</p>
	</div>
</section>

<!-- Frntre Hover Overlay -->
<div class="frntre-hover-overlay">&nbsp;</div>

<!-- Frntre Modal, Fade -->
<div class="modal fade" id="ShippingReturns">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-header">
					<h4 class="modal-title">Simple Shipping and Returns</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="row shipping-returns">
					<div class="col-lg-4">
						<div class="retirn-item">
							<div class="icon-wrap">
								<div class="icon-inner">
									<svg viewBox="0 0 989 762" class="frntre-icon">
										<path d="M1 1L1 649.46L66.46 649.46C78.57 712.9 134.45 761 201.37 761C268.28 761 324.16 712.9 336.28 649.46L617.97 649.46C630.09 712.9 685.97 761 752.88 761C819.8 761 875.68 712.9 887.79 649.46L988 649.46L988 289.98L758.11 1L1 1ZM822.21 623.64C822.21 632.76 820.43 641.47 817.21 649.46C806.95 674.93 781.99 692.97 752.88 692.97C723.78 692.97 698.82 674.93 688.56 649.46C685.34 641.47 683.55 632.76 683.55 623.64C683.55 620.87 683.74 618.14 684.05 615.44C685.56 602.74 690.5 591.09 697.94 581.43C710.62 564.96 730.53 554.31 752.88 554.31C775.24 554.31 795.14 564.96 807.83 581.43C815.26 591.09 820.21 602.74 821.71 615.44C822.03 618.14 822.21 620.87 822.21 623.64ZM270.7 623.64C270.7 632.76 268.91 641.47 265.69 649.46C255.43 674.93 230.47 692.97 201.37 692.97C172.26 692.97 147.3 674.93 137.04 649.46C133.83 641.47 132.04 632.76 132.04 623.64C132.04 620.87 132.22 618.14 132.54 615.44C134.04 602.74 138.99 591.09 146.42 581.43C159.11 564.96 179.01 554.31 201.37 554.31C223.72 554.31 243.63 564.96 256.31 581.43C263.75 591.09 268.69 602.74 270.2 615.44C270.52 618.14 270.7 620.87 270.7 623.64ZM919.98 581.43L883.59 581.43C865.74 526.28 813.9 486.28 752.88 486.28C691.87 486.28 640.02 526.28 622.17 581.43L332.08 581.43C314.23 526.28 262.38 486.28 201.37 486.28C140.35 486.28 88.51 526.28 70.66 581.43L69.02 581.43L69.02 69.03L707.69 69.03L707.69 335.88L919.98 335.88L919.98 581.43L919.98 581.43ZM775.72 267.85L775.72 132.4L883.47 267.85L775.72 267.85L775.72 267.85ZM411.51 399.15L534.65 399.15L534.65 334.12L476.53 334.12L476.53 316.4L534.65 316.4L534.65 251.37L476.53 251.37L476.53 235.42L534.65 235.42L534.65 170.39L411.51 170.39L411.51 399.15ZM557.23 399.15L680.37 399.15L680.37 334.12L622.25 334.12L622.25 316.4L680.37 316.4L680.37 251.37L622.25 251.37L622.25 235.42L680.37 235.42L680.37 170.39L557.23 170.39L557.23 399.15ZM90.74 396.65L155.76 396.65L155.76 332.21L213.88 332.21L213.88 267.18L155.76 267.18L155.76 235.25L213.88 235.25L213.88 170.22L90.74 170.22L90.74 396.65ZM385.44 338.4L385.44 170.39L229.78 170.39L229.78 396.48L294.81 396.48L294.81 371.97L365.5 423.9L385.63 396.48L405.77 369.07L364.01 338.4L385.44 338.4ZM294.81 235.42L320.41 235.42L320.41 273.37L294.81 273.37L294.81 235.42Z" />
									</svg>
								</div>
							</div>
							<div class="return-info">
								<h2>FREE Shipping over $49</h2>
								<p>and $4.99 flat-rate shipping for orders under $49</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="retirn-item">
							<div class="icon-wrap">
								<div class="icon-inner">
									<svg viewBox="0 0 908 910" class="frntre-icon">
										<path d="M906 113.62L725.56 113.62L725.56 1L564.58 1L564.58 113.62L343.42 113.62L343.42 1L182.44 1L182.44 113.62L2 113.62L2 909L906 909L906 113.62L906 113.62ZM629.57 113.62L629.57 66.01L660.57 66.01L660.57 113.62L660.57 178.63L660.57 190.02L629.57 190.02L629.57 178.63L629.57 113.62ZM247.43 113.62L247.43 66.01L278.43 66.01L278.43 113.62L278.43 178.63L278.43 190.02L247.43 190.02L247.43 178.63L247.43 113.62ZM66.99 178.63L182.44 178.63L182.44 255.03L343.42 255.03L343.42 178.63L564.58 178.63L564.58 255.03L725.56 255.03L725.56 178.63L841.01 178.63L841.01 298.45L66.99 298.45L66.99 178.63ZM841.01 843.99L66.99 843.99L66.99 363.46L841.01 363.46L841.01 843.99L841.01 843.99ZM120.94 571.98L188.94 571.98L188.94 639.99L120.94 639.99L120.94 571.98ZM270.47 571.98L338.47 571.98L338.47 639.99L270.47 639.99L270.47 571.98ZM420 571.98L488 571.98L488 639.99L420 639.99L420 571.98ZM569.53 571.98L637.53 571.98L637.53 639.99L569.53 639.99L569.53 571.98ZM719.06 571.98L787.06 571.98L787.06 639.99L719.06 639.99L719.06 571.98ZM120.94 714.59L188.94 714.59L188.94 782.6L120.94 782.6L120.94 714.59ZM270.47 714.59L338.47 714.59L338.47 782.6L270.47 782.6L270.47 714.59ZM569.53 430.55L637.53 430.55L637.53 498.56L569.53 498.56L569.53 430.55ZM719.06 430.55L787.06 430.55L787.06 498.56L719.06 498.56L719.06 430.55Z" />
									</svg>
								</div>
							</div>
							<div class="return-info">
								<h2>FAST 2-day shipping</h2>
								<p>on thousands of items—from toasters to towel racks</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="retirn-item">
							<div class="icon-wrap">
								<div class="icon-inner">
									<svg viewBox="0 0 953 689" class="frntre-icon">
										<path d="M951 94.01L363.93 94.23L372.23 1L202.18 1L202.18 66.01L252.04 66.01L301.21 66.01L298.52 96.3L284.52 253.44L2 253.44L2 318.45L278.72 318.45L274.44 366.51L145.46 366.51L145.46 431.52L268.65 431.52L265.98 461.47L819.62 461.47L951 94.01ZM337 396.46L343.95 318.45L397.12 318.45L397.12 253.44L349.74 253.44L358.14 159.25L858.74 159.06L773.86 396.46L337 396.46ZM628.71 656.8C645.44 676.63 670.74 688 698.12 688C751.79 688 800.95 646.11 810.06 592.63C814.76 565 807.74 537.63 790.79 517.55C774.07 497.71 748.77 486.34 721.38 486.34L347.1 486.34C293.44 486.34 244.27 528.23 235.17 581.71C230.47 609.34 237.49 636.71 254.43 656.8C271.16 676.63 296.46 688 323.84 688C377.51 688 426.67 646.11 435.78 592.63C438.18 578.49 437.51 564.42 434.02 551.35L619.39 551.35C614.67 560.85 611.26 571.05 609.45 581.71C604.75 609.34 611.77 636.71 628.71 656.8ZM366.87 559.48C371.51 564.98 373.24 572.88 371.73 581.71C367.99 603.7 345.61 622.99 323.84 622.99C315.4 622.99 308.57 620.18 304.08 614.86C299.44 609.36 297.71 601.46 299.22 592.63C302.96 570.64 325.34 551.35 347.1 551.35C355.55 551.35 362.38 554.16 366.87 559.48ZM741.15 559.48C745.79 564.98 747.51 572.88 746.01 581.71C742.27 603.7 719.89 622.99 698.12 622.99C689.68 622.99 682.85 620.18 678.36 614.86C673.72 609.36 671.99 601.46 673.5 592.63C677.24 570.64 699.62 551.35 721.38 551.35C729.83 551.35 736.66 554.16 741.15 559.48ZM80.91 144.65L255.56 144.65L255.56 209.66L80.91 209.66L80.91 144.65Z" />
									</svg>
								</div>
							</div>
							<div class="return-info">
								<h2>EASY returns</h2>
								<p>on most orders if something's not quite right</p>
							</div>
						</div>
					</div>
				</div>
				<div class="text-center pt-1">
					<p>*0Free shipping is only available in the contiguous U.S. Some exclusions apply, including flooring, large fixtures, and non-standard items. Wayfair reserves the right to change this offer at any time. Read more on <a href="#0">shipping policy</a> or <a href="#0">return policy</a>.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Frntre Modal, Fade -->
<div class="modal fade" id="LoginSignup">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body frntre-login">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<ul class="nav nav-tabs nav-justified justify-content-center">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#Login">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#Signup">Signup</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="Login">
			
						<div class="form-group">
							<div class="control-icon">
								<svg viewBox="0 0 514 514" class="frntre-icon">
									<path d="M438.02 331.98C410.14 304.1 376.95 283.46 340.74 270.96C379.52 244.25 405 199.55 405 149C405 67.39 338.61 1 257 1C175.39 1 109 67.39 109 149C109 199.55 134.48 244.25 173.26 270.96C137.05 283.46 103.86 304.1 75.98 331.98C27.63 380.33 1 444.62 1 513L41 513C41 393.9 137.9 297 257 297C376.1 297 473 393.9 473 513L513 513C513 444.62 486.37 380.33 438.02 331.98ZM257 257C197.45 257 149 208.55 149 149C149 89.45 197.45 41 257 41C316.55 41 365 89.45 365 149C365 208.55 316.55 257 257 257Z" />
								</svg>
							</div>

							<input type="text" name="UsernameEmail" placeholder="Username / Email" class="form-control" id="UsernameEmail">
						</div>
						<div class="form-group">
							<div class="control-icon">
								<svg viewBox="0 0 450 514" class="frntre-icon">
									<path d="M339 327C350.05 327 359 335.95 359 347C359 358.05 350.05 367 339 367C327.95 367 319 358.05 319 347C319 335.95 327.95 327 339 327ZM429 453C440.05 453 449 444.05 449 433L449 269C449 224.89 413.11 189 369 189L344.96 189L344.96 118.47C344.96 53.69 291.13 1 224.96 1C158.79 1 104.96 53.69 104.96 118.47L104.96 189L81 189C36.89 189 1 224.89 1 269L1 433C1 477.11 36.89 513 81 513L369 513C413.11 513 449 477.11 449 433C449 421.95 440.05 413 429 413C417.95 413 409 421.95 409 433C409 455.06 391.06 473 369 473L81 473C58.94 473 41 455.06 41 433L41 269C41 246.94 58.94 229 81 229L369 229C391.06 229 409 246.94 409 269L409 433C409 444.05 417.95 453 429 453ZM304.96 189L144.96 189L144.96 118.47C144.96 75.75 180.85 41 224.96 41C269.07 41 304.96 75.75 304.96 118.47L304.96 189ZM188 327C199.05 327 208 335.95 208 347C208 358.05 199.05 367 188 367C176.95 367 168 358.05 168 347C168 335.95 176.95 327 188 327ZM113 327C124.05 327 133 335.95 133 347C133 358.05 124.05 367 113 367C101.95 367 93 358.05 93 347C93 335.95 101.95 327 113 327ZM263 327C274.05 327 283 335.95 283 347C283 358.05 274.05 367 263 367C251.95 367 243 358.05 243 347C243 335.95 251.95 327 263 327Z" />
								</svg>
							</div>
							<input type="password" name="Password" placeholder="Password" class="form-control" id="Password">
						</div>
						<div class="clearfix">
							<div class="row">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="RememberMe">
										<label class="custom-control-label" for="RememberMe">Remember Me</label>
									</div>
								</div>
								<div class="col-6 textright"><a href="#0">Forgot Password?</a></div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-dark">Sign In</button>
						</div>
						</form>
						<div class="account-option">
							<p><span>or login using</span></p>
							<a href="#0" class="facebook">
								<span>
									<svg viewBox="0 0 154 322" class="frntre-icon">
										<path d="M101.81 105.86L101.81 78.29C101.81 74.15 102 70.94 102.39 68.68C102.78 66.41 103.66 64.18 105.03 61.98C106.4 59.78 108.61 58.26 111.67 57.41C114.73 56.57 118.81 56.15 123.89 56.15L151.62 56.15L151.62 1.01L107.28 1.01C81.62 1.01 63.2 7.06 52 19.16C40.8 31.27 35.2 49.09 35.2 72.65L35.2 105.86L1.99 105.86L1.99 161L35.2 161L35.2 320.99L101.81 320.99L101.81 161L146.15 161L152.01 105.86L101.81 105.86Z" />
									</svg>
									Facebook
								</span>
							</a>
							<a href="#0" class="google">
								<span>
									<svg viewBox="0 0 322 322" class="frntre-icon">
										<path d="M161 129L161 193L251.53 193C238.31 230.25 202.73 257 161 257C108.07 257 65 213.93 65 161C65 108.07 108.07 65 161 65C183.94 65 206.02 73.22 223.18 88.17L265.22 39.91C236.42 14.82 199.43 1 161 1C72.78 1 1 72.78 1 161C1 249.22 72.78 321 161 321C249.22 321 321 249.22 321 161L321 129L161 129Z" />
									</svg>
									Google
								</span>
							</a>
						</div>
					</div>
					<div class="tab-pane" id="Signup">
						<form>
							<div class="form-group">
								<div class="control-icon">
									<svg viewBox="0 0 514 378" class="frntre-icon">
										<path d="M453 1L61 1C27.92 1 1 27.92 1 61L1 317C1 350.08 27.92 377 61 377L453 377C486.08 377 513 350.08 513 317L513 61C513 27.92 486.08 1 453 1ZM473 317C473 328.03 464.03 337 453 337L61 337C49.97 337 41 328.03 41 317L41 61C41 49.97 49.97 41 61 41L453 41C464.03 41 473 49.97 473 61L473 317ZM469.6 25.94L257 184.07L44.4 25.94L20.52 58.03L257 233.93L493.48 58.03L469.6 25.94Z" />
									</svg>
								</div>
								<input type="email" name="Email" placeholder="Email" class="form-control" id="Email">
							</div>
							<div class="form-group">
								<div class="control-icon">
									<svg viewBox="0 0 514 514" class="frntre-icon">
										<path d="M438.02 331.98C410.14 304.1 376.95 283.46 340.74 270.96C379.52 244.25 405 199.55 405 149C405 67.39 338.61 1 257 1C175.39 1 109 67.39 109 149C109 199.55 134.48 244.25 173.26 270.96C137.05 283.46 103.86 304.1 75.98 331.98C27.63 380.33 1 444.62 1 513L41 513C41 393.9 137.9 297 257 297C376.1 297 473 393.9 473 513L513 513C513 444.62 486.37 380.33 438.02 331.98ZM257 257C197.45 257 149 208.55 149 149C149 89.45 197.45 41 257 41C316.55 41 365 89.45 365 149C365 208.55 316.55 257 257 257Z" />
									</svg>
								</div>
								<input type="text" name="FirstName" placeholder="First Name" class="form-control" id="FirstName">
							</div>
							<div class="form-group">
								<div class="control-icon">
									<svg viewBox="0 0 514 514" class="frntre-icon">
										<path d="M438.02 331.98C410.14 304.1 376.95 283.46 340.74 270.96C379.52 244.25 405 199.55 405 149C405 67.39 338.61 1 257 1C175.39 1 109 67.39 109 149C109 199.55 134.48 244.25 173.26 270.96C137.05 283.46 103.86 304.1 75.98 331.98C27.63 380.33 1 444.62 1 513L41 513C41 393.9 137.9 297 257 297C376.1 297 473 393.9 473 513L513 513C513 444.62 486.37 380.33 438.02 331.98ZM257 257C197.45 257 149 208.55 149 149C149 89.45 197.45 41 257 41C316.55 41 365 89.45 365 149C365 208.55 316.55 257 257 257Z" />
									</svg>
								</div>
								<input type="text" name="LastName" placeholder="Last Name" class="form-control" id="LastName">
							</div>
							<div class="form-group">
								<div class="control-icon">
									<svg viewBox="0 0 450 514" class="frntre-icon">
										<path d="M339 327C350.05 327 359 335.95 359 347C359 358.05 350.05 367 339 367C327.95 367 319 358.05 319 347C319 335.95 327.95 327 339 327ZM429 453C440.05 453 449 444.05 449 433L449 269C449 224.89 413.11 189 369 189L344.96 189L344.96 118.47C344.96 53.69 291.13 1 224.96 1C158.79 1 104.96 53.69 104.96 118.47L104.96 189L81 189C36.89 189 1 224.89 1 269L1 433C1 477.11 36.89 513 81 513L369 513C413.11 513 449 477.11 449 433C449 421.95 440.05 413 429 413C417.95 413 409 421.95 409 433C409 455.06 391.06 473 369 473L81 473C58.94 473 41 455.06 41 433L41 269C41 246.94 58.94 229 81 229L369 229C391.06 229 409 246.94 409 269L409 433C409 444.05 417.95 453 429 453ZM304.96 189L144.96 189L144.96 118.47C144.96 75.75 180.85 41 224.96 41C269.07 41 304.96 75.75 304.96 118.47L304.96 189ZM188 327C199.05 327 208 335.95 208 347C208 358.05 199.05 367 188 367C176.95 367 168 358.05 168 347C168 335.95 176.95 327 188 327ZM113 327C124.05 327 133 335.95 133 347C133 358.05 124.05 367 113 367C101.95 367 93 358.05 93 347C93 335.95 101.95 327 113 327ZM263 327C274.05 327 283 335.95 283 347C283 358.05 274.05 367 263 367C251.95 367 243 358.05 243 347C243 335.95 251.95 327 263 327Z" />
									</svg>
								</div>
								<input type="password" name="Password" placeholder="Password" class="form-control" id="Password">
							</div>
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-dark">Sign up</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>