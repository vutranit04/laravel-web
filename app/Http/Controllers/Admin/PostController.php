<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit=5)
{
        // $list = DB::table('posts')
        //  ->join('users', 'posts.id', '=', 'users.id')
        // ->select(
        //     'posts.id',
        //     'posts.title',
        //     'posts.slug',
        //     'posts.content',
        //     'posts.image',
        //     'posts.status',
        //     'posts.userid',
        //     'posts.created_at',
        //     'users.fullname'
        // )
        // ->where('posts.status', 1)
        // ->orderBy('posts.id', 'desc')
        // ->get();

     $list=Post::with('user')
        ->orderBy('id','desc')
        ->paginate($limit);
        return view('admin.posts.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Lấy danh sách gồm id và họ tên của các users
        $users = User::select('id', 'fullname')->get();
        return view('admin.posts.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {    try{

    //Xử lý phần hình ảnh của bài viết
        $imagePath = null; // Mặc định nếu không chọn ảnh thì lưu null hoặc trống
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        // Tạo tên file duy nhất: ví dụ 1719730000_hinhanh.jpg
        $fileName = time() . '_' . $file->getClientOriginalName();
        // Đẩy file vào thư mục public/uploads/posts
        $file->move(public_path('uploads/posts'), $fileName);
        // Đường dẫn chuẩn để lưu vào cơ sở dữ liệu
        $imagePath = 'uploads/posts/' . $fileName;
    }

           Post::create([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'content'=>$request->input('content'),
            'image'=>$imagePath,
            'status'=>$request->status,
            'userid'  => $request->userid,
        ]);
        return redirect()
        ->route('admin.posts.index')
        ->with('success','Thêm bài viết thành công!');
    }catch(\Exception $e)
    {
        return back()
        ->withInput()
        ->with('error', $e->getMessage());
    }

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
        $post=Post::find($id);
        $users=User::select('id','fullname')->get();
        return view('admin.posts.edit',compact('post','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        //Kiểm tra
        try{
            if(empty($request->userid))
          {      return back()
            ->withInput()
            ->with('error','Vui lòng chọn tác giả!');}

        $post=Post::find($id);
            if(!$post)
                {
                    return redirect()
                    ->route('admin.posts.index')
                    ->with('error','Bài viết không tồn tại.');
                }
                //Thực hiện update
                $post->update([
                    'title'=>$request->title,
                     'slug'=>$request->slug,
                    'content'=>$request->input('content'),
                    'status'=>$request->status,
                    'userid'  => $request->userid,
                ]);
                return redirect()
                ->route('admin.posts.index')
                ->with('success','Sửa bài viết thành công!');

        }catch(\Exception $e)
        {
            return back()
            ->route('admin.posts.index')
            ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage (Soft Delete).
     */
    public function destroy(string $id)
    {
        try {
            Post::findOrFail($id)->delete();
            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Xóa thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại: ' . $e->getMessage());
        }
    }

    /**
     * Hiển thị danh sách dữ liệu đã xóa mềm Soft Delete (Thùng rác).
     */
    public function trash($limit = 10)
    {
        $list = Post::onlyTrashed()
            ->with('user')
            ->orderBy('id', 'desc')
            ->paginate($limit);

        return view('admin.posts.trash', compact('list'));
    }

    /**
     * Khôi phục dữ liệu đã bị xóa mềm.
     */
    public function restore(string $id)
    {
        try {
            Post::onlyTrashed()->findOrFail($id)->restore();
            return redirect()
                ->route('admin.posts.trash')
                ->with('success', 'Khôi phục thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại: ' . $e->getMessage());
        }
    }

    /**
     * Xóa vĩnh viễn dữ liệu khỏi CSDL.
     */
    public function forceDelete(string $id)
    {
        try {
            $post = Post::onlyTrashed()->findOrFail($id);

            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $post->forceDelete();

            return redirect()
                ->route('admin.posts.trash')
                ->with('success', 'Xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại: ' . $e->getMessage());
        }
    }
}
