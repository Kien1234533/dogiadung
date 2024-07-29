@extends('layouts.main')
@section('title', 'Giới thiệu')
@section('about')
    <main class="main" id="aboutpage">
        <section class="banner">
            <div class="banner_content">
                <h2 class="banner_content-title">Biết về chúng tôi</h2>
                <span class="banner_content-text">Chúng tôi là ai</span>
            </div>
        </section>
        <section class="about">
            <div class="container">
                <div class="about_content">
                    <div class="about_content-box">
                        <div class="item">
                            <div class="thumnail">
                                <img src="./img/bundo-kim-YXkRsFQ0P6w-unsplash.jpg" alt="" />
                            </div>
                            <div class="content">
                                <h3 class="title">
                                    SEO-focused WordPress web design and marketing agency
                                </h3>
                                <p class="desc">
                                    A brand today is all about how it makes your customers feel.
                                    It's not a logo, visual identity, or digital product design.
                                    but rather a cohesive system that spans across all mediums
                                    and touchpoints. We're a branding agency offering a complete
                                    solution from naming and logo design to communications and
                                    style guides.
                                </p>
                                <p class="desc">
                                    It's not a logo, visual identity, or digital product design.
                                    but rather a cohesive system that spans across all mediums
                                    and touchpoints. We're a branding agency
                                </p>
                                <a href="shop.html" class="btn-shop">Shop now</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="thumnail">
                                <img src="./img/clark-street-mercantile-P3pI6xzovu0-unsplash.jpg" alt="" />
                            </div>
                            <div class="content">
                                <h3 class="title">
                                    Branding has never been more agile than it is today
                                </h3>
                                <p class="desc">
                                    A brand today is all about how it makes your customers feel.
                                    It's not a logo, visual identity, or digital product design.
                                    but rather a cohesive system that spans across all mediums
                                    and touchpoints. We're a branding agency offering a complete
                                    solution from naming and logo design to communications and
                                    style guides.
                                </p>
                                <p class="desc">
                                    It's not a logo, visual identity, or digital product design.
                                    but rather a cohesive system that spans across all mediums
                                    and touchpoints. We're a branding agency
                                </p>
                                <a href="shop.html" class="btn-shop">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="data">
            <div class="container">
                <div class="data_content">
                    <div class="data_content-box">
                        <div class="item">
                            <p class="number">150+</p>
                            <p class="name">Khách hàng hài lòng vào năm 2024</p>
                            <p class="desc">
                                Xây dựng thương hiệu chưa bao giờ mở rộng, mạo hiểm và nhanh nhẹn hơn thế so với ngày nay
                            </p>
                        </div>
                        <div class="item">
                            <p class="number">89%</p>
                            <p class="name">Chiến lược bán hàng</p>
                            <p class="desc">
                                Xây dựng thương hiệu chưa bao giờ mở rộng, mạo hiểm và nhanh nhẹn hơn thế so với ngày nay
                            </p>
                        </div>
                        <div class="item">
                            <p class="number">190%</p>
                            <p class="name">Tăng lưu lượng truy cập</p>
                            <p class="desc">
                                Xây dựng thương hiệu chưa bao giờ mở rộng, mạo hiểm và nhanh nhẹn hơn thế so với ngày nay
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="recomment">
            <div class="container">
                <div class="recomment_content">
                    <div class="recomment_content-title">
                        Khách hàng nói gì về chúng tôi?
                    </div>
                    <div class="recomment_content-box"
                        data-flickity='{ "cellAlign": "left","freeScroll": true,"wrapAround": true, "groupCells": 1,"autoPlay": 3000,
          "prevNextButtons": false,"pageDots": false}'>
                        <div class="item">
                            <div class="thumnail">
                                <img src="./img/christopher-campbell-rDEOVtE7vOs-unsplash.jpg" alt="" />
                            </div>
                            <p class="name">Monica Smith</p>
                            <p class="desc">
                                Overall experience is awesome!! I'm a visual thinker, and I
                                couldn't function without a tool like this.
                            </p>
                        </div>
                        <div class="item">
                            <div class="thumnail">
                                <img src="./img/vicky-hladynets-C8Ta0gwPbQg-unsplash.jpg" alt="" />
                            </div>
                            <p class="name">Vincent Smith</p>
                            <p class="desc">
                                Overall experience is awesome!! I'm a visual thinker, and I
                                couldn't function without a tool like this.
                            </p>
                        </div>
                        <div class="item">
                            <div class="thumnail">
                                <img src="./img/alex-suprun-ZHvM3XIOHoE-unsplash.jpg" alt="" />
                            </div>
                            <p class="name">Stella Smith</p>
                            <p class="desc">
                                Overall experience is awesome!! I'm a visual thinker, and I
                                couldn't function without a tool like this.
                            </p>
                        </div>
                        <div class="item">
                            <div class="thumnail">
                                <img src="https://placehold.co/200x200" alt="" />
                            </div>
                            <p class="name">Stella Smith</p>
                            <p class="desc">
                                Overall experience is awesome!! I'm a visual thinker, and I
                                couldn't function without a tool like this.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
