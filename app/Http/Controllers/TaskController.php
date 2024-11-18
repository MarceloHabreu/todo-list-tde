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

        // trazendo apenas tarefas daquela categoria!
        $tasks = Task::where('user_id', $user)->when($category, function ($query) use ($category) {
            return $query->where('category_id', $category);
        })->get();

        // Obtendo a categoria utilizada 
        $usedCategory = Category::where('user_id', $user)->where('id', $category)->first();

        return view('main.tasks', ['tasks' => $tasks, 'category' => $usedCategory]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // recuperando todos os status
        $statusTasks = Status::orderBy('name', 'asc')->get();

        $user = Auth::id();
        //recuperando categorias daquele usuário
        $categories = Category::where('user_id', $user)->orderBy('name', 'asc')->get();

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
    public function show(Task $task)
    {

        return view('actions.task.show', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // recuperando todos os status
        $statusTasks = Status::orderBy('name', 'asc')->get();

        $user = Auth::id();
        //recuperando categorias daquele usuário
        $categories = Category::where('user_id', $user)->orderBy('name', 'asc')->get();

        return view('actions.task.edit', [
            'task' => $task,
            'statusTasks' => $statusTasks,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        // pegando a categoria atual antes de atualizar a atarefa
        $task = $this->task->find($id);
        $currentCategory = $task->category_id;

        // atualizando tarefa
        $updated = $this->task->where('id', $id)->update($request->except(['_token', '_method']));

        if ($updated) {
            return redirect()->route('tasks.index.category', ['category' => $currentCategory])->with('successfully', 'Tarefa atualizada com sucesso!');
        }
        return redirect()->route('tasks.index.category', ['category' => $currentCategory])->with('error', 'Houve erro ao atualizar a tarefa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // pegando a categoria atual antes de apagar a tarefa
        $task = $this->task->find($id);
        $currentCategory = $task->category_id;

        $removed = $this->task->where('id', $id)->delete();
        if ($removed) {
            return redirect()->route('tasks.index.category', ['category' => $currentCategory])->with('successfully', 'Tarefa excluida com sucesso!');
        }
        return redirect()->route('tasks.index.category', ['category' => $currentCategory])->with('error', 'Houve error ao exluir a tarefa!');
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