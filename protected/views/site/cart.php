<?php

use app\models\Cart;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use phpbrowscap\Browscap;

?>

<!-- Frntre Mid Wrap -->

<section class="frntre-mid-wrap">

  <div class="container">

    <div class="frntre-account-wrap process-wrap">

      <div class="frntre-columns-row">

        <div class="frntre-secondary">

          <div class="frntre-back-link">

            <a href="#0">

              <svg viewBox="0 0 28 28" class="frntre-icon">

                <path d="M6.27 14.826a.79.79 0 0 1-.2-.31.842.842 0 0 1-.07-.35v-.03a.842.842 0 0 1 .07-.35.79.79 0 0 1 .2-.31l3.17-3.18a1 1 0 0 1 1.42 1.41l-1.46 1.43h11.09a1 1 0 0 1 0 2H9.4l1.47 1.48a1 1 0 1 1-1.42 1.41l-3.17-3.18-.01-.02z"></path>

              </svg>Continue Shopping

            </a>

          </div>

          <div class="page-title">My Cart</div>

          <div class="whitebox">

            <div class="whitebox-wrap">Shipment 1 of 2</div>

          </div>
<!-- ------------------------------------------------ -->

<?php 
	$bc = new Browscap(BASE_PATH . "/runtime/cache");
  $current_browser = $bc->getBrowser(null, true);
  $str = json_encode($current_browser);
  $browser_id = md5($str);
  $total_price = 0;
  if (Yii::$app->user->identity) {

    $cart_items = Cart::find()->where(['created_by_id' =>Yii::$app->user->identity->id])->all();

  } else {
    $cart_items = Cart::find()->where(['browser_id' => $browser_id])->all();
   
  }
 
 
 
  foreach($cart_items as $cart_item)
  {
    
  $total_price+=$cart_item->product->price;
?>

          <div class="whitebox">

            <span class="badge">Sale</span>

            <div class="whitebox-wrap cart-item">

              <div class="frntre-image">
          
                <a href="#0"><img src="<?=$this->theme->getUrl('assets_html/images/product5.jpg') ?>" alt="Aeryn Sectional by Beachcrest Home"></a>

              </div>

              <div class="cart-info">

                <div class="row">

                  <div class="col-sm-7">

                    <h2 class="product-title"><a href="#0"><?=$cart_item->product->title;?></a></h2>

                    <h3>by Upper Square™ | W001708488</h3>

                    <h3>Upholstery Color: Stax Forest Green</h3>

                    <div class="product-review">

                      <a href="#0">

                        <span class="rating-wrap">

                          <span style="width: 91%;"></span>

                        </span>

                        <span class="rating-number">102</span>

                      </a>

                    </div>

                  </div>

                  <div class="col-sm-5">

                    <div class="cart-right">

                      <h4 class="product-price"><?=$cart_item->product->price.' INR';?></h4>

                      <div class="clearfix">

                        <div class="quantity-selector">

                          <div class="form-group has-select-style">

                            <label for="Quantity">Quantity</label>

                            <select name="Quantity" class="form-control" id="Quantity">

                              <option>1</option>

                              <option>2</option>

                              <option>3</option>

                              <option>4</option>

                              <option>5</option>

                              <option>6</option>

                              <option>7</option>

                              <option>8</option>

                              <option>9</option>

                              <option>10</option>

                            </select>

                          </div>

                        </div>

                      </div>

                      <div class="cart-actions">

                        <a href="<?=Url::toRoute(['cart/remove','id'=>$cart_item->id])?>">

                          <svg viewBox="0 0 28 28" class="frntre-icon">

                            <path d="M20 9h-2.1c-.4-1.7-2-3-3.9-3s-3.4 1.3-3.9 3H8c-.6 0-1 .4-1 1s.4 1 1 1v8c0 1.7 1.3 3 3 3h6c1.7 0 3-1.3 3-3v-8c.6 0 1-.4 1-1s-.4-1-1-1zm-7 2h2v9h-2v-9zm1-3c.7 0 1.4.4 1.7 1h-3.4c.3-.6 1-1 1.7-1zm-4 11v-8h1v9c-.6 0-1-.4-1-1zm8 0c0 .6-.4 1-1 1v-9h1v8z"></path>

                          </svg>Remove

                        </a>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <?php } ?>
