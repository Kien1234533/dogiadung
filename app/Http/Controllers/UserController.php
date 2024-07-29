<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductComment;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        // lấy tất cả order user
        $order = Order::where('user_id', '=', $user_id)
            ->where('is_processed', '=', 'done')
            ->get();
        // lấy ra thời gian đặt hàng cuối cùng của user
        $time = Order::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->first();
        if ($time) {
            $time = $time->created_at
                ->diffForHumans();
        }
        // Lấy tất cả comment theo user
        $comment = ProductComment::where("user_id", '=', $user_id)->get();
        // Lấy danh sách sản phẩm yêu thích theo user
        $wishlist = Wishlist::where("user_id", '=', $user_id)->get();
        return view('profile', compact('order', 'comment', 'time', 'wishlist'));
    }
    public function orderdetail(Request $request)
    {
        $orderId = $request->input('orderId');
        $order = Order::find($orderId);
        return response()->json(['message' => 'success', 'data' => $order]);
    }


    public function cancelorder(Request $request)
    {
        $orderId = $request->input('orderid');
        $order = Order::find($orderId);
        if ($order) {
            $order->update(['status' => 'cancel']);
        }
        return back();
    }


    public function addwishlist(Request $request)
    {
        $all = $request->all();
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'pricesale' => 'required',
            'image' => 'required',
            'color' => 'required',
            'size' => 'required',
            'quantity' => 'required',
        ]);
        $wishlist = new Wishlist($all);
        $wishlistCheck = Wishlist::where('user_id', $all['user_id'])
            ->where('product_id', $all['product_id'])
            ->where('color', $all['color'])
            ->where('size', $all['size'])
            ->first();
        if ($wishlistCheck) {
            return response()->json(['message' => "Sản phẩm đã có trong danh sách yêu thích"]);
        } else {
            $wishlist->user_id = (int)$all['user_id'];
            $wishlist->product_id = (int) $all['product_id'];
            $wishlist->price = (int) $all['price'];
            $wishlist->pricesale = (int)$all['pricesale'];
            $wishlist->quantity = (int)$all['quantity'];
            $wishlist->save();
            return response()->json(['message' => "Đã Thêm sản phẩm vào danh sách yêu thích"]);
        }
    }
    public function deletewishlist(Request $request)
    {
        $wishlistId = $request->input('wishlist_id');
        $wishlist = Wishlist::find($wishlistId);
        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['message' => 'Bỏ sản phẩm ra khỏi danh sách yêu thích thành công']);
        }
        return response()->json(['message' => 'Sản phẩm không tồn tại trong danh sách yêu thích']);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
