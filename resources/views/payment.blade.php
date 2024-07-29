@extends('layouts.main')
@section('title', 'Payment')
@section('payment')
    <main class="main" id="checkoutpage">
        <section class="banner cpn_banner">Payment</section>
        <section class="checkout">
            <div class="container">
                <div class="checkout_content">
                    <div class="checkout_content-left">
                        <!-- <h5 class="title">Billing Details</h5> . -->
                        <form action="" method="post" class="form-box" id="form-payment">
                            @csrf
                            <input type="hidden" name="redirect">
                            <input type="hidden" value="{{ mt_rand() }}" name="ordercode">
                            <input type="hidden" name="total" value="0" id="totalchange">
                            <input type="hidden" name="cartlist" value="{{ $cart }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="row">
                                <label class="form-group">
                                    <span>Họ và tên</span>
                                    <input type="text" name="name" value="" />
                                    <p id="message-name" style="color: #d70018"></p>
                                </label>
                                <label class="form-group">
                                    <span>Số điện thoại</span>
                                    <input type="text" name="phone" value="" />
                                    <p id="message-phone" style="color: #d70018"></p>
                                </label>
                                <label class="form-group">
                                    <span>Email address*</span>
                                    <input type="text" name="email" value="" />
                                    <p id="message-email" style="color: #d70018"></p>
                                </label>
                            </div>
                            <div class="wrap-address">
                                <div class="form-group">
                                    <label for="city">Province/City *</label>
                                    <select name="city" id="city">
                                        <option disabled selected>Vui lòng chọn tỉnh / thành phố</option>
                                    </select>
                                    <p id="message-city" style="color: #d70018"></p>
                                </div>
                                <div class="form-group">
                                    <label for="district">District/Town *</label>
                                    <select name="district" id="district">
                                        <option disabled selected>Vui lòng chọn quận / huyện</option>
                                    </select>
                                    <p id="message-district" style="color: #d70018"></p>
                                </div>
                                <div class="form-group">
                                    <label for="ward">Ward *</label>
                                    <select name="ward" id="ward">
                                        <option disabled selected>Vui lòng chọn phường / xã</option>
                                    </select>
                                    <p id="message-ward" style="color: #d70018"></p>
                                </div>
                            </div>
                            <label class="form-group">
                                <span>Street address*</span>
                                <input type="text" name="street" value="30/1" />
                                <p id="message-street" style="color: #d70018"></p>
                            </label>
                            <label class="form-group">
                                <span>Order notes (optional)</span>
                                <textarea name="note" cols="30" rows="10"></textarea>
                            </label>
                        </form>
                    </div>
                    <div class="checkout_content-right">
                        <h5 class="heading">Your Order</h5>
                        @if (count($cart) > 0)
                            <div class="list">
                                @php
                                    $total = 0;
                                    $subtotal = 0;
                                    $coin = number_format($cart[0]->coin) . 'đ';
                                    $discount = 0;
                                @endphp
                                @foreach ($cart as $item)
                                    @php
                                        $subtotal += $item->pricesale * $item->quantity;
                                        if ($cart[0]->discount_amount > 0 || $cart[0]->coin > 0) {
                                            $total = $subtotal - $cart[0]->discount_amount - $cart[0]->coin;
                                            $discount = $cart[0]->discount_amount;
                                        } else {
                                            $total = $subtotal;
                                        }
                                    @endphp
                                    <div class="item">
                                        <div class="thumnail">
                                            <img src="{{ asset('uploads') }}/{{ $item->image }}" alt="" />
                                            <span class="quantity">{{ $item->quantity }}</span>
                                        </div>
                                        <div class="content">
                                            <p class="name">{{ $item->name }}</p>
                                            <p class="price">
                                                @if ($item->pricesale === $item->price)
                                                    <span class="sale">{{ number_format($item->price, 0) }}đ</span>
                                                @else
                                                    <span class="sale">{{ number_format($item->pricesale, 0) }}đ</span>
                                                    <span class="root">{{ number_format($item->price, 0) }}đ</span>
                                                @endif
                                            </p>
                                            {{-- <p class="color">
                                                <span class="title">Color:</span>
                                                <span class="value">{{ $item->color }}</span>
                                            </p> --}}
                                            <p class="size">
                                                <span class="title">Size:</span>
                                                <span class="value">{{ $item->size }}</span>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="box">
                                <div class="item">
                                    <p class="text">Subtotal:</p>
                                    <p class="total">{{ number_format($subtotal, 0) }}đ</p>
                                </div>
                                <div class="item">
                                    <p class="text">Discount:</p>
                                    <p class="shiping">-{{ number_format($discount, 0) }}đ</p>
                                </div>
                                <div class="item">
                                    <p class="text">Coin:</p>
                                    <p class="shiping">-{{ $coin }}</p>
                                </div>
                                <div class="item">
                                    <p class="text">Shipping:</p>
                                    <p class="shiping">Free</p>
                                </div>
                            </div>
                            <div class="totalprice">
                                <p class="text">Total:</p>
                                <p class="price">{{ number_format($total, 0) }}đ</p>
                            </div>
                            <div class="payment">
                                <div class="flex">
                                    <button type="submit" class="btn-payment blue" id="submit-vnpay"
                                        data-price="">
                                    </button>
                                    <button type="submit" class="btn-payment pink" id="submit-momo"
                                        data-price="">
                                    </button>
                                </div>
                                <button type="submit" class="btn-order" id="submit-order"
                                    data-price="{{ $total }}">Thanh toán</button>
                            </div>
                        @else
                            <div class="box">
                                <div class="item">
                                    <p class="text">Subtotal:</p>
                                    <p class="total">0đ</p>
                                </div>
                                <div class="item">
                                    <p class="text">Discount:</p>
                                    <p class="shiping">-0đ</p>
                                </div>
                                <div class="item">
                                    <p class="text">Coin:</p>
                                    <p class="shiping">-0đ</p>
                                </div>
                                {{-- <div class="item">
                                    <p class="text">Shipping:</p>
                                    <p class="shiping">Free</p>
                                </div> --}}
                            </div>
                            <div class="totalprice">
                                <p class="text">Total:</p>
                                <p class="price">0đ</p>
                            </div>
                            <div class="payment">
                                <div class="flex">
                                    <button class="btn-payment blue">Pay with VNPAY</button>
                                    <a href="#" class="btn-payment pink">Pay with Momo </a>
                                </div>
                                <button class="btn-order">Place Order</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        const city = document.querySelector('.wrap-address #city'),
            district = document.querySelector('.wrap-address #district'),
            ward = document.querySelector('.wrap-address #ward'),
            cityOption = document.querySelector('.wrap-address #city option'),
            districtOption = document.querySelector('.wrap-address #district option'),
            wardOption = document.querySelector('.wrap-address #ward option'),
            urlCity = "https://cfdshop.cfdcircle.vn/api/v1/provinces",
            urlDistrict = "https://cfdshop.cfdcircle.vn/api/v1/districts?province",
            urlWard = "https://cfdshop.cfdcircle.vn/api/v1/wards?district";
        // validate
        const nameInput = document.querySelector('.form-group input[name="name"]'),
            phoneInput = document.querySelector('.form-group input[name="phone"]'),
            emailInput = document.querySelector('.form-group input[name="email"]'),
            streetInput = document.querySelector('.form-group input[name="street"]'),
            wardInput = document.querySelector('.form-group select[name="ward"]'),
            districtInput = document.querySelector('.form-group select[name="district"]'),
            cityInput = document.querySelector('.form-group select[name="city"]'),
            messageName = document.querySelector("#message-name"),
            messagePhone = document.querySelector("#message-phone"),
            messageEmail = document.querySelector("#message-email"),
            messageStreet = document.querySelector("#message-street"),
            messageWard = document.querySelector("#message-ward"),
            messageDistrict = document.querySelector("#message-district"),
            messageCity = document.querySelector("#message-city");

        async function handleAdressAjax() {
            const resCity = await fetch(urlCity),
                resultCity = await resCity.json();
            // city
            let htmlListCity = "";
            resultCity.data.provinces.forEach(e => {
                htmlListCity += `<option value="${e.name}" data-city="${e.id}">${e.name}</option>`
            })
            city.insertAdjacentHTML('beforeend', htmlListCity);
            // district
            city.addEventListener('change', async (e) => {
                const codeCity = e.target.options[e.target.selectedIndex].getAttribute('data-city');
                const resDistrist = await fetch(`${urlDistrict}=${codeCity}`),
                    resultDistrist = await resDistrist.json();
                let htmlListDistrict = "<option disabled selected>Vui lòng chọn quận / huyện</option>";
                district.innerHTML = "";
                resultDistrist.data.districts.forEach(e => {
                    htmlListDistrict +=
                        `<option value="${e.name}" data-district="${e.id}">${e.name}</option>`
                })
                district.insertAdjacentHTML('beforeend', htmlListDistrict);
            })
            // ward
            district.addEventListener('change', async (e) => {
                const codeDistrict = e.target.options[e.target.selectedIndex].getAttribute('data-district');
                const resWard = await fetch(`${urlWard}=${codeDistrict}`),
                    resultWard = await resWard.json();
                let htmlListWard = "<option disabled selected>Vui lòng chọn phường / xã</option>";
                ward.innerHTML = "";
                resultWard.data.wards.forEach(e => {
                    htmlListWard +=
                        `<option value="${e.name}" data-ward="${e.id}">${e.name}</option>`
                })
                ward.insertAdjacentHTML('beforeend', htmlListWard);
            })
        }
        handleAdressAjax()


        const btnSubmitVNPAY = document.querySelector('#submit-vnpay'),
            btnSubmitMomo = document.querySelector('#submit-momo'),
            btnSubmitOrder = document.querySelector('#submit-order'),
            formPayment = document.querySelector('#form-payment'),
            total = document.querySelector('#totalchange');

        const handleChangeActionForm = (btn, action) => {
            btn.addEventListener('click', (ev) => {
                ev.preventDefault();
                const price = btn.getAttribute('data-price');
                total.value = price;
                if (handleValidateSubmit()) {
                    btn.disabled = true;
                    formPayment.action = action;
                    formPayment.submit();
                    setTimeout(function() {
                        btn.disabled = false;
                    }, 7000);
                }
            })
        }
        handleChangeActionForm(btnSubmitVNPAY, "{{ route('vnpay') }}")
        handleChangeActionForm(btnSubmitMomo, "{{ route('momo') }}")
        handleChangeActionForm(btnSubmitOrder, "{{ route('order') }}")

        // hàm tái sử dụng message
        const handleMessage = (input, message, text, regex = "", text2 = "") => {
            input.addEventListener('input', (e) => {
                if (e.target.value === "") {
                    message.innerText = text;
                } else {
                    if (regex !== "") {
                        if (!regex.test(input.value)) {
                            message.innerText = text2;
                        } else {
                            message.innerText = '';
                        }
                    } else {
                        message.innerText = '';
                    }
                }
            })
        }
        // validate khi ch submit
        const handleValidate = () => {
            handleMessage(nameInput, messageName, 'FullName is required');
            handleMessage(phoneInput, messagePhone, 'Phone is required', /^\d{10,12}$/, 'Invalid phone number format');
            handleMessage(emailInput, messageEmail, 'Email is required',
                /[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/,
                "Invalid email format");
            handleMessage(streetInput, messageStreet, 'Street is required');
        }
        handleValidate();
        // validat khi submit
        const handleValidateSubmit = () => {
            if (nameInput.value === "") {
                messageName.innerText = "FullName is required"
                return false;
            }
            if (phoneInput.value === "") {
                messagePhone.innerText = "Phone is required"
                return false;
            } else {
                const regexPhone = /^\d{10,12}$/;
                if (!regexPhone.test(phoneInput.value)) {
                    messagePhone.innerText = "Invalid phone number format"
                    return false;
                }
            }
            if (emailInput.value === "") {
                messageEmail.innerText = "Email is required"
                return false;

            } else {
                const regexEmail = /[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/;
                if (!regexEmail.test(emailInput.value)) {
                    messageEmail.innerText = "Invalid email format";
                    return false;
                }
            }
            if (cityInput.value === "Vui lòng chọn tỉnh / thành phố") {
                messageCity.innerText = "City is required";
                return false;
            } else {
                messageCity.innerText = "";
            }
            if (districtInput.value === "Vui lòng chọn quận / huyện") {
                messageDistrict.innerText = "District is required";
                return false;
            } else {
                messageDistrict.innerText = "";
            }
            if (wardInput.value === "Vui lòng chọn phường / xã") {
                messageWard.innerText = "Ward is required";
                return false;
            } else {
                messageWard.innerText = ""
            }
            if (streetInput.value === "") {
                messageStreet.innerText = "Street is required";
                return false;
            }
            return true;
        }
    </script>
@endsection
