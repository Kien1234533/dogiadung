@extends('layouts.managerment')
@section('title', 'Add Product')
@section('create_product')
    <div class="textbox">
        <h3 class="title">Add a product</h3>
        <p class="desc">Orders placed across your store</p>
    </div>
    <form action="{{ route('product.store') }}" method="post" class="form-wrap" enctype="multipart/form-data" id="addproduct">
        @csrf
        <div class="left">
            <label class="form-group">
                <span class="text">Product Title</span>
                <input type="text" placeholder="Write here title..." name="name" />
            </label>
            <label class="form-group">
                <span class="text">Short Description</span>
                <input type="text" placeholder="Write here shortdesc..." name="shortdesc" />
            </label>
            <div class="form-group">
                <span class="text">Long Description</span>
                <input type="hidden" name="description" id="quillContent" />
                <div id="longdesription"></div>
            </div>
            <div class="number-box">
                <label class="form-group">
                    <span class="text">Price</span>
                    <input type="" name="price" placeholder="150000" />
                </label>
                <label class="form-group">
                    <span class="text">Discount</span>
                    <input type="number" name="discount" placeholder="90" min="0" max="100" />
                </label>
                <label class="form-group">
                    <span class="text">Quantity</span>
                    <input type="number" name="quantity" placeholder="200" />
                </label>
            </div>
            <label class="form-group">
                <span class="text">Photo</span>
                <input type="file" name="image[]" multiple />
            </label>
        </div>
        <div class="right">
            <div class="status">
                <h4 class="title">Status</h4>
                <div class="list">
                    <label class="form-group">
                        <input type="radio" name="status" value="publish" checked />
                        <span class="text">Publish</span>
                    </label>
                    <label class="form-group">
                        <input type="radio" name="status" value="draft" />
                        <span class="text">Save draft</span>
                    </label>
                    <button type="submit" class="btn-add">Submit</button>
                </div>
            </div>
            <div class="category">
                <h4 class="title">Category</h4>
                <div class="list">
                    @foreach ($listCategory as $item)
                        <label class="form-group">
                            <input type="checkbox" name="categories[]" value="{{ $item->id }}" />
                            <span class="name">{{ $item->category_name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            {{-- <div class="color">
                <h4 class="title">Colors</h4>
                <div class="list">
                    @foreach ($listColor as $item)
                        <label class="form-group">
                            <input type="checkbox" name="colors[]" value="{{ $item->id }}" />
                            <span class="name">{{ $item->color_name }}</span>
                        </label>
                    @endforeach
                </div>
            </div> --}}
            <div class="size">
                <h4 class="title">Sizes</h4>
                <div class="list">
                    @foreach ($listSize as $item)
                        <label class="form-group">
                            <input type="checkbox" name="sizes[]" value="{{ $item->id }}" />
                            <span class="name">{{ $item->size_name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="outstand">
                <h4 class="title">Outstand</h4>
                <label class="form-group">
                    <input type="checkbox" name="outstand" value="open" />
                    <span class="name_outstand">Enable feature</span>
                </label>
                <p class="text">
                    Lưu ý: Bật tính năng này sản phẩm sẽ được hiển thị ở mục sản
                    phẩm nổi bật
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
