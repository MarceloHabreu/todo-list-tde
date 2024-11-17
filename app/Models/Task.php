<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'user_id',
        'category_name',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) \Illuminate\Support\Str::uuid();
        });
    }

    // Relação com o modelo User (uma tarefa pertence a um usuário).
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação com o modelo Category (uma tarefa pertence a uma categoria).
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // busca a categoria pelo nome
    public function getCategory()
    {
        return Category::where('name', $this->category_name)->first();
    }
}
