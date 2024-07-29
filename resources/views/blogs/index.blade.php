@extends('layouts.main')
@section('title', 'Blog')
@section('blog')
    <main class="main" id="blogpage">
        <section class="banner cpn_banner">Blog</section>
        <section class="blog">
            <div class="container">
                <div class="blog_content">
                    <div class="blog_content-left cpn_blog">
                        <div class="box">
                            <h5 class="title">Recent Post</h5>
                            <div class="list --recent">
                                @if (count($recentBlog) > 0)
                                    @foreach ($recentBlog as $item)
                                        @php
                                            $url = $item->slug . '.html';
                                        @endphp
                                        <div class="item">
                                            <div class="thumnail">
                                                <img src="{{ asset('/uploads/blog') }}/{{ $item->photo }}"
                                                    alt="" />
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
                                @else
                                    <p>Không có bài viết nào vừa xem</p>
                                @endif
                            </div>
                        </div>
                        <div class="box">
                            <h5 class="title">Featured Products</h5>
                            <div class="list --featured">
                                @foreach ($blogOutstand as $item)
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
                            <div class="list --new">
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
                    <div class="blog_content-right">
                        @foreach ($blogList as $item)
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
                                    <p class="desc">
                                        {{ $item->shortcontent }}
                                    </p>
                                    <a href="{{ route('blogs.show', $url) }}" class="btn-more">Read more</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
