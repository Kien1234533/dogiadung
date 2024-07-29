@extends('layouts.main')
@section('title', '404')
@section('notfound')
    <main class="main" id="notfoundpage">
        <section class="banner cpn_banner">404 Not Found</section>
        <section class="notfound">
            <div class="number">
                <span>4</span>
                <i class="fa-regular fa-face-sad-tear"></i>
                <span>4</span>
            </div>
            <p class="title">That page can't be found.</p>
            <p class="desc">Sorry! The page you're looking for clocked out!</p>
            <a href="{{ route('home') }}" class="btn-gohome">Go to Home</a>
        </section>
    </main>
@endsection
