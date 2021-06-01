<?php

use app\models\Product;
use yii\helpers\Url;

$requestData = Yii::$app->request->get();
$product_id = $requestData['product_id'];
$productModel = Product::findOne($product_id);
$productImageArray = json_decode($productModel['image_file']);
$modelTest = new Product();

?>



<!-- Frntre Mid Wrap -->
<section class="frntre-mid-wrap product-detail">
  <div class="container">
    <div class="whitebox no-border">
      <div class="row">
        <div class="col-lg-6">
          <div class="whitebox-wrap">
            <h1 class="product-title"><?=$productModel->title?></h1>
            <div class="product-slider">
              <div class="frntre-main-slider has-rounded-arrow">
                <div class="item">
                <?=$modelTest->displayImageWithZoom($productModel->thumb_main_file, ['class' => 'frntre-image'], 'default.png', true); ?>
                  <span class="badge">Sale</span>
                </div>
                <?php foreach ($productImageArray as $key => $value) {
                    $imageName = $productImageArray[$key];
                ?>
                 <div class="item">
               <?=  $modelTest->displayImageWithZoom($imageName, ['class' => 'frntre-image'], 'default.png', true); ?>
                  </div>

                <?php  } ?>
              </div>
              <div class="frntre-thumb-slider">
                <?php foreach ($productImageArray as $key => $value) {
                  $imageName = $productImageArray[$key];
                ?>
                <div class="item">
                 <div class="frntre-image"><?=$modelTest->displayImageWithZoom($imageName, ['class' => 'frntre-image'], 'default.png', true); ?></div>
                </div>
                <?php  } ?>
              </div>
            </div>
          </div>
          <div class="frequently-products">
            <div class="whitebox">
              <div class="whitebox-wrap">
                <div class="frequently-wrap">
                  <h5 class="border-title">Frequently bought together</h5>
                  <div class="row">
                    <div class="col-4">
                      <a href="#0" class="product-list current-product">
                        <div class="product-wrap">
                          <h6 class="viewing-item">Item you're currently viewing</h6>
                          <div class="frntre-image">
                            <img src="<?= $this->theme->getUrl('assets_html/images/product2.jpg') ?>" alt="Aeryn Sectional">
                          </div>
                          <div class="product-info">
                            <h3 class="product-bundle">
                              <svg viewBox="0 0 28 28" class="frntre-icon">
                                <path d="M20.7 13.7L18.1 11l-3.6-3.6c-.2-.2-.4-.3-.7-.3 0 0-6.5-.2-6.7 0s0 6.7 0 6.7c0 .3.1.5.3.7l6.2 6.3c.4.4 1.1.4 1.5 0l5.5-5.5c.5-.6.5-1.2.1-1.6zm-9.2-.7c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5 1.5.7 1.5 1.5-.7 1.5-1.5 1.5z"></path>
                              </svg>
                              Bundle &amp; Save
                            </h3>
                            <h4 class="product-price">$839.99</h4>
                            <h5 class="product-discount"><span>Save $461.30</span> Was $1,999.99</h5>
                            <h6 class="product-disclaimer">Offer disclaimer</h6>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-4">
                      <a href="#0" class="product-list">
                        <div class="product-wrap">
                          <div class="frntre-image">
                            <img src="<?= $this->theme->getUrl('assets_html/images/product-color3.jpg') ?>" alt="Aeryn Sectional">
                          </div>
                          <div class="product-info">
                            <h2 class="product-title">Aeryn Sectional by Beachcrest Home</h2>
                            <h3 class="product-bundle">
                              <svg viewBox="0 0 28 28" class="frntre-icon">
                                <path d="M20.7 13.7L18.1 11l-3.6-3.6c-.2-.2-.4-.3-.7-.3 0 0-6.5-.2-6.7 0s0 6.7 0 6.7c0 .3.1.5.3.7l6.2 6.3c.4.4 1.1.4 1.5 0l5.5-5.5c.5-.6.5-1.2.1-1.6zm-9.2-.7c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5 1.5.7 1.5 1.5-.7 1.5-1.5 1.5z"></path>
                              </svg>
                              Bundle &amp; Save
                            </h3>
                            <h4 class="product-price">$839.99</h4>
                            <h5 class="product-discount"><span>Save $461.30</span> Was $1,999.99</h5>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="SelectedOne">
                              <label for="SelectedOne" class="custom-control-label">Selected</label>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-4">
                      <a href="#0" class="product-list">
                        <div class="product-wrap">
                          <div class="frntre-image">
                            <img src="<?= $this->theme->getUrl('assets_html/images/product4.jpg') ?>" alt="Aeryn Sectional">
                          </div>
                          <div class="product-info">
                            <h2 class="product-title">Aeryn Sectional by Beachcrest Home</h2>
                            <h3 class="product-bundle">
                              <svg viewBox="0 0 28 28" class="frntre-icon">
                                <path d="M20.7 13.7L18.1 11l-3.6-3.6c-.2-.2-.4-.3-.7-.3 0 0-6.5-.2-6.7 0s0 6.7 0 6.7c0 .3.1.5.3.7l6.2 6.3c.4.4 1.1.4 1.5 0l5.5-5.5c.5-.6.5-1.2.1-1.6zm-9.2-.7c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5 1.5.7 1.5 1.5-.7 1.5-1.5 1.5z"></path>
                              </svg>
                              Bundle &amp; Save
                            </h3>
                            <h4 class="product-price">$839.99</h4>
                            <h5 class="product-discount"><span>Save $461.30</span> Was $1,999.99</h5>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="Selected">
                              <label for="Selected" class="custom-control-label">Selected</label>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="frequently-subtotal">
                    <span><span>Subtotal:</span> <strong>$1,879.98</strong></span>
                    <a href="#0" class="btn btn-dark btn-sm">
                      <svg viewBox="0 0 28 28" class="frntre-icon">
                        <path d="M23.2 8.6c-.5-.1-1.1.2-1.2.8L20.6 16h-8.4L9.6 8.7c-.1-.4-.5-.7-.9-.7H5c-.6 0-1 .4-1 1s.4 1 1 1h3l2.6 7.3s0 .1.1.1c0 .1.1.1.1.2l.1.1c.1.1.1.1.2.1 0 0 .1 0 .1.1.1 0 .2.1.3.1h9.9c.5 0 .9-.3 1-.8L24 9.8c.1-.5-.2-1.1-.8-1.2z"></path>
                        <circle cx="12.5" cy="20.5" r="1.5"></circle>
                        <circle cx="20.5" cy="20.5" r="1.5"></circle>
                        <path d="M13 11h2v2c0 .6.4 1 1 1s1-.4 1-1v-2h2c.6 0 1-.4 1-1s-.4-1-1-1h-2V7c0-.6-.4-1-1-1s-1 .4-1 1v2h-2c-.6 0-1 .4-1 1s.4 1 1 1z"></path>
                      </svg>
                      Add 2 Items to Cart
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="product-info-wrap">
            <div class="row">
              <div id="zoomWindow"></div>
              <div class="col-md-7 order-md-1">
                <h2 class="product-price"><?=$productModel->price.' INR'?><span>$1,799.00</span> <span class="off">74% Off</span> <span class="product-status">On Sale</span></h2>
                <div class="product-colors">
                  <h3><strong>Color:</strong> <span class="product-color-name">Color 1</span></h3>
                  <ul>
                    <li>
                      <a href="#0" data-color="Color 1"><img src="<?= $this->theme->getUrl('assets_html/images/product-color6.jpg') ?>" alt="L Shape Sofa Six Seater In Fabric (Cream Brown)"></a>
                    </li>
                    <li>
                      <a href="#0" data-color="Color 2"><img src="<?= $this->theme->getUrl('assets_html/images/product-color7.jpg') ?>" alt="L Shape Sofa Six Seater In Fabric (Cream Brown)"></a>
                    </li>
                    <li>
                      <a href="#0" data-color="Color 3"><img src="<?= $this->theme->getUrl('assets_html/images/product-color8.jpg') ?>" alt="L Shape Sofa Six Seater In Fabric (Cream Brown)"></a>
                    </li>
                  </ul>
                </div>
                <div class="product-delivery">
                  <label for="PinCode">Delivery</label>
                  <div class="delivery-wrap">
                    <div class="form-group">
                      <svg viewBox="0 0 22 27" class="frntre-icon">
                        <path d="M20 12C20 19 11 25 11 25C11 25 2 19 2 12C2 9.61 2.95 7.32 4.64 5.64C6.32 3.95 8.61 3 11 3C13.39 3 15.68 3.95 17.36 5.64C19.05 7.32 20 9.61 20 12L20 12Z" />
                        <path d="M11 15C9.34 15 8 13.66 8 12C8 10.34 9.34 9 11 9C12.66 9 14 10.34 14 12C14 13.66 12.66 15 11 15Z" />
                      </svg>
                      <input type="text" name="PinCode" placeholder="Enter Delivery Pincode" class="form-control" id="PinCode" data-toggle="tooltip" data-placement="right" title="Enter Pincode">
                      <button type="submit" name="CheckPinCode" id="CheckPinCode">Check</button>
                    </div>
                    <div class="delivery-info">
                      <h4>
                        Usually delivered in 4-5 days
                        <a href="javascript:void(0);" data-toggle="popover" data-placement="bottom" data-container="body" data-html="true" data-popover-content="#UsuallyDelivered">
                          <svg viewBox="0 0 514 514" class="frntre-icon">
                            <path d="M257 354.5C270.81 354.5 282 365.69 282 379.5C282 393.31 270.81 404.5 257 404.5C243.19 404.5 232 393.31 232 379.5C232 365.69 243.19 354.5 257 354.5ZM257 1C115.52 1 1 115.5 1 257C1 398.48 115.5 513 257 513C398.48 513 513 398.5 513 257C513 115.52 398.5 1 257 1ZM257 473C137.62 473 41 376.39 41 257C41 137.62 137.61 41 257 41C376.38 41 473 137.61 473 257C473 376.38 376.39 473 257 473ZM257 129.5C212.89 129.5 177 165.39 177 209.5C177 220.55 185.95 229.5 197 229.5C208.05 229.5 217 220.55 217 209.5C217 187.44 234.94 169.5 257 169.5C279.06 169.5 297 187.44 297 209.5C297 231.56 279.06 249.5 257 249.5C245.95 249.5 237 258.45 237 269.5L237 319.5C237 330.55 245.95 339.5 257 339.5C268.05 339.5 277 330.55 277 319.5L277 286.97C311.47 278.07 337 246.71 337 209.5C337 165.39 301.11 129.5 257 129.5Z" />
                          </svg>
                          <div class="d-none" id="UsuallyDelivered">
                            <h6>Shipping Charges For Non Flipkart Assured Items</h6>
                            <p>Shipping charges are calculated based on the number of units, distance and delivery date.</p>
                            <p>For Plus as well as Non-Plus customers, Seller will decide shipping charges for all non-FAssured items.</p>
                            <h6>Shipping Charges For Flipkart Assured Items</h6>
                            <p>Shipping charges are calculated based on the number of units, distance and delivery date.</p>
                            <p>For Plus customers, shipping charges are free.</p>
                            <p>For non-Plus customers, if the total value of FAssured items is more than Rs.500, shipping charges are free. If the total value of FAssured items is less than Rs.500, shipping charges = Rs.40 per unit</p>
                            <p>* For faster delivery, shipping charges will be applicable</p>
                          </div>
                        </a>
                      </h4>
                      <h5>Enter pincode for exact delivery dates/charges</h5>
                      <h4>Delivery by 9 Apr, Thursday <span class="gray-color">|</span> <span class="green-color">Free <span class="darkgray-color">₹40</span></span></h4>
                      <h4>Installation &amp; Demo by 11 Apr, Saturday <span class="gray-color">|</span> <span class="green-color">Free</span></h4>
                    </div>
                  </div>
                </div>
                <div class="quantity-wrap">
                  <div class="quantity-selector">
                    <label for="Quantity">Qty:</label>
                    <input type="number" name="Quantity" value="1" min="1" max="10" class="form-control" id="Quantity">
                  </div>
                <a href="<?=Url::toRoute(['site/add-cart','product_id'=>$product_id])?>"  class="btn btn-dark">
               <svg viewBox="0 0 28 28" class="frntre-icon">
                      <path d="M23.2 8.6c-.5-.1-1.1.2-1.2.8L20.6 16h-8.4L9.6 8.7c-.1-.4-.5-.7-.9-.7H5c-.6 0-1 .4-1 1s.4 1 1 1h3l2.6 7.3s0 .1.1.1c0 .1.1.1.1.2l.1.1c.1.1.1.1.2.1 0 0 .1 0 .1.1.1 0 .2.1.3.1h9.9c.5 0 .9-.3 1-.8L24 9.8c.1-.5-.2-1.1-.8-1.2z"></path>
                      <circle cx="12.5" cy="20.5" r="1.5"></circle>
                      <circle cx="20.5" cy="20.5" r="1.5"></circle>
                      <path d="M13 11h2v2c0 .6.4 1 1 1s1-.4 1-1v-2h2c.6 0 1-.4 1-1s-.4-1-1-1h-2V7c0-.6-.4-1-1-1s-1 .4-1 1v2h-2c-.6 0-1 .4-1 1s.4 1 1 1z"></path>
                    </svg>
                    Add to Cart
                  </a>

                </div>
              </div>
              <div class="col-md-12 order-md-3">
                <div class="product-overview">
                  <h5 class="border-title">Product Overview</h5>
                  <div class="frntre-scroll">
                   <?=$productModel->description?>
                  </div>
                </div>
              </div>
              <div class="col-md-5 order-md-2">
                <div class="shopping-guarantee">
                  <div class="guarantee-wrap">
                    <div class="whitebox">
                      <div class="whitebox-wrap">
                        <div class="guarantee-list">
                          <div class="frntre-image">
                            <div class="icon-wrap"><img src="<?= $this->theme->getUrl('assets_html/images/icon4.png') ?>" alt="Top Seller"></div>
                          </div>
                          <div class="guarantee-info">Leading Name (Top Amazon.com Seller)</div>
                        </div>
                        <div class="guarantee-list">
                          <div class="frntre-image">
                            <div class="icon-wrap"><img src="<?= $this->theme->getUrl('assets_html/images/icon5.png') ?>" alt="Free Shipping"></div>
                          </div>
                          <div class="guarantee-info">Free Shipping Over 10,000</div>
                        </div>
                        <div class="guarantee-list">
                          <div class="frntre-image">
                            <div class="icon-wrap"><img src="<?= $this->theme->getUrl('assets_html/images/icon6.jpg') ?>" alt="Free Assembly"></div>
                          </div>
                          <div class="guarantee-info">Free Assembly from Us </div>
                        </div>
                        <div class="guarantee-list">
                          <div class="frntre-image">
                            <div class="icon-wrap"><img src="<?= $this->theme->getUrl('assets_html/images/icon7.png') ?>" alt="Easy Returns"></div>
                          </div>
                          <div class="guarantee-info">Easy Returns 14 Days with No Question Asked</div>
                        </div>
                        <div class="guarantee-list">
                          <div class="frntre-image">
                            <div class="icon-wrap"><img src="<?= $this->theme->getUrl('assets_html/images/icon8.png') ?>" alt="No Cost EMI"></div>
                          </div>
                          <div class="guarantee-info">No Cost EMI Available on Leading Banks Credit Card</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Frntre Related Products -->
