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
        'status_id',
        'user_id',
        'category_id',
    ];
    protected $casts = [
        'due_date' => 'date', // Converte automaticamente para instância de Carbon
    ];

    // Relacionamentos

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($task) {
            if (is_null($task->status_id)) {
                $task->status_id = 2; // ID do status 'Pendente'
            }
        });
    }
}