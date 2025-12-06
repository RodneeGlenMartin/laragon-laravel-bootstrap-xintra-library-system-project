<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'is_active', 'date_added'];

    protected $casts = [
        'is_active' => 'boolean',
        'date_added' => 'datetime',
    ];

    public function books() {
        return $this->hasMany(Book::class);
    }
}
