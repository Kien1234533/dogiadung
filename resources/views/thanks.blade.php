@extends('layouts.main')
@section('title', 'Thanks')
@section('thank')
    <section class="banner cpn_banner bannerthankoder">Cảm ơn bạn đã đặt hàng</section>
    <div id="thankoder">
        <a href="{{ route('shop') }}">Tiếp tục đặt hàng</a>
        <a href="{{ route('home') }}">Quay về trang chủ</a>
    </div>
@endsection
