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
        return view('actions.category.category_create');
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
        ]);

        // Criação da categoria
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->user_id = Auth::id();

        // Salvando a categoria
        $created = $category->save();

        if ($created) {
            return redirect()->route('home')->with('message', 'Categoria criada com sucesso!');
        }

        return redirect()->route('home')->with('message', 'Houve erro ao criar a categoria!');
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
}
