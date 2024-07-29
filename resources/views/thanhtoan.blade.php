@extends('layouts.main')
@section('title', 'ThanhToan')
@section('thanhtoan')

<main class="main" id="checkoutpage">
    <section class="banner cpn_banner">Payment</section>
    <section class="checkout">
      <div class="container">
        <div class="checkout_content">
          <div class="checkout_content-left">
            <!-- <h5 class="title">Billing Details</h5> . -->
            <form action="" method="post" class="form-box">
              <div class="row">
                <label class="form-group">
                  <span>Full Name*</span>
                  <input type="text" name="name" />
                </label>
                <label class="form-group">
                  <span>Phone number*</span>
                  <input type="text" name="phone" />
                </label>
                <label class="form-group">
                  <span>Email address*</span>
                  <input type="text" />
                </label>
              </div>
              <div class="wrap-address">
                <div class="form-group">
                  <label for="city">Province/City *</label>
                  <select name="city" id="city">
                    <option>Vui lòng chọn tỉnh / thành phố</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="district">District/Town *</label>
                  <select name="district" id="district">
                    <option>Vui lòng chọn quận / huyện</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ward">Ward *</label>
                  <select name="ward" id="ward">
                    <option>Vui lòng chọn phường / xã</option>
                  </select>
                </div>
              </div>
              <label class="form-group">
                <span>Street address*</span>
                <input type="text" name="street" />
              </label>
              <label class="form-group">
                <span>Order notes (optional)</span>
                <textarea name="note" id="" cols="30" rows="10"></textarea>
              </label>
            </form>
          </div>
          <div class="checkout_content-right">
            <h5 class="heading">Your Order</h5>
            <div class="list">
              <div class="item">
                <div class="thumnail">
                  <img src="./img/image 10.jpg" alt="" />
                  <span class="quantity">1</span>
                </div>
                <div class="content">
                  <p class="name">Áo Khoác Nam Xỏ Ngón Cổ Cao AKN0110</p>
                  <p class="price">
                    <span class="sale">100.000đ</span>
                    <span class="root">150.000đ</span>
                  </p>
                  <p class="color">
                    <span class="title">Color:</span>
                    <span class="value">Black</span>
                  </p>
                  <p class="size">
                    <span class="title">Size:</span>
                    <span class="value">Large</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="totalprice">
              <p class="text">Total:</p>
              <p class="price">550.000đ</p>
            </div>
            <div class="payment">
              <a href="#" class="btn-order">Place Order</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection