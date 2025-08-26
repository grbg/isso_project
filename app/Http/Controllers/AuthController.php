<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|min:10',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Создание пользователя и авторизация
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        $user->sendEmailVerificationNotification();

        return response()->json(['status' => 'verification_required']);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['errors' => ['email' => ['Неверные учетные данные']]], 422);
        }

        return response()->json(['redirect' => route('home')]);
    }

    // Выход пользователя
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/auth-toggle'); // возвращаемся на страницу с формой
    }

    public function updatePhone(Request $request)
    {
        $request->validate(['phone' => 'required|string|max:255']);
        $request->user()->update(['phone' => $request->phone]);

        return response()->json(['success' => true, 'message' => 'Телефон обновлён']);
    }

    public function updateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|max:255']);
        $request->user()->update(['email' => $request->email]);

        return response()->json(['success' => true, 'message' => 'Почта обновлена']);
    }

    public function updatePassword(Request $request)
    {
        $request->validate(['password' => 'required|min:8']);
        $request->user()->update(['password' => bcrypt($request->password)]);

        return response()->json(['success' => true, 'message' => 'Пароль обновлён']);
    }

}
