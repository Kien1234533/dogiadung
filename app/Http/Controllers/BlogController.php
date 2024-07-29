<?php

namespace App\Http\Controllers;

use App\Helpers\StringHelper;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Lấy tất cả post đã công bố và nổi bật
        $blogOutstand = Blog::where('post_status', 'publish')
            ->where('post_outstand', 'open')
            ->orderBy('created_at', 'desc')
            ->take(4) // Lấy 3 bài viết
            ->get();
        // Lấy 6 bài viết mới nhất
        $blogNew = Blog::where('post_status', 'publish')
            ->orderBy('created_at', 'desc')
            ->skip(3)
            ->take(4)
            ->get();
        // Lấy tất cả blog
        $blogList = Blog::where('post_status', 'publish')
            ->orderBy('created_at', 'desc')
            ->get();
        // Lấy danh sách các blog đã xem gần đây từ session
        $recentlyViewed = session('viewBlog', []);
        if (!empty($recentlyViewed)) {
            $recentBlog = Blog::whereIn('id', $recentlyViewed)
                ->orderByRaw("FIELD(id, " . implode(',', $recentlyViewed) . ") DESC")
                ->get();
        } else {
            $recentBlog = collect(); // Không có sản phẩm nào
        }
        return view('blogs.index', compact('blogList', 'blogOutstand', 'blogNew', 'recentBlog'));
    }
    public function home()
    {
        $blog = Blog::all();
        return view('admin.blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cateBlog = BlogCategory::all();
        return view('admin.blog.create', compact('cateBlog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $all = $request->all();
        $request->validate([
            'title' => 'required',
            'shortcontent' => 'required',
            'longcontent' => 'required',
            'post_status' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp,image/png',
        ]);
        $StringHelper = new StringHelper();
        $slug = $StringHelper->toSlug($all['title']);
        // upload hình
        $filePhoto = $all['photo'];
        $fileName = $filePhoto->getClientOriginalName();
        $filePhoto->move('uploads/blog', $fileName);
        // Thêm slug,photo
        $blog = new Blog($all);
        $blog->slug = $slug;
        $blog->photo = $fileName;
        $blog->save();
        //   Thêm danh mục
        $blog->categories()->attach($all['categories']);
        return redirect('/managerblog');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $code = explode(".html", $id);
        $blog = Blog::where('slug', '=', $code[0])->first();
        if (!$blog) {
            return view('notfound');
        }
        $blog->view += 1;
        $blog->save();
        // Lấy danh sách các bài viết đã xem từ session hoặc khởi tạo nếu chưa tồn tại
        $blogId = $blog->id;
        $viewBlog = session('viewBlog', []);
        // Kiểm tra xem blog này đã được xem chưa
        if (!in_array($blogId, $viewBlog)) {
            // Nếu chưa xem, thêm ID blog vào danh sách
            $viewBlog[] = $blogId;
            // Giới hạn số lượng blog trong danh sách (ví dụ: 5 blog)
            if (count($viewBlog) > 5) {
                array_shift($viewBlog);
            }
            // Lưu danh sách vào session
            session(['viewBlog' => $viewBlog]);
        }
        // get blog see a lot 
        $blogSeealot = Blog::orderBy('view', 'desc')->take(4)->get();
        // get blog new
        $blogNew = Blog::orderBy('created_at', 'desc')->take(5)->get();

        return view('blogs.show', compact('blog', 'blogSeealot', 'blogNew'));
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
