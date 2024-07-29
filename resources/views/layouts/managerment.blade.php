<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('admin/reset.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <!-- Include stylesheet -->
    <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.core.css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
    <link rel="stylesheet" href="{{ asset('admin/admin.css') }}" />
</head>

<body>
    <main id="managerment-page">
        <section class="managerment">
            <div class="managerment_content">
                <div class="managerment_content-left">
                    <a href="" class="logo">SHOP.CO</a>
                    <ul class="list">
                        <a href="" class="item">
                            <i class="fa-solid fa-house"></i>
                            <span>Home</span>
                        </a>
                        <a href="{{ route('product.index') }}" class="item">
                            <i class="fa-solid fa-clipboard-list"></i>
                            <span>Products</span>
                        </a>
                        <a href="{{ route('product.create') }}" class="item active">
                            <i class="fa-solid fa-plus"></i>
                            <span>Add Product</span>
                        </a>
                        <a href="" class="item">
                            <i class="fa-solid fa-clipboard-user"></i>
                            <span>Customers</span>
                        </a>
                        <a href="{{ route('orders.index') }}" class="item">
                            <i class="fa-brands fa-shopify"></i>
                            <span>Orders</span>
                        </a>
                        <a href="{{ route('managerblog') }}" class="item">
                            <i class="fa-solid fa-blog"></i>
                            <span>Blogs</span>
                        </a>
                        <a href="{{ route('blogs.create') }}" class="item">
                            <i class="fa-solid fa-plus"></i>
                            <span>Add Blog</span>
                        </a>
                    </ul>
                </div>
                <div class="managerment_content-right">
                    @yield('dashboard')
                    @yield('read_product')
                    @yield('create_product')
                    @yield('read_order')
                    {{-- blog --}}
                    @yield('read_blog')
                    @yield('create_blog')
                </div>
            </div>
        </section>
    </main>
</body>

</html>
