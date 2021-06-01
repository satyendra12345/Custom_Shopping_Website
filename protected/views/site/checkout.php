
<!-- Frntre Mid Wrap -->
<section class="frntre-mid-wrap">
  <div class="container process-container">
    <div class="frntre-account-wrap process-wrap">
      <div class="frntre-columns-row">
        <div class="frntre-secondary">
          <form id="CheckoutForm">
            <div class="list-group">
              <div class="list-group-item" data-acc-step>
                <h2 data-acc-title>Shipping Address</h2>
                <div data-acc-content>
                  <h2 data-acc-title>Shipping Address</h2>
                  <div class="whitebox">
                    <div class="whitebox-wrap">
                      <h5 class="border-title">Add A New Address</h5>
                      <div class="form-group">
                        <input type="text" name="FullName" placeholder="Full Name" required="required" class="form-control form-control-lg" id="FullName">
                      </div>
                      <div class="form-group">
                        <textarea name="Address" placeholder="Address" required="required" class="form-control form-control-lg" id="Address"></textarea>
                      </div>
                      <div class="form-group">
                        <input type="text" name="City" placeholder="City" required="required" class="form-control form-control-lg" id="City">
                      </div>
                      <div class="form-group">
                        <input type="text" name="PinCode" placeholder="Pincode" required="required" class="form-control form-control-lg" id="PinCode">
                      </div>
                      <div class="form-group">
                        <input type="text" name="PhoneNumber" placeholder="Phone Number" required="required" class="form-control form-control-lg" id="PhoneNumber">
                      </div>
                      <div class="custom-control custom-checkbox mb-0">
                        <input type="checkbox" class="custom-control-input" id="ShippingAddress" checked="checked">
                        <label class="custom-control-label" for="ShippingAddress">Set as default shipping address</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="list-group-item" data-acc-step>
                <h2 data-acc-title>Payment Information</h2>
                <div data-acc-content>
                  <div data-acc-content-list>
                    <div class="whitebox">
                      <div class="whitebox-wrap">
                        <div class="account-info-wrap">
                          <p>Jason Carter</p>
                          <p>Demo street name <br> demo city name, Alabama, 90909 <br> United States</p>
                          <p>T: 9090909090</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div data-acc-content-list>
                    <h2 data-acc-title>Payment Information</h2>
                    <div class="payment-method">
                      <div class="custom-control custom-radio">
                        <input type="radio" id="PayPal" name="PaymentMethod" class="custom-control-input">
                        <label class="custom-control-label" for="PayPal">
                          <span class="row align-items-center">
                            <span class="col-9">PayPal/PayPal Credit</span>
                            <span class="col-3 textright"><img src="assets/images/paypal.png" alt="PayPal"></span>
                          </span>
                        </label>
                      </div>
                    </div>
                    <div class="payment-method">
                      <div class="custom-control custom-radio">
                        <input type="radio" id="PayLow" name="PaymentMethod" class="custom-control-input">
                        <label class="custom-control-label" for="PayLow">
                          <span class="row align-items-center">
                            <span class="col-9">Pay as low as $115 per month.</span>
                            <span class="col-3 textright"><img src="assets/images/wayfair-financing.png" alt="Wayfair Financing"></span>
                          </span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="list-group-item review-order" data-acc-step>
                <h2 data-acc-title>Review Order</h2>
                <div data-acc-content>
                  <h2 data-acc-title>Review Order</h2>
                  <div class="whitebox">
                    <div class="whitebox-wrap">
                      <table class="table table-striped table-has-data-th table-orders table-has-tfoot">
                        <thead>
                          <tr>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th class="text-md-right">Subtotal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td data-th="Product Name">
                              <span class="product-title">Olivia 1/4 Zip Light Jacket &copy;</span>
                              <dl>
                                <dt>Color</dt>
                                <dd>Purple</dd>
                                <dt>Size</dt>
                                <dd>M</dd>
                              </dl>
                            </td>
                            <td data-th="SKU">WJ12-M-Purple</td>
                            <td data-th="Ship"><strong>$77.00</strong></td>
                            <td data-th="Qty">Ordered: 1</td>
                            <td data-th="Subtotal" class="text-md-right"><strong>$77.00</strong></td>
                          </tr>
                          <tr>
                            <td data-th="Product Name">
                              <span class="product-title">Jade Yoga Jacket</span>
                              <dl>
                                <dt>Color</dt>
                                <dd>Gray</dd>
                                <dt>Size</dt>
                                <dd>M</dd>
                              </dl>
                            </td>
                            <td data-th="SKU">WJ09-M-Gray</td>
                            <td data-th="Ship"><strong>$32.00</strong></td>
                            <td data-th="Qty">Ordered: 1</td>
                            <td data-th="Subtotal" class="text-md-right"><strong>$32.00</strong></td>
                          </tr>
                          <tr>
                            <td data-th="Product Name">
                              <span class="product-title">Riona Full Zip Jacket</span>
                              <dl>
                                <dt>Color</dt>
                                <dd>Green</dd>
                                <dt>Size</dt>
                                <dd>L</dd>
                              </dl>
                            </td>
                            <td data-th="SKU">WJ05-L-Green</td>
                            <td data-th="Ship"><strong>$60.00</strong></td>
                            <td data-th="Qty">Ordered: 1</td>
                            <td data-th="Subtotal" class="text-md-right"><strong>$60.00</strong></td>
                          </tr>
                          <tfoot>
                            <tr>
                              <th colspan="4">Subtotal:</th>
                              <td class="text-right">$169.00</td>
                            </tr>
                            <tr>
                              <th colspan="4">Shipping &amp; Handling:</th>
                              <td class="text-right">$0.00</td>
                            </tr>
                            <tr>
                              <th colspan="4"><strong>Estimated Total:</strong></th>
                              <td class="text-right"><strong>$169.00</strong></td>
                            </tr>
                          </tfoot>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="frntre-primary col-dsktp-tblt">
          <div class="checkout-step">
            <h2 class="checkout-step-title">Order Summary</h2>
            <div class="whitebox total-amount-wrap">
              <div class="whitebox-wrap">
                <dl class="row">
                  <dt class="col-8">Subtotal:</dt>
                  <dd class="col-4">$5,244.92</dd>
                  <dt class="col-8">Ship To:</dt>
                  <dd class="col-4">FREE</dd>
                  <dt class="col-8">Tax:</dt>
                  <dd class="col-4">$393.37</dd>
                  <dt class="col-8 total">Total:</dt>
                  <dd class="col-4 total">$5,638.29</dd>
                  <dt class="col-8">You Save:</dt>
                  <dd class="col-4">$3,888.56</dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