<!-- --------------- -->
  

        </div>

        <div class="frntre-primary">

          <div class="whitebox">

            <div class="whitebox-wrap">

              <div class="qualifies-order">

                <div class="icon-wrap">

                  <svg viewBox="0 0 64 64" class="frntre-icon">

                    <path d="M42.5 41.5l18.4.2c1.4 0 2.5-1.3 2.5-2.8V33c0-1.5-.5-2.9-1.4-4l-7.3-6.9c-.9-1.1-2.2-1.7-3.5-1.7h-8.6" fill="#fff"></path>

                    <path fill="#c5d7dc" d="M32.2 42.5h-13c-1.3 0-2.4-1.3-2.4-3v-21c0-1.6 1.1-3 2.4-3H40c1.3 0 2.4 1.3 2.4 3v21c0 1.6-1.1 3-2.4 3h-7.8m17.3-19.4v7.2c0 1.3 1 2.4 2.3 2.4h7l-9.3-9.6z"></path>

                    <path fill="#91b1bb" d="M37.7 19.6s-3.4 20.8-19.9 20.8V42h22.3V19.8l-.6-.8-1.8.6z"></path>

                    <path fill="#29202b" d="M11 36.6H5.5c-.7 0-1.2-.5-1.2-1.2s.5-1.2 1.2-1.2H11c.7 0 1.2.5 1.2 1.2s-.5 1.2-1.2 1.2zm1.2-6.2c0-.7-.5-1.2-1.2-1.2H2.6c-.7 0-1.2.5-1.2 1.2s.5 1.2 1.2 1.2H11c.7 0 1.2-.5 1.2-1.2zm0-4.9c0-.7-.5-1.2-1.2-1.2H7.6c-.7 0-1.2.5-1.2 1.2s.5 1.2 1.2 1.2H11c.7 0 1.2-.5 1.2-1.2zM52 29.2h-4.8c-.6 0-1 .5-1 1s.5 1 1 1H52c.6 0 1-.5 1-1s-.4-1-1-1zm9.2 6v3.6c0 2.2-1.8 3.9-3.9 3.9h-2.5c0 .2.1.3.1.5 0 2.9-2.4 5.2-5.3 5.2s-5.3-2.3-5.3-5.2c0-.2 0-.3.1-.5H31.3c0 .2.1.3.1.5 0 2.9-2.4 5.2-5.3 5.2s-5.3-2.3-5.3-5.2c0-.2 0-.3.1-.5h-2.5c-1.7 0-3.1-1.4-3.1-3.1V20.3c0-1.7 1.4-3.1 3.1-3.1h19.4c1.7 0 3.1 1.4 3.1 3.1V22H48c1.8 0 3.5.7 4.7 2l6.5 6.6c1.3 1.2 2 2.8 2 4.6zM38.4 20.3c0-.4-.3-.7-.7-.7H18.3c-.4 0-.7.3-.7.7v19.3c0 .4.3.7.7.7h3.3c.9-1.4 2.5-2.3 4.3-2.3 1.8 0 3.4.9 4.3 2.3h7.4c.4 0 .7-.3.7-.7V20.3zm20.3 14.9c0-1.1-.4-2.2-1.2-3L51 25.6c-.8-.8-1.9-1.3-3-1.3h-7.2v15.2c0 .3-.1.5-.1.7h4.5c.9-1.4 2.5-2.3 4.3-2.3 1.8 0 3.4.9 4.3 2.3h3.4c.8 0 1.5-.7 1.5-1.5v-3.5z"></path>

                    <path d="M26 45c-1 0-1.9-.8-1.9-1.8s.8-1.8 1.9-1.8 1.9.8 1.9 1.8S27 45 26 45zm25.3-1.8c0-1-.8-1.8-1.9-1.8-1 0-1.9.8-1.9 1.8s.8 1.8 1.9 1.8c1.1 0 1.9-.8 1.9-1.8z" fill="#fff"></path>

                  </svg>

                </div>

                <span>This order qualifies for free shipping!</span>

              </div>

            </div>

          </div>

          <div class="whitebox total-amount-wrap">

            <div class="whitebox-wrap">

              <dl class="row">

                <dt class="col-8">Subtotal:</dt>

                <dd class="col-4"><?=$total_price . 'INR'?></dd>

                <dt class="col-8">

                  Ship To:

                  <a href="javascript:void(0);" class="zip-toggle">

                    67346 - Grenola

                    <svg viewBox="0 0 28 28" class="frntre-icon">

                      <path d="M19.2 11.3c-.4-.4-1-.4-1.4-.1L14 14.7l-3.8-3.4c-.4-.4-1-.3-1.4.1-.4.4-.3 1 .1 1.4l4.5 4c.2.2.4.3.7.3s.5-.1.7-.3l4.5-4c.3-.4.3-1.1-.1-1.5z"></path>

                    </svg>

                  </a>

                  <div class="form-group zip-update">

                    <input type="text" name="ZipCode" placeholder="Zip code" class="form-control" id="ZipCode">

                    <button type="submit" class="btn btn-dark">Update</button>

                  </div>

                </dt>

                <dd class="col-4">FREE</dd>

                <dt class="col-8">Tax:</dt>

                <dd class="col-4">$393.37</dd>

                <dt class="col-8 total">Total:</dt>

                <dd class="col-4 total"><?=$total_price.'INR'?></dd>

                <dt class="col-8">You Save:</dt>

                <dd class="col-4">$3,888.56</dd>

              </dl>
              <?php if($total_price>0) { ?>
              <button type="submit" class="btn btn-dark btn-lg btn-block" style="color:white"><a href="<?=Url::toRoute(['site/check-out'])?>">Proceed to Checkout</a></button>
              <?php } ?>
            </div>

          </div>

          <div class="add-card">

            <a href="javascript:void(0);" class="zip-toggle">Add Gift Card/Promo Code</a>

            <div class="form-group zip-update">

              <input type="text" name="AddCard" placeholder="Add Gift Card/Promo Code" class="form-control" id="AddCard">

              <button type="submit" class="btn btn-dark">Apply</button>

            </div>

          </div>

          <div class="frntre-features">

            <div class="feature-item">

              <div class="icon-wrap">

                <svg viewBox="0 0 28 28" class="frntre-icon">

                  <path d="M20 10h-2a4 4 0 1 0-8 0H8a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V11a1 1 0 0 0-1-1zm-6-2a2 2 0 0 1 2 2h-4a2 2 0 0 1 2-2zm5 12H9v-8h10v8z"></path>

                  <path d="M14 13.5a1 1 0 0 0-1 1v3a1 1 0 0 0 2 0v-3a1 1 0 0 0-1-1z"></path>

                </svg>

              </div>

              <div class="feature-info">

                <h2>Secure Shopping</h2>

                <p>Our checkout meets the credit card industry’s rigorous PCI security standards.</p>

              </div>

            </div>

            <div class="feature-item">

              <div class="icon-wrap">

                <svg viewBox="0 0 28 28" class="frntre-icon">

                  <path d="M22.9 14.3a1 1 0 0 0 0-.8c-1.3-3-5.4-5.6-8.9-5.6a9.9 9.9 0 0 0-3.8.9L7.7 6.3a1 1 0 0 0-1.4 1.4l2.1 2.1a8.5 8.5 0 0 0-3.3 3.8 1 1 0 0 0 0 .8c1.3 3 5.4 5.6 8.9 5.6a9.8 9.8 0 0 0 3.7-.8l2.6 2.6a1 1 0 0 0 1.4-1.4l-2.2-2.2a8.6 8.6 0 0 0 3.4-3.9zM14 17.9a8.7 8.7 0 0 1-6.9-4 7.4 7.4 0 0 1 2.7-2.7l1.5 1.5a3 3 0 0 0-.3 1.2 3 3 0 0 0 3 3l1.2-.3.9.9a7.1 7.1 0 0 1-2.1.4zm.4-4.9a1 1 0 0 1 .5.5zm3.6 3.6l-1.4-1.4a3 3 0 0 0 .3-1.3 3 3 0 0 0-3-3 3 3 0 0 0-1.3.3l-.9-.9a7.2 7.2 0 0 1 2.3-.4 8.7 8.7 0 0 1 6.9 4 7.5 7.5 0 0 1-2.8 2.8z"></path>

                </svg>

              </div>

              <div class="feature-info">

                <h2>Privacy Protection</h2>

                <p>Your privacy is always our number-one priority.</p>

              </div>

            </div>

            <div class="feature-item">

              <div class="icon-wrap">

                <svg viewBox="0 0 28 28" class="frntre-icon">

                  <path d="M21.3 16.7l-2.4-1.9a1.8 1.8 0 0 0-2.6.4l-.6.8a7.8 7.8 0 0 1-3.9-3.4l.8-.9a1.8 1.8 0 0 0 .2-2.1l-1.6-2.8A1.7 1.7 0 0 0 10 6a2.1 2.1 0 0 0-1.7.7L6.5 8.5a1.8 1.8 0 0 0-.5 1.6C8.1 20.7 16.6 21.9 18.3 22h.1a1.8 1.8 0 0 0 1.4-.6l1.8-2a1.8 1.8 0 0 0-.3-2.7zm-3 3.3C16.2 19.8 9.7 18.5 8 9.9l1.7-1.8 1.4 2.4-.8.9a1.8 1.8 0 0 0-.3 2.1 9.8 9.8 0 0 0 5.1 4.5 1.8 1.8 0 0 0 2-.6l.7-.8 2.1 1.6z"></path>

                </svg>

              </div>

              <div class="feature-info">

                <h2>Exceptional Customer Service</h2>

                <p>Have questions before you check out? We're here to help!</p>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</section>


