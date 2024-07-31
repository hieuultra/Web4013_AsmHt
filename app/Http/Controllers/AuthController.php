<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function viewLogin()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('client.auth_backup.viewLogin', compact('categories'));
    }
    // public function viewLogin()
    // {
    //     $categories = Category::orderBy('name', 'asc')->get();
    //     return view('auth.login', compact('categories'));
    // }
    public function login(Request $request)
    {
        $accounts = $request->validate([
            'email' => ['required' => 'string', 'email', 'max:255'],
            'password' => ['required' => 'string']
        ]);
        //   dd($accounts);
        if (Auth::attempt($accounts)) {
            return redirect()->route('loginSuccess');
        }
        return redirect()->back()->withErrors([
            'email' => 'Infor account not found'
        ]);
    }
    public function loginSuccess()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('client.auth_backup.loginSuccess', compact('categories'));
    }
    public function account()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('client.auth_backup.account', compact('categories'));
    }
    public function viewEditAcc()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('client.auth_backup.editAcc', compact('categories'));
    }
    public function editAcc(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|max:255',
        ]);

        $id = $request->id;
        $user = User::findOrFail($id);
        // $user = Auth::user();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('upload'), $imageName);
            $validatedData['image'] = $imageName;
            // kiểm tra hình củ và xóa
            $oldImagePath = public_path('upload/' . $user->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        // Mã hóa mật khẩu nếu có
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            // Nếu không có mật khẩu mới, loại bỏ trường mật khẩu khỏi dữ liệu cập nhật
            unset($validatedData['password']);
        }

        // $user->update($validatedData);
        $user->update($validatedData);

        return redirect()->route('viewEditAcc')->with('success', 'Update acc successfully');
    }
    public function viewRegister()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('client.auth_backup.register', compact('categories'));
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Xử lý việc upload ảnh
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('upload'), $imageName);
            $data['image'] = $imageName;
        }

        // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
        // $data['password'] = bcrypt($data['password']);

        // Tạo người dùng mới
        $user = User::query()->create($data);

        // Đăng nhập người dùng sau khi đăng ký
        Auth::login($user);

        return redirect()->route('viewRegister');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('viewLogin');
    }
}
