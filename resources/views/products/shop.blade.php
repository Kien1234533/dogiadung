@extends('layouts.main')
@section('title', 'Lacosa-Thiết bị miền nam')
@section('shop')
    <main class="main" id="shoppage">
        <section class="banner cpn_banner">Sản phẩm</section>
        <section class="products">
            <div class="container">
                <div class="products_content">
                    <div class="products_content-filter">
                        <div class="item">
                            <h5 class="title">Lọc sản phẩm</h5>
                            <img src="./img/Frame.png" alt="" />
                        </div>
                        <div class="item">
                            <h5 class="title">Danh mục</h5>
                            <div class="list" id="filter_categories">
                                @foreach ($categories as $item)
                                    <label class="form-group">
                                        <input type="checkbox" name="categories[]"value="{{ $item->id }}" />
                                        <span> {{ $item->category_name }} </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="item">
                            <h5 class="title">Giá</h5>
                            <div class="list" id="filter_price">
                                <p class="option" data-price="1-300000">0 - 300.000đ</p>
                                <p class="option" data-price="300000-500000">300.000 - 500.000đ</p>
                                <p class="option" data-price="500000-800000">500.000 - 800.000đ</p>
                                <p class="option" data-price="800000-1000000">800.000 - 1.000.000đ</p>
                                <p class="option" data-price="1000000">> 1.000.000đ</p>
                            </div>
                        </div>
                        {{-- <div class="item">
                            <h5 class="title">Colors</h5>
                            <div class="list" id="filter_colors">
                                @foreach ($colors as $key => $item)
                                    <label class="color-group {{ $item->color_code === '#fff' ? 'white' : '' }}">
                                        <input type="checkbox" name="colors[]" value="{{ $item->id }}" />
                                        <span class="bgr" style="background-color: {{ $item->color_code }}"></span>
                                    </label>
                                @endforeach
                            </div>
                        </div> --}}
                        <div class="item">
                            <h5 class="title">Đơn vị tính</h5>
                            <div class="list" id="filter_sizes">
                                @foreach ($sizes as $item)
                                    <label class="form-group">
                                        <input type="checkbox" name="sizes[]" value="{{ $item->id }}" />
                                        <span> {{ $item->size_name }} </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="products_content-box">
                        <div class="sort">
                            <h5 class="text">Sắp xếp:</h5>
                            <select id="sort_product">
                                <option value="id.desc">Sản phẩm mới nhất</option>
                                <option value="discount.desc">Giảm giá theo phần trăm</option>
                                <option value="sold.desc">Bán nhiều nhất</option>
                                <option value="pricesale.asc">Giá từ thấp đến cao</option>
                                <option value="pricesale.desc">Giá từ cao đến thấp</option>
                            </select>
                        </div>
                        <div class="productlist">
                        </div>
                        <div class="message" style="text-align: center"></div>
                        <div class="btn-load">Load More</div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <section class="voucher dfr">
            <div class="container">
                <div class="voucher_content">
                    <div class="voucher_content-heading">Promotional code</div>
                    <div class="voucher_content-box">
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
                                            <rect width="25" height="25" fill="white" transform="translate(8 8)">
                                            </rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="right">
                                <p class="name">Giảm đơn 150k</p>
                                <p class="desc">Cho đơn hàng tối thiểu 999k</p>
                                <p class="slot">Còn 250 mã</p>
                                <div class="coppy">
                                    <span class="query">Điều kiện</span>
                                    <span class="btn-cp" data-code="SALE150K">
                                        Sao chép mã</span>
                                </div>
                            </div>
                        </div>
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
                                <p class="name">Giảm đơn 100k</p>
                                <p class="desc">Cho đơn hàng tối thiểu 700k</p>
                                <p class="slot">Còn 990 mã</p>
                                <div class="coppy">
                                    <span class="query">Điều kiện</span>
                                    <span class="btn-cp" data-code="SALE100K">
                                        Sao chép mã</span>
                                </div>
                            </div>
                        </div>
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
                                                transform="translate(8 8)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="right">
                                <p class="name">Giảm đơn 50k</p>
                                <p class="desc">Cho đơn hàng tối thiểu 500k</p>
                                <p class="slot">Còn 100 mã</p>
                                <div class="coppy">
                                    <span class="query">Điều kiện</span>
                                    <span class="btn-cp" data-code="SALE50K"> Sao chép mã</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    </main>
    @include('include/shopjs')
@endsection
