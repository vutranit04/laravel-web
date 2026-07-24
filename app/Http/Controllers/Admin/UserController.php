<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        $list = User::select(
            'id',
            'fullname',
            'username',
            'email',
            'password',
            'phone',
            'address',
            'gender',
            'birthday',
            'role',
            'status'
        )
            ->orderBy('username')
            ->paginate($limit);

        return view('admin.users.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();

            User::create($data);

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Thêm người dùng thành công!!');
        } catch (\Exception $e) {
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
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return back()
                    ->withInput()
                    ->with('error', 'Người dùng không tồn tại');
            }

            // Lấy dữ liệu đã validate
            $data = $request->validated();

            // Nếu không nhập password mới thì bỏ qua, giữ password cũ
            if (empty($data['password'])) {
                unset($data['password']);
            }

            // Cập nhật
            $user->update($data);

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Sửa thông tin người dùng thành công!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}