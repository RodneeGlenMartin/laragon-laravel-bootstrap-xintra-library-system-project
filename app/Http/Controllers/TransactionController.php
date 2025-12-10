<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Student;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['student', 'book'])
            ->orderBy('date_borrowed', 'desc')
            ->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        
        // Get IDs of books that are currently borrowed (not returned)
        $borrowedBookIds = Transaction::whereNull('returned_at')
            ->pluck('book_id')
            ->toArray();
        
        // Only show books that are active AND not currently borrowed
        $books = Book::where('is_active', true)
            ->whereNotIn('id', $borrowedBookIds)
            ->get();
            
        return view('transactions.create', compact('students', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        // Check if student already has an active borrow for this book
        if (Transaction::hasActiveBorrow($request->student_id, $request->book_id)) {
            $student = Student::find($request->student_id);
            $book = Book::find($request->book_id);
            
            return redirect()->back()
                ->withInput()
                ->with('error', "Student {$student->full_name} already has an active borrow for \"{$book->name}\". The book must be returned first.");
        }

        Transaction::create([
            'txn_no' => 'TXN-' . strtoupper(Str::random(8)),
            'student_id' => $request->student_id,
            'book_id' => $request->book_id,
            'date_borrowed' => now(),
            'by' => auth()->user()->name,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $students = Student::all();
        $books = Book::where('is_active', true)->get();
        return view('transactions.edit', compact('transaction', 'students', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date',
        ]);

        // Check for duplicate active borrow (excluding current transaction)
        if (Transaction::hasActiveBorrow($request->student_id, $request->book_id, $transaction->id)) {
            $student = Student::find($request->student_id);
            $book = Book::find($request->book_id);
            
            return redirect()->back()
                ->withInput()
                ->with('error', "Student {$student->full_name} already has an active borrow for \"{$book->name}\".");
        }

        $transaction->update([
            'student_id' => $request->student_id,
            'book_id' => $request->book_id,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Mark a transaction as returned.
     */
    public function returnBook(Transaction $transaction)
    {
        if ($transaction->returned_at) {
            return redirect()->route('transactions.index')
                ->with('error', 'This book has already been returned.');
        }

        $transaction->update([
            'returned_at' => now(),
        ]);

        return redirect()->route('transactions.index')
            ->with('success', "Book \"{$transaction->book->name}\" has been returned successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
