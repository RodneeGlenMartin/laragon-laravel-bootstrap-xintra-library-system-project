<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_id', 'lastname', 'firstname', 'middlename', 'email', 'course', 'year_level'];

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function getFullNameAttribute() {
        return "{$this->lastname}, {$this->firstname} {$this->middlename}";
    }
}
