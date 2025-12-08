<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name', 'isbn', 'author', 'category_id', 'is_active', 'date_added'];

    protected $casts = [
        'is_active' => 'boolean',
        'date_added' => 'datetime',
    ];

public function category() {
    return $this->belongsTo(Category::class);
}

public function transactions() {
    return $this->hasMany(Transaction::class);
}
}
