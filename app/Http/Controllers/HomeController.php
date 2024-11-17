<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index($category = null)
    {

        // recuperar o usuário autenticado
        $user = Auth::user();

        // Buscar apenas as categorias e tarefas do usuário logado!
        $categories = Category::where('user_id', $user->id)->get();

        // se uma categoria for selecionada, busca todas as tasks daquela categoria
        if ($category) {
            $tasks = Task::where('user_id', $user->id)->where('category_id', $category)->get();
        } else {
            // busca todas as tarefas normalmente daquele usuário e traz
            $tasks = Task::where('user_id', $user->id)->get();
        }
        $tasks = Task::where('user_id', $user->id)->get();

        return view('main.home', compact('categories', 'tasks'));
    }
}