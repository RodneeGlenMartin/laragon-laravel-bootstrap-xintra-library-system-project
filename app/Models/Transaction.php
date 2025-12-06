<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['txn_no', 'student_id', 'book_id', 'date_borrowed', 'by', 'due_date'];

    protected $casts = [
        'date_borrowed' => 'datetime',
        'due_date' => 'date',
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
