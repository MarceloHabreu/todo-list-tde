<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        // recuperar o usuário autenticado
        $user = Auth::user();

        // Buscar apenas as categorias e tarefas do usuário logado!
        $categories = Category::where('user_id', $user->id)->get();
        $tasks = Task::where('user_id', $user->id)->get();

        return view('main.home', compact('categories', 'tasks'));
    }
}