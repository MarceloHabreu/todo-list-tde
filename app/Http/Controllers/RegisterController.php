<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'firstname.required' => 'O campo nome é obrigatório!',
            'firstname.string' => 'O campo nome deve ser uma string válida!',
            'lastname.required' => 'O campo sobrenome é obrigatório!',
            'lastname.string' => 'O campo sobrenome deve ser uma string válida!',
            'email.required' => 'O campo email é obrigatório!',
            'email.email' => 'Digite um email válido!',
            'email.unique' => 'Este email já está registrado!',
            'password.required' => 'O campo senha é obrigatório!',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres!',
            'password.confirmed' => 'As senhas não coincidem!'
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        Auth::login($user); // Realiza o login com o usuário recém-criado


        // Redirecionamento com mensagem de sucesso 
        return redirect()->route('home')->with('successfully', 'Usuário registrado e autenticado com sucesso!');
    }
}