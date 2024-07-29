@extends('layouts.main')
@section('title', 'Liên hệ')
@section('contact')
    <main class="main" id="contactpage">
        <section class="banner">
            <div class="banner_content">
                <h2 class="banner_content-title">Liên hệ chúng tôi</h2>
                <span class="banner_content-text">keep in touch with us</span>
            </div>
        </section>
        <section class="contact">
            <div class="container">
                <div class="contact_content">
                    <div class="contact_content-left">
                        <h3 class="title">Thông tin liên lạc</h3>
                        <p class="desc">
                            Liên lạc với Lacosa
                        </p>
                        <div class="box">
                            <div class="item">
                                <div class="icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="content">
                                    1/17 sơn kỳ - sơn kỳ - tân phú - CTY TNHH TM DV THIẾT BỊ MIỀN NAM
                                </div>
                            </div>
                            <div class="item">
                                <div class="icon"><i class="fa-solid fa-clock"></i></div>
                                <div class="content">
                                    Thứ Hai-Thứ Bảy <br />
                                    8 giờ sáng - 5 giờ tối
                                </div>
                            </div>
                            <div class="item">
                                <div class="icon"><i class="fa-solid fa-phone"></i></div>
                                <div class="content">0943 202 069</div>
                            </div>
                            {{-- <div class="item">
                                <div class="icon">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <div class="content">
                                    Chủ nhật<br />
                                    Nghỉ
                                </div>
                            </div> --}}
                            <div class="item">
                                <div class="icon"><i class="fa-solid fa-envelope"></i></div>
                                <div class="content">info@Molla.com</div>
                            </div>
                            <img src="{{ asset('img/zalo.jpg') }}" alt="">
                        </div>
                        
                    </div>
                    <div class="contact_content-right">
                        <h3 class="title">Có bất kỳ câu hỏi gì?</h3>
                        <p class="desc">
                           Vui lòng liên hệ với chúng tôi
                        </p>
                        <form action="https://httpbin.org/post" method="post">
                            <input type="text" placeholder="Tên *" name="name" />
                            <input type="email" placeholder="Email *" name="email" />
                            <input type="text" placeholder="Số điện thoại " name="phone" />
                            <input type="text" placeholder="Phụ đề " name="subject" />
                            <textarea name="content" placeholder="Lời nhắn *" cols="30" rows="4"></textarea>
                            <button type="submit" class="btn-sub">
                                <span>Gửi</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        {{-- <section class="map">
            <div class="container">
                <div class="map_content">
                    <div class="map_content-store">
                        <div class="title">Cửa hàng chúng tôi</div>
                        <div class="box">
                            <div class="item">
                                <div class="thumnail">
                                    <img src="./img/jani-godari-7-VA42UTNuQ-unsplash.jpg" alt="" />
                                </div>
                                <div class="content">
                                    <div class="address">
                                        <p class="name">Wall Street Plaza</p>
                                        <p class="desc">88 Pine St, New York, NY 10005, USA</p>
                                        <p class="desc">+1 987-876-6543</p>
                                    </div>
                                    <div class="address">
                                        <p class="name">Store Hours:</p>
                                        <p class="desc">Monday - Saturday 11am to 7pm</p>
                                        <p class="desc">Sunday 11am to 6pm</p>
                                    </div>
                                    <a href="#" class="btn-viewmap">
                                        <span>View map</span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumnail">
                                    <img src="./img/komarov-egor-V00Z5UcPBZU-unsplash.jpg" alt="" />
                                </div>
                                <div class="content">
                                    <div class="address">
                                        <p class="name">One New York Plaza</p>
                                        <p class="desc">88 Pine St, New York, NY 10005, USA</p>
                                        <p class="desc">+1 987-876-6543</p>
                                    </div>
                                    <div class="address">
                                        <p class="name">Store Hours:</p>
                                        <p class="desc">Monday - Friday 9am to 8pm</p>
                                        <p class="desc">Saturday - 9am to 2pm</p>
                                        <p class="desc">Sunday - Closed</p>
                                    </div>
                                    <a href="#" class="btn-viewmap">
                                        <span>View map</span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="map_content-location">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.474909851636!2d106.75548917506156!3d10.851437757805606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752797e321f8e9%3A0xb3ff69197b10ec4f!2zVHLGsOG7nW5nIGNhbyDEkeG6s25nIEPDtG5nIG5naOG7hyBUaOG7pyDEkOG7qWM!5e0!3m2!1svi!2s!4v1705678838741!5m2!1svi!2s"
                            width="100%" height="500" style="border: 0" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </section> --}}
    </main>
@endsection
