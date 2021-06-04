<?php

use app\models\Product;
use yii\helpers\Url;
use yii\helpers\VarDumper;

?>

<!-- Frntre Product Listings -->

<?php
$modelTest = new Product();
$requestData = Yii::$app->request->get();
if (isset($requestData['category_id']) && $requestData['menu_id']) {
  $category_id = $requestData['category_id'];
  $menu_id = $requestData['menu_id'];
}


?>

<section class="frntre-product-listings">
  <div class="row full-col-479">

    <?php
    if (isset($requestData['category_id']) && $requestData['menu_id']) {
      $models = Product::find()->asArray()->where([
        'category_id' => $category_id,
        'menu_id' => $menu_id
      ])
        ->all();
    } else {
      $models = Product::find()->all();
    }
    foreach ($models as $model) {

    ?>


      <?php $productImageArray = json_decode($model['image_file']);
      if (isset($productImageArray)) {

      ?>

        <div class="col-lg-4 col-6">
          <a href="<?= Url::toRoute(['site/product-view', 'product_id' => $model['id']]); ?>" class="product-list">
            <div class="product-wrap">
              <span class="badge">Sale </span>

              <div class="frntre-image" style="height:auto;">
         <?= $modelTest->displayImage($model['thumb_main_file'], ['class' => 'profile-pic'], 'default.png', true); ?>
                <div class="view-icon">
                  <svg viewBox="0 0 514 356" class="frntre-icon">

                    <path id="Forma 1" class="shp0" d="M505.4 166.78C504.83 165.94 499.77 158.48 497.05 154.92C484.31 138.29 454.47 99.35 413.34 65.28C361.83 22.63 309.23 1 257 1C204.77 1 152.17 22.63 100.66 65.29C59.53 99.35 29.69 138.29 16.95 154.92C14.23 158.48 9.17 165.94 8.6 166.78L1 178L8.59 189.22C9.16 190.06 14.22 197.52 16.95 201.08C29.69 217.71 59.53 256.65 100.66 290.72C152.16 333.37 204.77 355 257 355C309.23 355 361.83 333.37 413.34 290.71C454.47 256.65 484.31 217.71 497.05 201.08C499.77 197.52 504.84 190.06 505.4 189.22L513 178L505.4 166.78ZM257 315C189.37 315 119.6 268.9 49.64 178C119.61 87.09 189.37 41 257 41C324.63 41 394.4 87.09 464.36 178C394.39 268.9 324.63 315 257 315ZM257 139C278.53 139 295.98 156.46 295.98 178C295.98 199.54 278.53 217 257 217C235.48 217 218.03 199.54 218.03 178C218.03 156.46 235.48 139 257 139ZM257 64C194.18 64 143.07 115.14 143.07 178C143.07 240.86 194.18 292 257 292C319.82 292 370.93 240.86 370.93 178C370.93 115.14 319.82 64 257 64ZM257 252C216.22 252 183.05 218.8 183.05 178C183.05 137.2 216.22 104 257 104C297.78 104 330.95 137.2 330.95 178C330.95 218.8 297.78 252 257 252Z" />

                  </svg>

                </div>
              </div>
              <div class="product-info">
                <ul class="product-thumbs">
                  <?php foreach ($productImageArray as $key => $value) {
                    $imageName = $productImageArray[$key];
                  ?>
                    <li> <?= $modelTest->displayImage($imageName, ['class' => 'profile-pic'], 'default.png', true); ?></li> <?php } ?>

                </ul>
                <h2 class="product-title"><?= $model['title'] ?></h2>
                <h3 class="product-price"><?= $model['price'] . 'INR' ?></h3>
                <h4 class="product-cashback">Get Additional $200 Cashback Order Today</h4>
              </div>
            </div>
          </a>
        </div>

    <?php
      }
    }
    ?>
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
