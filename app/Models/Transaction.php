<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    protected $fillable = ['txn_no', 'student_id', 'book_id', 'date_borrowed', 'by', 'due_date', 'returned_at'];

    protected $casts = [
        'date_borrowed' => 'datetime',
        'due_date' => 'date',
        'returned_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the status of the transaction
     */
    public function getStatusAttribute(): string
    {
        if ($this->returned_at) {
            return 'Returned';
        }
        
        if ($this->due_date < Carbon::today()) {
            return 'Overdue';
        }
        
        return 'Active';
    }

    /**
     * Check if the transaction is still active (not returned)
     */
    public function isActive(): bool
    {
        return is_null($this->returned_at);
    }

    /**
     * Scope to get only active (non-returned) transactions
     */
    public function scopeActive($query)
    {
        return $query->whereNull('returned_at');
    }

    /**
     * Scope to get only returned transactions
     */
    public function scopeReturned($query)
    {
        return $query->whereNotNull('returned_at');
    }

    /**
     * Check if a student already has an active borrow for a specific book
     */
    public static function hasActiveBorrow(int $studentId, int $bookId, ?int $excludeTransactionId = null): bool
    {
        $query = self::where('student_id', $studentId)
            ->where('book_id', $bookId)
            ->whereNull('returned_at');
        
        if ($excludeTransactionId) {
            $query->where('id', '!=', $excludeTransactionId);
        }
        
        return $query->exists();
    }
}
