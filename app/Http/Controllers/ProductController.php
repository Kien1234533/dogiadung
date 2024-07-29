<?php

namespace App\Http\Controllers;

use App\Helpers\StringHelper;
use App\Models\Blog;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductComment;
use App\Models\Size;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::orderBy('id', 'desc')->get();
        return view('admin.product.index', compact('product'));
    }
    public function home()
    {
        $productSale = Product::where('status', '=', 'publish')
            ->where('discount', '>', 0)
            ->orderBy('discount', 'desc')
            ->get();
        $productNew = Product::where('status', '=', 'publish')
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        $blogList = Blog::where('post_status', '=', 'publish')->orderBy('created_at', 'desc')->take(6)->get();
        // all comment
        $commentList = ProductComment::orderBy('created_at', 'desc')->take(10)->get();
        return view('products.index', compact('productSale', 'productNew', 'blogList', 'commentList'));
    }
    public function shoppage(Request $request)
    {
        // sắp xếp
        $sort = $request->input('sort');
        // lọc
        $arrCategories = $request->input('categories');
        $arrColor = $request->input('colors');
        $arrSize = $request->input('sizes');
        $price = $request->input('price');
        // phân trang
        $page = $request->input('page', 1);
        // kiểm tra xem sort có tồn tại không nếu có thì gán bằng id.desc
        if (!$sort) {
            $sort = "id.desc";
        }
        // cắt sort theo kí tự dấu . đc 2 phần tử namecolumn, desc or assc
        $sortSplit = explode('.', $sort);
        // cắt price theo kí tự - đc 2 phần tử là minprice, maxprice
        $priceSplit = explode('-', $price);

        $query = Product::query();
        // Lọc theo mảng danh mục
        if (!empty($arrCategories)) {
            $query->whereHas('categories', function ($query) use ($arrCategories) {
                $query->whereIn('id', $arrCategories);
            });
        }
        // Lọc theo khoảng giá
        /// TH1: lọc giá > max
        if (empty($priceSplit[1]) && $priceSplit[0] !== "") {
            $query->where('price', '>=', $priceSplit[0]);
        }
        /// TH2: lọc giá trong khoảng min-max
        if (!empty($priceSplit[0]) && !empty($priceSplit[1])) {
            $query->whereBetween('price', [$priceSplit[0], $priceSplit[1]]);
        }
        // Lọc theo mảng màu
        if (!empty($arrColor)) {
            $query->whereHas('colors', function ($query) use ($arrColor) {
                $query->whereIn('id', $arrColor);
            });
        }
        // Lọc theo mảng size
        if (!empty($arrSize)) {
            $query->whereHas('sizes', function ($query) use ($arrSize) {
                $query->whereIn('id', $arrSize);
            });
        }
        // Sắp xếp sản phẩm
        $product = $query->orderBy($sortSplit[0], $sortSplit[1])->get();

        // Tính tổng số lượng sản phẩm
        $totalProducts = $query->count();

        // Phân trang lại
        $perPage = 12;
        $product = $query->paginate($perPage, ['*'], 'page', $page);

        if ($totalProducts === 0) {
            return response()->json(['message' => 'There are no products that match the filter', 'data' => $product, 'page' => $page, 'total' => $totalProducts]);
        }
        return response()->json(['message' => 'success', 'data' => $product, 'page' => $page, 'total' => $totalProducts]);
    }
    public function shop()
    {
        // categories
        $categories = ProductCategory::all();
        // colors
        $colors = Color::all();
        // sizes
        $selectSize = DB::table('product_size')
            ->select('size_id')
            ->distinct()
            ->orderBy('size_id', 'asc')->get();
        $arrSize = array_column(json_decode(json_encode($selectSize), true), 'size_id');
        $sizes = Size::whereIn('id', $arrSize)->get();
        return view('products.shop', compact('categories', 'colors', 'sizes'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listCategory = ProductCategory::all();
        $listColor = Color::all();
        $listSize = Size::all();
        return view('admin.product.create', compact('listCategory', 'listColor', 'listSize'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'shortdesc' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp,image/png',
        ]);
        $StringHelper = new StringHelper();
        $slug = $StringHelper->toSlug($request->input('name'));
        $price = (int)$request->input('price');
        $discount = (int)$request->input('discount');
        $quantity = (int)$request->input('quantity');
        if ($discount > 0) {
            $pricesale = $price - ($price * $discount / 100);
        } else {
            $pricesale = $price;
        }
        $fileImage = $request->file('image');
        $fileNames = [];
        foreach ($fileImage as $file) {
            $fileName = $file->getClientOriginalName();
            $file->move('uploads', $fileName);
            $fileNames[] = $fileName;
        }
        $product = new Product($request->all());
        $product->code = Str::random();
        $product->slug = $slug;
        $product->price = $price;
        $product->pricesale = $pricesale;
        $product->discount = $discount;
        $product->quantity = $quantity;
        $product->image = json_encode($fileNames);
        $product->save();
        $product->categories()->attach($request->input('categories'));
        // $product->colors()->attach($request->input('colors'));
        $product->sizes()->attach($request->input('sizes'));
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $code = explode("-", $id);
        $code = $code[count($code) - 1];
        $code = str_replace('.html', "", $code);
        $product = Product::where('code', '=', $code)
            ->with('colors', 'sizes')
            ->first();
        if (!$product) {
            return view('notfound');
        }
        // lấy sản phẩm tương tự
        $productSame = Product::whereHas('categories', function ($query) use ($product) {
            $query->whereIn('product_categories.id', $product->categories->pluck('id'));
        })
            ->where('id', '!=', $product->id)
            ->where('status', 'publish')
            ->get();
        // lấy id user
        $user_id = null;
        if (Auth::user()) {
            $user_id = Auth::user()->id;
        };
        // lấy comment theo product
        $productComment = $product->comments()->get();

        return view('products.show', compact('product', 'productSame', 'user_id', 'productComment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function comment(Request $request)
    {
        $all = $request->all();
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'content' => 'required',
        ]);
        $comment = new ProductComment($all);
        $comment->save();

        // Update comment_count for the associated product
        $product = Product::find($all['product_id']);
        if ($product) {
            $product->comment_count += 1;
            $product->save();
        }
        return back();
    }
    // search
    public function search(Request $request)
    {
        $data = $request->all();
        if ($data['keyword'] !== "") {
            $searchResult = Product::where('name', 'like', '%' . $data['keyword'] . '%')->get();
        } else {
            $searchResult = Product::all();
        }
        return response()->json(['message' => 'success', 'data' => $searchResult]);
    }
}
