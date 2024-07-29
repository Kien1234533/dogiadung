@extends('layouts.main')
@section('title', 'Profile')
@section('profile')
    {{-- @if ($success = Session::get('success'))
        <script>
            navigator.clipboard.writeText('{{ $success }}').then(() => {
                Snackbar.show({
                    text: '{{ $success }}',
                    showAction: false,
                    pos: "top-right",
                    duration: "3000",
                    backgroundColor: "#000",
                });
            });
        </script>
    @endif --}}
    <main class="main" id="userpage">
        <!-- <section class="banner cpn_banner">Profile</section> -->
        <section class="user">
            <div class="container">
                <div class="user_content">
                    <div class="user_content-top">
                        <div class="left">
                            <div class="infor">
                                <div class="thumnail">
                                    <img src="./img/alex-suprun-ZHvM3XIOHoE-unsplash.jpg" alt="" />
                                </div>
                                <div class="content">
                                    <p class="name">Ansolo Lazinatov</p>
                                    <p class="join">Joined 3 months ago</p>
                                    <div class="btn-change">
                                        <i class="fa-solid fa-camera"></i>
                                        <span>Change Avatar</span>
                                    </div>
                                </div>
                            </div>
                            <div class="parameter">
                                <div class="item">
                                    <span class="text">Total Coin</span>
                                    <span class="number">
                                        <span>100</span>
                                        <i class="fa-solid fa-coins"></i>
                                    </span>
                                </div>
                                <div class="item">
                                    <span class="text">Last Order</span>
                                    <span class="number">
                                        <span>{{ $time }}</span>
                                        <i class="fa-solid fa-clock"></i>
                                    </span>
                                </div>
                                <div class="item">
                                    <span class="text">Total Orders</span>
                                    <span class="number">
                                        <span>{{ count($order) }}</span>
                                        <i class="fa-solid fa-box-open"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <h5 class="title">Default Address</h5>
                            <div class="list">
                                <p class="item adr">
                                    <span class="text">Address:</span>
                                    <span class="value">
                                        88 Pine St, New York, NY 10005, USA
                                    </span>
                                </p>
                                <p class="item">
                                    <span class="text">Phone:</span>
                                    <span class="value">0333844433</span>
                                </p>
                                <p class="item">
                                    <span class="text">Email:</span>
                                    <span class="value">vincent@gmail.com</span>
                                </p>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="btn changepass">Change Password</a>
                                <form action="{{ route('logout') }}" method="post" style="width:100%">
                                    @csrf
                                    <button type="submit" class="btn logout">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="user_content-bottom">
                        <ul class="tabs">
                            <li class="item">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span>Orders</span>
                            </li>
                            <li class="item">
                                <i class="fa-solid fa-comment"></i>
                                <span>Reviews</span>
                            </li>
                            <li class="item">
                                <i class="fa-solid fa-heart"></i>
                                <span>Wishlist</span>
                            </li>
                            <li class="item">
                                <i class="fa-solid fa-id-card"></i>
                                <span>Personal info</span>
                            </li>
                            <li class="item">
                                <i class="fa-solid fa-coins"></i>
                                <span>Coin</span>
                            </li>
                        </ul>
                        <div class="list-content">
                            <div class="box orders">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Status</th>
                                            <th>Payment Method</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orderFetchData">
                                        @foreach ($order as $item)
                                            @php
                                                $statusOrder = $item->status === 'pending' ? 'Đang xử lý' : ($item->status === 'wait' ? 'Đang giao hàng' : ($item->status === 'success' ? 'Giao hàng thành công' : 'Đã huỷ'));
                                            @endphp
                                            <tr>
                                                <td>{{ $item->ordercode }}</td>
                                                <td>{{ $statusOrder }}</td>
                                                <td>{{ $item->payment_method }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ number_format($item->total, 0) }}đ</td>
                                                <td class="btn-view" data-id="{{ $item->id }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="box reviews">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Review</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="reviewFetchData">
                                        @foreach ($comment as $item)
                                            <tr>
                                                <td>
                                                    <p class="name">{{ $item->product->name }}</p>
                                                </td>
                                                <td>
                                                    {{ $item->content }}
                                                </td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="box wishlist">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="wishlistFetchData">
                                        @foreach ($wishlist as $item)
                                            <tr>
                                                <td class="wrap">
                                                    <div class="thumnail">
                                                        <img src="{{ asset('uploads') }}/{{ $item->image }}"
                                                            alt="" />
                                                    </div>
                                                    <a href="" class="name">{{ $item->name }}</a>
                                                </td>
                                                <td>{{ $item->color }}</td>
                                                <td>{{ $item->size }}</td>
                                                <td>{{ number_format($item->pricesale, 0) }}đ</td>
                                                <td class="wrap-btn" id="wrap-form-user">
                                                    <form action="{{ route('delete_wishlist') }}" method="post"
                                                        class="form-wl-delete">
                                                        @csrf
                                                        <input type="hidden" name="wishlist_id"
                                                            value="{{ $item->id }}">
                                                        <button type="submit"class="btn delete">Delete</button>
                                                    </form>
                                                    <form action="{{ route('cart.store') }}" method="post"
                                                        style="display: block;margin-top:5px" class="form-wl-addcart">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $item->user_id }}">
                                                        <input type="hidden"
                                                            name="product_id"value="{{ $item->product_id }}">
                                                        <input type="hidden" name="code" value="{{ $item->code }}">
                                                        <input type="hidden" name="name"
                                                            value="{{ $item->name }}">
                                                        <input type="hidden" name="image"
                                                            value="{{ $item->image }}">
                                                        <input type="hidden" name="price"
                                                            value="{{ $item->price }}">
                                                        <input type="hidden" name="pricesale"
                                                            value="{{ $item->pricesale }}">
                                                        <input type="hidden" name="color"
                                                            value="{{ $item->color }}">
                                                        <input type="hidden" name="size"
                                                            value="{{ $item->size }}">
                                                        <input type="hidden" name="quantity"
                                                            value="{{ $item->quantity }}">
                                                        <button type="submit"class="btn addcart">Add to cart</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="box info">
                                <form action="https://httpbin.org/post" method="post" class="form-box">
                                    <div class="wrap-box">
                                        <label class="form-group">
                                            <span>Full name</span>
                                            <input type="text" name="name" />
                                        </label>
                                        <label class="form-group">
                                            <span>Phone</span>
                                            <input type="text" name="phone" />
                                        </label>
                                        <label class="form-group">
                                            <span>Email</span>
                                            <input type="text" name="email" />
                                        </label>
                                    </div>
                                    <div class="wrap-address">
                                        <div class="form-group">
                                            <label for="city">Province/City *</label>
                                            <select name="city" id="city">
                                                <option>Vui lòng chọn tỉnh / thành phố</option>
                                                <option value="tphcm">Thành Phố Hồ Chí Minh</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="district">District/Town *</label>
                                            <select name="district" id="district">
                                                <option>Vui lòng chọn quận / huyện</option>
                                                <option value="thanhphothuduc">
                                                    Thành Phố Thủ Đức
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ward">Ward *</label>
                                            <select name="ward" id="ward">
                                                <option>Vui lòng chọn phường / xã</option>
                                                <option value="phuonganphu">Phường An Phú</option>
                                            </select>
                                        </div>
                                    </div>
                                    <label class="form-group">
                                        <span>Street</span>
                                        <input type="text" name="street" />
                                    </label>
                                    <button type="submit" class="btn-update">Update</button>
                                </form>
                            </div>
                            <div class="box coin">
                                <h4 class="title">Coin dùng để làm gì?</h4>
                                <p class="desc">
                                    Coin dùng để quy đổi các mã giảm giá của SHOP.CO
                                </p>
                                <h4 class="title">Làm thế nào để kiếm thêm coin?</h4>
                                <p class="desc">
                                    Bạn có thể kiếm thêm <strong>Coin</strong> bằng cách mua
                                    hàng tại SHOP.CO
                                </p>
                                <p class="desc">
                                    Ví dụ: Đơn hàng có giá là 500.000đ thì sau khi hoàn tất đơn
                                    hàng thì bạn sẽ nhận được 50 Coin.
                                </p>
                                <p class="desc">Quy đổi: 1 Coin = 10.000đ</p>
                                <p class="desc">
                                    Quy đổi coin sang mã giảm: 1 Mã giảm 50.000đ = 50 Coin
                                </p>
                                <p class="desc">
                                    Lưu ý: Coin chỉ bị trừ khi mã giảm giá có điều kiện quy đổi
                                    bằng coin, nếu không bị trừ coin thì mã đó được sử dụng miễn
                                    phí.
                                </p>
                            </div>
                        </div>
                        <div class="popup_detail">
                            <div class="popup_detail-box">
                                <div class="list">
                                </div>
                                {{-- <h4 class="inforcustomer">Infor Customer</h4> --}}
                                <div class="infor">
                                </div>
                                <div class="btn-cancel">
                                </div>
                                <i class="fa-solid fa-xmark btn-close-popup"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <script>
        // Hàm đổi giá -> vnđ
        const toPrice = (value) => {
            return new Intl.NumberFormat().format(value);
        };

        const handleTabs = (option, option2, option3) => {
            const listtab = document.querySelectorAll(`${option}`),
                listcontent = document.querySelectorAll(`${option2}`);
            listtab.forEach((e, i) => {
                e.addEventListener("click", () => {
                    listtab.forEach((el) => {
                        el.classList.remove("active");
                    });
                    listcontent.forEach((el2) => {
                        el2.classList.remove("active");
                    });
                    e.classList.add("active");
                    localStorage.setItem(`${option3}`, JSON.stringify(i));
                    listcontent[i].classList.add("active");
                });
            });
        };
        const handleCache = (option, option2, option3) => {
            const listtab = document.querySelectorAll(`${option}`),
                listcontent = document.querySelectorAll(`${option2}`);
            let data = localStorage.getItem(`${option3}`);
            if (data) {
                data = JSON.parse(data);
                listtab[data].classList.add("active");
                listcontent[data].classList.add("active");
            } else {
                listtab[0].classList.add("active");
                listcontent[0].classList.add("active");
            }
        };
        handleTabs(
            ".user_content-bottom .tabs .item",
            ".user_content-bottom .list-content .box",
            "userTabId"
        );
        handleCache(
            ".user_content-bottom .tabs .item",
            ".user_content-bottom .list-content .box",
            "userTabId"
        );


        const listViewDetailOrder = document.querySelectorAll('#orderFetchData .btn-view'),
            popupDetail = document.querySelector('.popup_detail');
        listViewDetailOrder.forEach(e => {
            e.addEventListener('click', async () => {
                popupDetail.classList.add('active');
                const orderId = e.getAttribute("data-id");
                console.log(orderId);
                try {
                    const res = await handleDetailOrder({
                        orderId
                    });
                    console.log(res.data);
                    handleDisplayOrderDetail(res);

                } catch (error) {
                    console.log(error);
                }
            })
        })
        async function handleDetailOrder(data) {
            const url = '{{ route('order_detail') }}';
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify(data),
            });
            const result = await response.json();
            return result;
        }
        const ENDPOINT = window.location.href,
            urlPublic = ENDPOINT.split("/user")[0],
            listCart = document.querySelector('.popup_detail-box .list'),
            litsInfo = document.querySelector('.popup_detail-box .infor'),
            btnCancel = document.querySelector('.popup_detail-box .btn-cancel'),
            btnClosePopup = document.querySelector('.popup_detail-box .btn-close-popup');

        const handleDisplayOrderDetail = (res) => {
            const htmlListOrder = JSON.parse(res.data.cartlist).map(e => {
                return `
                    <div class="item">
                        <div class="thumnail">
                            <img src="${urlPublic}/uploads/${e.image}" alt="" />
                        </div>
                        <div class="content">
                            <a href="" class="name">${e.name}</a>
                            <p class="price">${toPrice(e.pricesale)}đ</p>
                            <div class="boxflex">
                                <p class="color">
                                    <span class="title">Color:</span>
                                    <span>${e.color}</span>
                                </p>
                                <p class="size">
                                    <span class="title">Size:</span>
                                    <span>${e.size}</span>
                                </p>
                                <p class="quantity">
                                    <span class="title">Quantity:</span>
                                    <span>${e.quantity}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                `
            })
            listCart.innerHTML = htmlListOrder.join('');

            const htmlListInfor = `
                    <p class="ordercode">
                        <span class="title">Order Code:</span>
                        <span class="value">${res.data.ordercode}</span>
                    </p>
                    <p class="name">
                        <span class="title">Name Customer:</span>
                        <span class="value">${res.data.name}</span>
                    </p>
                    <p class="phone">
                        <span class="title">Phone Number:</span>
                        <span class="value">${res.data.phone}</span>
                    </p>
                    <p class="adress">
                        <span class="title">Address:</span>
                        <span class="value">${res.data.address}</span>
                    </p>
                    <p class="total">
                        <span class="title">Total:</span>
                        <span class="value">${toPrice(res.data.total)}đ</span>
                    </p>
                    <p class="methodpayment">
                        <span class="title">Payment Method:</span>
                        <span class="value">${res.data.payment_method}</span>
                    </p>
                    <p class="note">
                        <span class="title">Note:</span>
                        <span class="value">${res.data.note||"Không có ghi chú"}</span>
                    </p>
                    <p class="date">
                        <span class="title">Order date:</span>
                        <span class="value">${res.data.created_at}</span>
                    </p>
                    <p class="status">
                        <span class="title">Status Order:</span>
                        <span class="value">${res.data.status==="pending"?"Đang xử lý":res.data.status==="wait"?"Đang vận chuyển":res.data.status==="success"?"Giao Hàng Thành Công":"Đã Huỷ"}</span>
                    </p>
                 `
            litsInfo.innerHTML = htmlListInfor;


            if (res.data.status !== "pending") {
                btnCancel.innerHTML = ''
            } else {
                btnCancel.innerHTML = `
                <form action="{{ route('cancel_order') }}" method="post">
                    @csrf
                    <input type="hidden" value="${res.data.id}" name="orderid">
                    <button type="submit" class="btn_cancel-order">
                        Cancel Order
                    </button>
                </form>
            `
            }

        }
        btnClosePopup.addEventListener('click', () => {
            popupDetail.classList.remove('active');
        })


        // thêm sản phẩm vào giỏ hàng ở mục sản phẩm yêu thích
        async function handleWishlistAddCart() {
            const listForm = document.querySelectorAll('#wrap-form-user .form-wl-addcart');
            listForm.forEach(e => {
                e.addEventListener('submit', async (ev) => {
                    ev.preventDefault();
                    const formData = new FormData(e);
                    const formDataObject = {};
                    formData.forEach((value, key) => {
                        formDataObject[key] = value;
                    });
                    try {
                        const response = await fetch(e.action, {
                            method: e.method,
                            headers: {
                                'Content-Type': 'application/json',
                                "Accept": 'application/json',
                                'X-CSRF-TOKEN': formDataObject._token,
                            },
                            body: JSON.stringify(formDataObject),
                        });
                        const result = await response.json();
                        if (result.message) {
                            navigator.clipboard.writeText(result.message).then(() => {
                                Snackbar.show({
                                    text: result.message,
                                    showAction: false,
                                    pos: "top-right",
                                    duration: "3000",
                                    backgroundColor: "#000",
                                });
                            });
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                })
            })
        }

        handleWishlistAddCart();

        // xoá sản phẩm ra khỏi danh sách yêu thích
        async function handleDeleteProductWishList() {
            const listFormDelete = document.querySelectorAll('#wrap-form-user .form-wl-delete'),
                listWishList = document.querySelectorAll('#wishlistFetchData tr');
            listFormDelete.forEach((e, i) => {
                e.addEventListener('submit', async (ev) => {
                    ev.preventDefault();
                    const formData = new FormData(e);
                    const formDataObject = {};
                    formData.forEach((value, key) => {
                        formDataObject[key] = value;
                    });
                    try {
                        const response = await fetch(e.action, {
                            method: e.method,
                            headers: {
                                'Content-Type': 'application/json',
                                "Accept": 'application/json',
                                'X-CSRF-TOKEN': formDataObject._token
                            },
                            body: JSON.stringify(formDataObject),
                        });
                        const result = await response.json();
                        if (result.message) {
                            navigator.clipboard.writeText(result.message).then(() => {
                                Snackbar.show({
                                    text: result.message,
                                    showAction: false,
                                    pos: "top-right",
                                    duration: "3000",
                                    backgroundColor: "#000",
                                });
                            });
                        }
                        listWishList[i].remove();

                    } catch (error) {
                        console.error('Error:', error);
                    }
                })
            })

        }
        handleDeleteProductWishList();
    </script>
@endsection
