@extends('layouts.managerment')
@section('title', 'Manager Blog')
@section('create_blog')
    <div class="textbox">
        <h3 class="title">Add a blog</h3>
        <p class="desc">News is placed on your store</p>
    </div>
    <form action="{{ route('blogs.store') }}" method="post" class="form-wrap" enctype="multipart/form-data" id="addproduct"
        style="padding-bottom: 100px">
        @csrf
        <div class="left">
            <label class="form-group">
                <span class="text">Blog Title</span>
                <input type="text" placeholder="Write here title..." name="title" />
            </label>
            <label class="form-group">
                <span class="text">Short Content</span>
                <input type="text" placeholder="Write here shortdesc..." name="shortcontent" />
            </label>
            <div class="form-group">
                <span class="text">Long Content</span>
                <input type="hidden" name="longcontent" id="quillContent" />
                <div id="longdesription"></div>
            </div>
            <label class="form-group">
                <span class="text">Photo</span>
                <input type="file" name="photo" />
            </label>
        </div>
        <div class="right">
            <div class="status">
                <h4 class="title">Status</h4>
                <div class="list">
                    <label class="form-group">
                        <input type="radio" name="post_status" value="publish" checked />
                        <span class="text">Publish</span>
                    </label>
                    <label class="form-group">
                        <input type="radio" name="post_status" value="draft" />
                        <span class="text">Save draft</span>
                    </label>
                    <button type="submit" class="btn-add">Submit</button>
                </div>
            </div>
            <div class="category">
                <h4 class="title">Category</h4>
                <div class="list" style="flex-direction: column">
                    @foreach ($cateBlog as $item)
                        <label class="form-group">
                            <input type="checkbox" name="categories[]" value="{{ $item->id }}" />
                            <span class="name">{{ $item->category_name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="outstand">
                <h4 class="title">Outstand</h4>
                <label class="form-group">
                    <input type="checkbox" name="post_outstand" value="open" />
                    <span class="name_outstand">Enable feature</span>
                </label>
                <p class="text">
                    Lưu ý: Bật tính năng này sản phẩm sẽ được hiển thị ở mục tin tức nổi bật
                </p>
            </div>
        </div>
    </form>
    <script>
        const toolbarOptions = [
            ["bold", "italic", "underline", "link", "image"],
            ["blockquote", "code-block"],
            [{
                header: 1
            }, {
                header: 2
            }],
            [{
                list: "ordered"
            }, {
                list: "bullet"
            }],
            [{
                align: []
            }],
        ];
        var quill = new Quill("#longdesription", {
            modules: {
                toolbar: toolbarOptions,
            },
            theme: "snow",
        });
        // Khi quill onchange thì text sẽ được fill vào input hidden description
        quill.on("text-change", function() {
            document.getElementById("quillContent").value = JSON.stringify(
                quill.root.innerHTML
            );
            console.log(document.getElementById("quillContent").value);
        });
    </script>
@endsection