<section class="frntre-related-products">
  <div class="container">
    <h2 class="border-title">Related Products</h2>
    <div class="related-products has-rounded-arrow">
      <div class="item">
        <a href="#0" class="product-list">
          <div class="product-wrap">
            <span class="badge">Sale</span>
            <div class="frntre-image">
              <img src="<?= $this->theme->getUrl('assets_html/images/product2.jpg') ?>" alt="Aeryn Sectional">
            </div>
            <div class="product-info">
              <h2 class="product-title">Aeryn Sectional by Beachcrest Home</h2>
              <h3 class="product-price">$839.99</h3>
            </div>
          </div>
        </a>
      </div>
      <div class="item">
        <a href="#0" class="product-list">
          <div class="product-wrap">
            <div class="frntre-image">
              <img src="<?= $this->theme->getUrl('assets_html/images/product3.jpg') ?>" alt="Edmeston Chesterfield 54.75 Rolled Arm Loveseat">
            </div>
            <div class="product-info">
              <h2 class="product-title">Edmeston by Birch Lane</h2>
              <h3 class="product-price">$559.99</h3>
            </div>
          </div>
        </a>
      </div>
      <div class="item">
        <a href="#0" class="product-list">
          <div class="product-wrap">
            <div class="frntre-image">
              <img src="<?= $this->theme->getUrl('assets_html/images/product2.jpg') ?>" alt="Aeryn Sectional">
            </div>
            <div class="product-info">
              <h2 class="product-title">Aeryn Sectional by Beachcrest Home</h2>
              <h3 class="product-price">$839.99</h3>
            </div>
          </div>
        </a>
      </div>
      <div class="item">
        <a href="#0" class="product-list">
          <div class="product-wrap">
            <span class="badge">Sale</span>
            <div class="frntre-image">
              <img src="<?= $this->theme->getUrl('assets_html/images/product3.jpg') ?>" alt="Edmeston Chesterfield 54.75 Rolled Arm Loveseat">
            </div>
            <div class="product-info">
              <h2 class="product-title">Edmeston by Birch Lane</h2>
              <h3 class="product-price">$559.99</h3>
            </div>
          </div>
        </a>
      </div>
      <div class="item">
        <a href="#0"  class="product-list">
          <div class="product-wrap">
            <span class="badge">Sale</span>
            <div class="frntre-image">
              <img src="<?= $this->theme->getUrl('assets_html/images/product2.jpg') ?>" alt="Aeryn Sectional">
            </div>
            <div class="product-info">
              <h2 class="product-title">Aeryn Sectional by Beachcrest Home</h2>
              <h3 class="product-price">$839.99</h3>
            </div>
          </div>
        </a>
      </div>
      <div class="item">
        <a href="#0" class="product-list">
          <div class="product-wrap">
            <div class="frntre-image">
              <img src="<?= $this->theme->getUrl('assets_html/images/product3.jpg') ?>" alt="Edmeston Chesterfield 54.75 Rolled Arm Loveseat">
            </div>
            <div class="product-info">
              <h2 class="product-title">Edmeston by Birch Lane</h2>
              <h3 class="product-price">$559.99</h3>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>
<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
  $ip = $_SERVER['REMOTE_ADDR'];
}
?>

<script>


</script>