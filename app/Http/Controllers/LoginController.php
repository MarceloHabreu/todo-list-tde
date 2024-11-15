<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'O campo email é obrigatório!',
            'email.email' => 'Email Inválido!',
            'password.required' => 'O campo senha é obrigatório!'
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['error' => 'Email ou senha inválidos!'])->withInput();
        }

        return redirect()->route('home')->with(['success' => 'Seja Bem-Vindo!']);
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('welcome')->with(['success' => 'Você saiu com sucesso!']);
    }
}