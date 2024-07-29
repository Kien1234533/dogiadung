<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title')</title>
    {{-- <link rel="icon" href="favicon.ico" /> --}}
    <meta name="title" content="" />
    <meta name="description" content="trương quốc đạt" />
    <!-- meta facebook -->
    <meta property="og:locale" content="vi" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="Lacosa sản phẩm tốt" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:image" content="" />
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('dest/style.min.css') }}" />
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- snackbar -->
    <script src="{{ asset('dest/snackbar.min.js') }}" defer></script>
    <!-- flickity -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <style>
        /* CSS */
        #chat-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            transition: transform 0.5s ease-in-out;
            z-index: 1000;
        }

        #chat-widget img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        #chat-widget img:hover {
            transform: scale(1.1);
            /* Hiệu ứng phóng to khi di chuột vào */
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;

            padding: 12px 16px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header class="header">
        <div class="container">
            <div class="header_content">
                <a href="{{ route('home') }}" class="header_content-logo">
                    <img srcset="{{ asset('./img/logo-removebg-preview.png 2x') }}" alt="" />
                </a>
                <ul class="header_content-nav">
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li><a href="{{ route('about') }}">Giới thiệu</a></li>
                    <li>
                        <a href="{{ route('shop') }}">Sản phẩm</a>


                    </li>

                    <li><a href="{{ route('blogs.index') }}">Tin tức</a></li>
                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                </ul>
                <div class="header_content-contact">
                    <i class="fa-solid fa-magnifying-glass btnopensearch"></i>
                    {{-- <a href="{{ route('user.index') }}">
                        <i class="fa-solid fa-circle-user"></i>
                    </a> --}}
                    <a href="{{ route('giohang') }}">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    {{-- bars --}}
                    <i class="bars fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
        <ul class="header_content-mobile">
            <li><a href="{{ route('home') }}">Trang chủ</a></li>
            <li><a href="{{ route('about') }}">Giới thiệu</a></li>
            <li>
                <a href="{{ route('shop') }}">Sản phẩm</a>
            </li>
            <li><a href="{{ route('blogs.index') }}">Tin tức</a></li>
            <li><a href="{{ route('contact') }}">Liên hệ</a></li>
        </ul>
    </header>

    <!-- MAIN -->
    @yield('home')
    @yield('product')
    @yield('about')
    @yield('shop')
    @yield('blog')
    @yield('blogdetail')
    @yield('contact')
    @yield('profile')
    @yield('cart')
    @yield('payment')
    @yield('thankoder')
    @yield('thank')
    @yield('thankmomo')
    @yield('notfound')
    @yield('thanhtoan')
    @yield('giohang')

    <div id="chat-widget">
        <a href="{{ route('contact') }}" target="">
            <img src="https://tse2.mm.bing.net/th?id=OIP.y4IYoC5igL77E9V7e1HleQHaHa&pid=Api&P=0&w=400&h=400"
                alt="Zalo Chat">
        </a>
    </div>
    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer_content-top">
                    <div class="wraplogo">
                        <a href="./" class="logo">
                            <img srcset="{{ asset('img/logo-removebg-preview.png 2x') }}" alt="" />
                        </a>
                        <p class="desc">
                            LACOSA - Thương hiệu gia dụng cao cấp hàng đầu Đức và châu Âu hiện nay
                        </p>
                        <div class="social">
                            <i class="fa-brands fa-twitter"></i>
                            <i class="fa-brands fa-facebook-f"></i>
                            <i class="fa-brands fa-instagram"></i>
                            <i class="fa-brands fa-github"></i>
                        </div>
                    </div>
                    <div class="list">
                        <div class="item">
                            <h4 class="title">Công ty</h4>
                            <p class="text">CTY TNHH TM DV THIẾT BỊ MIỀN NAM</p>
                            <p class="text">1/17 sơn kỳ - sơn kỳ - tân phú</p>
                            <p class="text">0943 202 069</p>
                            <p class="text"></p>
                        </div>
                        <div class="item">
                            <h4 class="title">Trợ giúp</h4>
                            <p class="text">Hướng dẫn mua hàng</p>
                            <p class="text">Hướng dẫn thanh toán</p>
                            <p class="text">Hướng dẫn giao nhận</p>
                            <p class="text">Điều khoản dịch vụ</p>
                        </div>
                        <div class="item">
                            <h4 class="title">CHÍNH SÁCH</h4>
                            <p class="text">Chính sách bảo mật</p>
                            <p class="text">Quy định sử dụng</p>
                            <p class="text">Chính sách vận chuyển</p>
                            <p class="text">Chính sách đổi trả</p>
                        </div>
                        <div class="item">
                            <h4 class="title">Liên kết tài nguyên</h4>
                            <p class="text">Shopee</p>
                            <p class="text">Facebook</p>
                            <p class="text">Youtube</p>
                            <p class="text">Tiktok</p>
                        </div>
                    </div>
                </div>
                <div class="footer_content-bottom">
                    <div class="left">Lacosa © 2023-2024, All Rights Reserved</div>
                    <div class="right">
                        <img srcset="{{ asset('img/Badge.png 2x') }}" alt="" />
                        <img srcset="{{ asset('img/Badge2.png 2x') }}" alt="" />
                        <img srcset="{{ asset('img/Badge3.png 2x') }}" alt="" />
                        <img srcset="{{ asset('img/Badge4.png 2x') }}" alt="" />
                        <img srcset="{{ asset('img/Badge5.png 2x') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div id="searchpopup">
        <div class="boxwrap">
            <input type="search" id="searchproduct" name="keyword"
                placeholder="Nhập tên sản phẩm bạn muốn tìm kiếm....">
            <div id="searchresult">
            </div>
        </div>
    </div>
    <script>
        //Responsive Navbar Mobile
        const bars = document.querySelector('.header_content-contact .bars');
        const menuMobile = document.querySelector('.header_content-mobile');
        bars.addEventListener('click', () => {
            bars.classList.toggle('changeColor');
            menuMobile.classList.toggle('open');
        })

        const locationHref = window.location.href,
            urlPhoto = locationHref.split("/public/")[0];
        const searchText = document.querySelector('#searchproduct'),
            searchResult = document.querySelector('#searchresult'),
            openPopupSearch = document.querySelector('.btnopensearch'),
            searchPopup = document.querySelector('#searchpopup');

        // sự kiện click vào icon search để mở popup search
        openPopupSearch.addEventListener('click', (e) => {
            e.stopPropagation();
            searchPopup.classList.toggle('active');
        })
        // sự kiện click document nếu click ngoài vùng của input search và kêt quả search thì nó tắt search
        document.addEventListener('click', (ev) => {
            const isClickInsideSearch = searchText.contains(ev.target);
            const isClickInsideResults = searchResult.contains(ev.target);
            if (!isClickInsideSearch && !isClickInsideResults) {
                searchPopup.classList.remove('active');
                searchText.value = "";
            }
        })
        let searchTimer;
        searchText.addEventListener('input', async (e) => {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(async () => {
                try {
                    const data = await handleSearchAjax(e.target.value);
                    const html = data.data.map(e => {
                        const thumbnail = JSON.parse(e.image);
                        let slug = e.slug + "-" + e.code + ".html";
                        return `
                    <div class="item">
                        <div class="thumnail">
                            <img src="${urlPhoto}/public/uploads/${thumbnail[0]}" alt="" />
                        </div>
                        <div class="content">
                            <a href="${urlPhoto}/public/product/${slug}" class="name">${e.name}</a>
                            <p class="price">${new Intl.NumberFormat().format(e.pricesale)}đ</p>
                        </div>
                    </div>`
                    })
                    searchResult.innerHTML = html.join('');
                } catch (error) {
                    console.log(error);
                }
            }, 500)

        });
        async function handleSearchAjax(keyword) {
            const url = "{{ route('product.search') }}";
            const token = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": token,
                },
                body: JSON.stringify({
                    keyword
                }),
            });
            const result = await response.json();
            return result;
        }

        // JavaScript
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            var chatWidget = document.getElementById("chat-widget");
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                chatWidget.style.transform = "translateY(-100px)";
            } else {
                chatWidget.style.transform = "translateY(0)";
            }
        }
    </script>
    <script type="text/javascript" src="{{ asset('dest/jsmain.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dest/main.js') }}"></script>
</body>

</html>
