@extends('layouts.main')
@section('title', 'Lacosa-Thiết bị miền nam')
@section('product')
    <main class="main" id="detailpage">
        <section class="detail">
            <div class="container">
                <div class="detail_content">
                    <div class="detail_content-photo">
                        <div class="photochild">
                            @foreach (json_decode($product->image, true) as $key => $item)
                                <div class="item {{ $key === 0 ? 'active' : '' }}" data-src="{{ $item }}">
                                    <img src="{{ asset('uploads') }}/{{ $item }}" alt="" />
                                </div>
                            @endforeach
                        </div>
                        <div class="thumnail">
                            @php
                                $thumbnail = json_decode($product->image, true);
                            @endphp
                            <img src="{{ asset('uploads') }}/{{ $thumbnail[0] }}" alt="" />
                        </div>
                    </div>
                    <div class="detail_content-box">
                        <h3 class="name">{{ $product->name }}</h3>
                        <p class="price">
                            @if ($product->discount > 0)
                                <span class="sale">{{ number_format($product->pricesale, 0) }}đ</span>
                                <span class="root">{{ number_format($product->price, 0) }}đ</span>
                                <span class="percent">-{{ $product->discount }}%</span>
                            @else
                                <span class="sale">{{ number_format($product->price, 0) }}đ</span>
                            @endif

                        </p>
                        <p class="descshort">
                            {{ $product->shortdesc }}
                        </p>

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="code" value="{{ $product->code }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="image" value="{{ $thumbnail[0] }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="hidden" name="pricesale" value="{{ $product->pricesale }}">
                        <div class="size">
                            <p class="title">Chọn Size</p>
                            <div class="list">
                                @foreach ($product->sizes as $key => $item)
                                    <label class="form-group {{ $key === 0 ? 'active' : '' }}">
                                        <input type="radio" name="size" value="{{ $item->size_name }}"
                                            {{ $key === 0 ? 'checked' : '' }} />
                                        <span>{{ $item->size_name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="flexbox">
                            <div class="quantity">
                                <span class="pre"><i class="fa-solid fa-minus"></i></span>
                                <input type="number" min="1" value="1" class="qtt" name="quantity" />
                                <span class="next">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                            </div>
                            <button type="submit" class="btn-addcart" id="btn-addcart-check">Thêm vào giỏ hàng</button>
                            <div class="btn-addcart" id="btn-wishlist"
                                style="width:5%;padding:21px 25px;position: relative;">
                                <i class="fa-solid fa-heart"
                                    style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="description">
            <div class="container">
                <div class="description_content">
                    <ul class="description_content-tabs">
                        <li class="item">Chi tiết sản phẩm</li>
                        <li class="item">Reviews</li>
                        <li class="item">Shipping & Return</li>
                    </ul>
                    <div class="description_content-display">
                        <div class="same content">
                            @php
                                echo json_decode($product->description);
                            @endphp
                            <div class="btn_more-desc">View More</div>
                        </div>
                        <div class="same comment">
                            <div class="wrapbox">
                                <h6 class="title">All Review</h6>
                                <div class="btn-write">Write a Review</div>
                            </div>
                            {{-- <div class="listcomment">
                                @foreach ($productComment as $item)
                                    <div class="item">
                                        <p class="name">
                                            <span>{{ $item->user->name }}</span>
                                            <img srcset="{{ asset('img/check.png 2x') }}" alt="" />
                                        </p>
                                        <p class="desc">
                                            {{ $item->content }}
                                        </p>
                                        <p class="date">Posted on {{ $item->created_at }}</p>
                                    </div>
                                @endforeach
                            </div> --}}
                            <div class="modalcomment">
                                <div class="popup">
                                    <h5 class="title">Review Product</h5>
                                    <div class="reviewproduct">
                                        <div class="thumnail">
                                            <img src="{{ asset('uploads') }}/{{ $thumbnail[0] }}" alt="" />
                                        </div>
                                        <p class="name">{{ $product->name }}</p>
                                    </div>
                                    @if (Auth::check())
                                        <form action="{{ route('product_comment') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="user_id" value="{{ $user_id }}">
                                            <div class="user">
                                                <div class="thumnail">
                                                    <img src="{{ asset('img/vicky-hladynets-C8Ta0gwPbQg-unsplash.jpg') }}"
                                                        alt="" />
                                                </div>
                                                <p class="name">{{ Auth::user()->name }}</p>
                                            </div>
                                            <textarea name="content" id="" cols="30" rows="5" placeholder="Enter your review here"></textarea>
                                            <button type="submit" class="btn-send">Send Review</button>
                                        </form>
                                        <div class="btn-close">
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="btn-loadmore">Load More Reviews</div>
                        </div>
                        <div class="same shipping">
                            <div class="list">
                                <div class="item">
                                    <h5 class="title">SHIPPING</h5>
                                    <div class="box">
                                        <strong class="bold">Delivery information</strong>
                                        <p class="desc">Beuter takes delivery nationwide.</p>
                                        <p class="desc">
                                            Once your order has been shipped, you will receive a
                                            status update email with delivery details along with
                                            tracking number to track delivery status. You can click
                                            the link in the email to check the status of your order.
                                        </p>
                                    </div>
                                    <div class="box">
                                        <strong class="bold">Delivery Fee and Delivery Time</strong>
                                        <p class="desc">
                                            Shipping charges will vary based on the size, weight and
                                            destination of the order.
                                        </p>
                                        <p class="desc">
                                            For orders paid on delivery, please pay an additional
                                            COD base on Carriers
                                        </p>
                                        <p class="desc">
                                            Domestic delivery time will be from 2 to 5 working days,
                                            delivery time is from 10AM to 6PM.
                                        </p>
                                        <p class="desc">
                                            In the event of a force majeure event affecting the
                                            goods or delivery time, we will notify customers and
                                            cooperate with the shipping unit to process orders as
                                            soon as possible.
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <h5 class="title">RETURN</h5>
                                    <div class="box">
                                        <strong class="bold">Products without manufacturing defect can be exchanged
                                            for another new product according to customer needs when
                                            fully meeting the following conditions:</strong>
                                        <p class="desc">
                                            Only to be redeemed within 7 (seven) days from the date
                                            of purchase indicated on the purchase receipt.
                                        </p>
                                        <p class="desc">
                                            The original product and the purchase receipt need to be
                                            returned.
                                        </p>
                                        <p class="desc">
                                            The exchanged product must be new, in its original
                                            condition, with full price labels, product labels and
                                            other labels (if any).
                                        </p>
                                    </div>
                                    <div class="box">
                                        <strong class="bold">Regulations when buying “DISCOUNT” at BEUTER</strong>
                                        <div class="desc">
                                            Discount products will not be applied membership
                                            discounts or discount codes issued by BEUTER.
                                        </div>
                                        <div class="desc">
                                            Discount products will not be subject to a return or
                                            refund policy.
                                        </div>
                                        <div class="desc">
                                            For online orders, to make it easier to support you,
                                            please provide a vide recording the process of the
                                            opening and checking the product (in 1 video)
                                        </div>
                                        <div class="desc">
                                            The order contains discounted products, BEUTER will
                                            still pack according to basic standards including box,
                                            wrapping paper, stickers. Please note that the packaging
                                            box is only protective of the product throughout the
                                            shipping process.
                                        </div>
                                        <div class="desc">
                                            You can choose discount products as gifts for friends or
                                            relatives by clicking on the check box at the payment
                                            page or can request BEUTER directly through fanpages.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="productsame">
            <div class="container">
                <div class="productsame_content">
                    <div class="productsame_content-title">CÓ THỂ BẠN SẼ THÍCH</div>
                    <div class="productsame_content-box cpn_product-item"
                        data-flickity='{ "cellAlign": "left","freeScroll": true,"wrapAround": true, "groupCells": 2,"autoPlay": 3000,"prevNextButtons": false,"pageDots": false}'>
                        @foreach ($productSame as $item)
                            @php
                                $thumbnail = json_decode($item->image, true);
                                $bindparam = $item->slug . '-' . $item->code . '.html';
                            @endphp
                            <div class="item">
                                <div class="thumnail">
                                    <img src="{{ asset('uploads') }}/{{ $thumbnail[0] }}" alt="" />
                                </div>
                                <div class="content">
                                    <a href="{{ route('product.show', $bindparam) }}"
                                        class="name">{{ $item->name }}</a>
                                    <p class="price">
                                        @if ($item->discount > 0)
                                            <span class="sale">{{ number_format($item->pricesale, 0) }}đ</span>
                                            <span class="root">{{ number_format($item->price, 0) }}đ</span>
                                        @else
                                            <span class="sale">{{ number_format($item->price, 0) }}đ</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('include/showjs')
    <script>
        const btnAddCart = document.querySelector("#btn-addcart-check");
        const id = document.querySelector("input[name='product_id']");
        const name = document.querySelector("input[name='name']");
        const image = document.querySelector("input[name='image']");
        const price = document.querySelector("input[name='price']");
        const pricesale = document.querySelector("input[name='pricesale']");
        const quantity = document.querySelector("input[name='quantity']");

        btnAddCart.addEventListener("click", () => {
            const data = {
                id: id.value,
                name: name.value,
                image: image.value,
                price: parseInt(price.value),
                pricesale: parseInt(pricesale.value),
                quantity: parseInt(quantity.value)
            };
            addCart(data);

        });

        const addCart = (data) => {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            const existingItemIndex = cart.findIndex(item => item.id === data.id);

            if (existingItemIndex !== -1) {
                cart[existingItemIndex].quantity += parseInt(data.quantity);
                messagePopup("Cập nhập giỏ hàng thành công")
            } else {
                cart.push(data);
                messagePopup("Thêm vào giỏ hàng thành công")
            }

            console.log(cart);
            localStorage.setItem("cart", JSON.stringify(cart));
        }

        const messagePopup = async (message) => {
            await navigator.clipboard.writeText(message).then(() => {
                Snackbar.show({
                    text: `${message}`,
                    showAction: false,
                    pos: "top-right",
                    duration: "4000",
                    backgroundColor: "#000",
                });
            });
        }

        
        
    </script>


@endsection
