<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit=10)
    {
        //   $list= DB::table('users')
        // ->select ('id','fullname','username','email','password','phone','address','gender','birthday','role','status')
        // ->where('status',1)
        // ->orderBy('username')
        // ->get();
        // return view ('admin.users.index',compact('list'));
        $list=User::select('id',
        'fullname','username',
        'email',
        'password',
        'phone',
        'address',
        'gender',
        'birthday',
        'role',
        'status')
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
    public function store(Request $request)
    { try{
         User::create([
            'fullname'=>$request->fullname,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>$request->password,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,
            'birthday'=>$request->birthday,
            'role'=>$request->role,
            'status'=>$request->status,
        ]);
        return redirect()
        ->route('admin.users.index')
        ->with('success','Thêm người dùng thành công!!');
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
        $user=User::find($id);
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $user = User::find($id);
            if(!$user)
                return back()
            ->withInput()
            ->with('error','Người dùng không tồn tại');
            //Cập nhật
        $user->update([
             'fullname'=>$request->fullname,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>$request->password,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,
            'birthday'=>$request->birthday,
            'role'=>$request->role,
            'status'=>$request->status,
        ]);
        return redirect()
        ->route('admin.users.index')
        ->with('success','Sửa thông tin người dùng thành công!');
        
        }catch(\Exception $e)
        {
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
