@extends('layouts.main')
@section('title', 'BlogDetail')
@section('blogdetail')

    <main class="main" id="blogdetailpage">
        <section class="banner cpn_banner">Blog</section>
        <section class="blogdetail">
            <div class="container">
                <div class="blogdetail_content">
                    <div class="blogdetail_content-left cpn_blog">
                        <div class="box">
                            <h5 class="title">See a lot</h5>
                            <div class="list --view">
                                @foreach ($blogSeealot as $item)
                                    @php
                                        $url = $item->slug . '.html';
                                    @endphp
                                    <div class="item">
                                        <div class="thumnail">
                                            <img src="{{ asset('/uploads/blog') }}/{{ $item->photo }}" alt="" />
                                        </div>
                                        <div class="content">
                                            <p class="date">{{ $item->created_at }}</p>
                                            <a href="{{ route('blogs.show', $url) }}" class="name">
                                                {{ $item->title }}
                                            </a>
                                            <a href="{{ route('blogs.show', $url) }}" class="btn-readmore">Read more</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="box">
                            <h5 class="title">New Post</h5>
                            <div class="list --newdetail">
                                @foreach ($blogNew as $item)
                                    @php
                                        $url = $item->slug . '.html';
                                    @endphp
                                    <div class="item">
                                        <div class="thumnail">
                                            <img src="{{ asset('/uploads/blog') }}/{{ $item->photo }}" alt="" />
                                        </div>
                                        <div class="content">
                                            <p class="date">{{ $item->created_at }}</p>
                                            <a href="{{ route('blogs.show', $url) }}" class="name">
                                                {{ $item->title }}
                                            </a>
                                            <a href="{{ route('blogs.show', $url) }}" class="btn-readmore">Read more</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="blogdetail_content-right">
                        <h2 class="name">
                            {{ $blog->title }}
                        </h2>
                        <div class="box">
                            <div class="wrap">
                                <p class="date">{{ $blog->created_at }}</p>
                                <div class="cate">
                                    @foreach ($blog->categories as $item)
                                        <p class="item">{{ $item->category_name }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <p class="view">
                                <i class="fa-solid fa-eye"></i>
                                <span>{{ $blog->view }} view</span>
                            </p>
                        </div>
                        <div class="content">
                            @php
                                echo json_decode($blog->longcontent);
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
