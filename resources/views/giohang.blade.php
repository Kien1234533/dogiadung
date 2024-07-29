@extends('layouts.main')
@section('title', 'GioHang')
@section('giohang')

    <!-- MAIN -->
    <main class="main" id="cartpage">
        <section class="banner cpn_banner">Your Cart</section>
        <section class="cart">
            <div class="container">
                <div class="cart_content">
                    <!-- <div class="cart_content-title">Your Cart</div> -->
                    <div class="cart_content-box">
                        <div class="list listcarts">
                            <div class="item">
                                <div class="thumnail">
                                    <img src="./img/image 14.jpg" alt="" />
                                </div>
                                <div class="content">
                                    <a href="" class="name">Gradient Graphic T-shirt</a>
                                    <div class="wrap">
                                        <div class="price">
                                            <p class="sale">100.000đ</p>
                                            <p class="root">150.000đ</p>
                                        </div>
                                        <div class="quantity">
                                            <span class="pre">
                                                <i class="fa-solid fa-minus"></i>
                                            </span>
                                            <input type="number" min="1" value="1" class="sl" />
                                            <span class="next">
                                                <i class="fa-solid fa-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumnail">
                                    <img src="./img/image 14.jpg" alt="" />
                                </div>
                                <div class="content">
                                    <a href="" class="name">Gradient Graphic T-shirt</a>
                                    <div class="wrap">
                                        <div class="price">
                                            <p class="sale">100.000đ</p>
                                            <p class="root">150.000đ</p>
                                        </div>
                                        <div class="quantity">
                                            <span class="pre">
                                                <i class="fa-solid fa-minus"></i>
                                            </span>
                                            <input type="number" min="1" value="1" class="sl" />
                                            <span class="next">
                                                <i class="fa-solid fa-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </div>
                            </div>

                        </div>
                        <div class="infor">
                            <h5 class="title">Cart Total</h5>

                            <div class="total">
                                <p class="name">Total</p>
                                <p class="price">400.000đ</p>
                            </div>
                            <a href="thanhtoan.html" class="btn-checkout">
                                <span>Go to Checkout</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        const productInCart = JSON.parse(localStorage.getItem("cart"));
        const renderProductsToTable() {
            let data = ``;
            productInCart.map((value, index) => {
                data += `
                <div class="item">
                                <div class="thumnail">
                                    <img src="{{ asset('uploads') }}/${value.image}" alt="" />
                                </div>
                                <div class="content">
                                    <a href="" class="name">${value.name}</a>
                                    <div class="wrap">
                                        <div class="price">
                                            <p class="sale">${value.price}</p>
                                            <p class="root">${value.pricesale}</p>
                                        </div>
                                        <div class="quantity">
                                            <span class="pre">
                                                <i class="fa-solid fa-minus"></i>
                                            </span>
                                            <input type="number" min="1" value="${value.quantity}" class="sl" />
                                            <span class="next">
                                                <i class="fa-solid fa-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </div>
                            </div>
                            
                `;
            });
            document.getElementById('products-cart').innerHTML = data;
        }
    </script>
@endsection
