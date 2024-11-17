<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public readonly Task $task;
    public function __construct()
    {
        $this->task = new Task();
    }

    /**
     * Display a listing of the resource.
     */
    public function index($category = null)
    {
        // pegando o id do usuário logado
        $user = Auth::id();

        $tasks = Task::where('user_id', $user)->when($category, function ($query) use ($category) {
            return $query->where('category_id', $category);
        })->get();
        return view('main.tasks', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // recuperando todos os status
        $statusTasks = Status::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();

        return view('actions.task.create', [
            'statusTasks' => $statusTasks,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:700',
            'due_date' => 'required',
            'status_id' => 'nullable|exists:status,id',
            'category_id' => 'required'
        ], [
            'title.required' => 'O campo titulo é obrigatório!',
            'title.string' => 'O campo titulo deve ser uma string válida!',
            'description.required' => 'Comente algo sobre sua tarefa no campo descrição!',
            'description.string' => 'O campo descrição deve ser uma string válida!',
            'due_date.required' => 'Coloque uma data limite!',
            'category_id.required' => 'Escolha uma categoria para sua tarefa!',
        ]);

        // criando tarefa
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->status_id = $request->input('status_id', 2);
        $task->category_id = $request->category_id;
        $task->user_id = Auth::id();

        $created = $task->save();

        if ($created) {
            return redirect()->route('home')->with('successfully', 'Tarefa criada com sucesso!');
        }
        return redirect()->route('home')->with('error', 'Houve erro ao criar a tarefa!');
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

    public function changeSituation(Task $task)
    {
        // Alternar entre os status, se estiver pendente vira em progresso, se estiver em progresso vira concluida!
        $nextStatus = $task->status_id == 1 ? 2 : ($task->status_id == 2 ? 3 : 1);

        // Atualizar somente o campo status_id
        $task->update(['status_id' => $nextStatus]);
        return redirect()->back()->with('successfully', 'Status da tarefa atualizado com sucesso!');
    }
}