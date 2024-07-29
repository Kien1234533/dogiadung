@extends('layouts.main')
@section('title', 'Giỏ hàng')
@section('cart')
    <main class="main" id="cartpage">
        <section class="banner cpn_banner">Cửa hàng của tôi</section>
        <section class="cart">
            <div class="container">
                <div class="cart_content">
                    <!-- <div class="cart_content-title">Your Cart</div> -->
                    @if ($count > 0)
                        <div class="cart_content-box">
                            <div class="list">
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($cart as $item)
                                    @php
                                        $total += $item->pricesale * $item->quantity;
                                    @endphp
                                    <div class="item">
                                        <div class="thumnail">
                                            <img src="{{ asset('uploads') }}/{{ $item->image }}" alt="" />
                                        </div>
                                        <div class="content">
                                            <a href="" class="name">{{ $item->name }}</a>
                                            <p class="size">Size: {{ $item->size }}</p>
                                            {{-- <p class="color">Color: {{ $item->color }}</p> --}}
                                            <div class="wrap">
                                                <div class="price">
                                                    @if ($item->discount > 0)
                                                        <p class="sale">{{ number_format($item->pricesale, 0) }}đ</p>
                                                        <p class="root">{{ number_format($item->price, 0) }}đ</p>
                                                    @else
                                                        <p class="sale">{{ number_format($item->price, 0) }}đ</p>
                                                    @endif

                                                </div>
                                                <div class="quantity quantityonchange">
                                                    <span class="pre">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </span>
                                                    <input type="hidden" value="{{ $item->id }}" name="cartid"
                                                        class="cart_id">
                                                    <input type="number" min="1" value="{{ $item->quantity }}"
                                                        class="sl" />
                                                    <span class="next">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="delete removecart">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="infor">
                                <h5 class="title">Cart Total</h5>
                                <div class="textbox">
                                    <div class="item">
                                        <p class="name">Subtotal</p>
                                        <p class="price" id="pricechange">{{ number_format($total, 0) }}đ</p>
                                    </div>
                                    {{-- <div class="item">
                                        <p class="name">Voucher</p>
                                        <p class="price" id="discount_voucher"
                                            data-discount="{{ $cart[0]->discount_amount }}">
                                            {{ $cart[0]->applied_voucher === '' ? '-' : '-' . number_format($cart[0]->discount_amount, 0) . 'đ' }}
                                        </p>
                                    </div> --}}
                                    {{-- <div class="item">
                                        <p class="name">Use 2000 coin</p>
                                        <label class="switch" data-coin="{{ $cart[0]->coin }}" id="data_coin">
                                            <input type="checkbox" id="use_coin" name="coin" value="2000"
                                                {{ $cart[0]->coin > 0 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="item">
                                        <p class="name">Transport Fee</p>
                                        <p class="price">
                                            Free
                                        </p>
                                    </div> --}}
                                </div>
                                <div class="total">
                                    <p class="name">Total</p>
                                    @php
                                        $totalFinal = 0;
                                        if ($cart[0]->discount_amount > 0 || $cart[0]->coin > 0) {
                                            $totalFinal = $total - $cart[0]->discount_amount - $cart[0]->coin;
                                        } else {
                                            $totalFinal = $total;
                                        }
                                    @endphp
                                    <p class="price" id="totaldisplay" data-price="{{ $total }}">
                                        {{ number_format($totalFinal, 0) }}đ
                                    </p>
                                </div>
                                {{-- <div class="form-group">
                                    <input type="text" placeholder="Add promo code" id="voucher_code-input" />
                                    <input type="hidden" id="total_cart-check"value={{ $total }} />
                                    <button type="submit" class="btn-apply" id="btn_apply-voucher">Apply</button>
                                    <i class="fa-solid fa-tag"></i>
                                </div>
                                <p id="message_voucher" style="margin: 5px 0 0 8px"></p> --}}
                                {{-- @php
                                    $str = 'Hzof9AqytlK5NXfeS6bxO6sWnLUgj5lU7X9PZXbFOkq4jWolzlBGYTm633xRKg0jxY3b7WSqjom7hG1VBhg9lrWFMZZCcJDfROX5cCClSP8fHsio7CKtQczZeIazBFVaGMdO3RTc';
                                    $slug = $cart[0]->code . '-' . $str . $cart[0]->user_id;
                                @endphp --}}
                                <a href="{{ route('cart.show', $slug) }}" class="btn-checkout">
                                    <span>Go to Checkout</span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="custom_cart-empty">
                            <p>Không có sản phẩm trong giỏ hàng</p>
                            <a href='{{ route('shop') }}' class="btn-redirec-shop">Mua sản phẩm</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        {{-- <section class="voucher dfr">
            <div class="container">
                <div class="voucher_content">
                    <div class="voucher_content-heading">Promotional code</div>
                    <div class="voucher_content-box">
                        @foreach ($voucher as $item)
                            <div class="item">
                                <div class="left">
                                    <svg data-icons="coupon-gift" width="50" height="50" viewBox="0 0 32 32"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="16" cy="16" r="16" fill="#363636"></circle>
                                        <g clip-path="url(#clip0_1826_6139)">
                                            <path
                                                d="M23.6522 12.1646H18.7562C19.1903 11.9441 19.6098 11.6728 19.9478 11.3347C20.7117 10.5709 20.7117 9.32849 19.9478 8.56465C19.2077 7.82446 17.9179 7.82377 17.1778 8.56465C16.6323 9.11002 16.2477 9.85996 16 10.557C15.7523 9.85996 15.3677 9.11002 14.8223 8.56465C14.0814 7.82377 12.7909 7.82446 12.0522 8.56465C11.2883 9.32846 11.2883 10.5709 12.0522 11.3347C12.3903 11.6728 12.8097 11.9441 13.2438 12.1646H8.34781C8.15581 12.1646 8 12.3205 8 12.5125V15.2951C8 15.4871 8.15581 15.6429 8.34781 15.6429H8.69563V23.6429C8.69563 23.8349 8.85144 23.9907 9.04344 23.9907H22.9565C23.1485 23.9907 23.3043 23.8349 23.3043 23.6429V15.6429H23.6521C23.8441 15.6429 23.9999 15.4871 23.9999 15.2951V12.5125C24 12.3205 23.8442 12.1646 23.6522 12.1646ZM14.2609 23.2951H9.39131V15.6429H14.2609V23.2951ZM14.2609 14.9472H8.69566V12.8603H14.2609V14.9472ZM12.544 10.8429C12.0515 10.3504 12.0515 9.54899 12.544 9.05646C12.7826 8.81715 13.0998 8.68636 13.4372 8.68636C13.7746 8.68636 14.0911 8.81715 14.3304 9.05646C15.2243 9.95036 15.6445 11.6095 15.6543 12.1535C15.6543 12.157 15.6536 12.1618 15.6536 12.1646H15.6153C15.0498 12.1452 13.4268 11.725 12.544 10.8429ZM17.0435 23.2951H14.9565V15.6429H17.0435V23.2951ZM17.0435 14.9472H14.9565V12.8603H17.0435V14.9472ZM16.3847 12.1646H16.3464C16.3464 12.1619 16.3458 12.157 16.3458 12.1535C16.3555 11.6095 16.7757 9.9504 17.6696 9.05649C17.9089 8.81718 18.2254 8.6864 18.5628 8.6864C18.9002 8.6864 19.2174 8.81718 19.456 9.05649C19.9485 9.54902 19.9485 10.3504 19.456 10.8429C18.5732 11.725 16.9503 12.1452 16.3847 12.1646ZM22.6087 23.2951H17.7391V15.6429H22.6087V23.2951ZM23.3043 14.9472H17.7391V12.8603H23.3043V14.9472Z"
                                                fill="white"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1826_6139">
                                                <rect width="25" height="25" fill="white"
                                                    transform="translate(8 8)">
                                                </rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="right">
                                    <p class="name">{{ $item->name }}</p>
                                    <p class="desc">{{ $item->querytext }}</p>
                                    <p class="slot">Còn {{ $item->quantity }} mã</p>
                                    <div class="coppy">
                                        <span class="query">Điều kiện</span>
                                        <span class="btn-cp" data-code="{{ $item->code }}">
                                            Sao chép mã</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section> --}}
    </main>
    @include('include/cartjs')
@endsection
