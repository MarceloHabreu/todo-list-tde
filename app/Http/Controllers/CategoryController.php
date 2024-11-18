<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public readonly Category $category;
    public function __construct()
    {
        $this->category = new Category();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('actions.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ], [
            'name.required' => 'O campo nome é obrigatório!',
            'name.string' => 'O campo nome deve ser uma string válida!',
            'description.required' => 'Comente algo sobre esta categoria no campo descrição!',
            'description.string' => 'O campo descrição deve ser uma string válida!',
        ]);

        // Criação da categoria
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->user_id = Auth::id();

        // Salvando a categoria
        $created = $category->save();

        if ($created) {
            return redirect()->route('home')->with('successfully', 'Categoria criada com sucesso!');
        }

        return redirect()->route('home')->with('error', 'Houve erro ao criar a categoria!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('actions.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $updated = $this->category->where('id', $id)->update($request->except(['_token', '_method']));

        if ($updated) {
            return redirect()->route('home')->with('successfully', 'Categoria atualizada com sucesso!');
        }
        return redirect()->route('home')->with('error', 'Houve erro ao atualizar a categoria!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $removed = $this->category->where('id', $id)->delete();
        if ($removed) {
            return redirect()->route('home')->with('successfully', 'Categoria removida com sucesso!');
        }
        return redirect()->route('home')->with('error', 'Categoria não excluida!');
    }
}