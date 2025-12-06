<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use App\Models\Student;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_categories' => Category::count(),
            'total_books' => Book::count(),
            'total_students' => Student::count(),
            'total_transactions' => Transaction::count(),
            'active_books' => Book::where('is_active', true)->count(),
            // Count transactions where due date has passed (including today if past midnight)
            'overdue_transactions' => Transaction::where('due_date', '<', Carbon::now())->count(),
        ];

        $recentTransactions = Transaction::with(['student', 'book'])
            ->latest()
            ->take(5)
            ->get();

        $recentBooks = Book::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentTransactions', 'recentBooks'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $results = [];
        
        \Log::info('Search query received: ' . $query);

        if (strlen($query) >= 2) {
            // Search Students
            $students = Student::where('lastname', 'like', "%{$query}%")
                ->orWhere('firstname', 'like', "%{$query}%")
                ->orWhere('middlename', 'like', "%{$query}%")
                ->orWhere('student_id', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('course', 'like', "%{$query}%")
                ->limit(5)
                ->get();

            foreach ($students as $student) {
                $results[] = [
                    'type' => 'Student',
                    'icon' => 'ri-user-line',
                    'title' => $student->full_name,
                    'subtitle' => $student->student_id . ' • ' . $student->course,
                    'url' => route('students.edit', $student->id),
                ];
            }

            // Search Books
            $books = Book::where('name', 'like', "%{$query}%")
                ->orWhere('author', 'like', "%{$query}%")
                ->orWhere('isbn', 'like', "%{$query}%")
                ->limit(5)
                ->get();

            foreach ($books as $book) {
                $results[] = [
                    'type' => 'Book',
                    'icon' => 'ri-book-2-line',
                    'title' => $book->name,
                    'subtitle' => 'by ' . $book->author,
                    'url' => route('books.edit', $book->id),
                ];
            }

            // Search Categories
            $categories = Category::where('name', 'like', "%{$query}%")
                ->limit(5)
                ->get();

            foreach ($categories as $category) {
                $results[] = [
                    'type' => 'Category',
                    'icon' => 'ri-folder-line',
                    'title' => $category->name,
                    'subtitle' => 'Category',
                    'url' => route('categories.edit', $category->id),
                ];
            }

            // Search Transactions
            $transactions = Transaction::with(['student', 'book'])
                ->whereHas('student', function($q) use ($query) {
                    $q->where('lastname', 'like', "%{$query}%")
                      ->orWhere('firstname', 'like', "%{$query}%");
                })
                ->orWhereHas('book', function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                })
                ->limit(5)
                ->get();

            foreach ($transactions as $transaction) {
                $results[] = [
                    'type' => 'Transaction',
                    'icon' => 'ri-exchange-line',
                    'title' => $transaction->book->name ?? 'Unknown Book',
                    'subtitle' => 'Borrowed by ' . ($transaction->student->full_name ?? 'Unknown'),
                    'url' => route('transactions.edit', $transaction->id),
                ];
            }

            // Also include navigation pages that match
            $pages = [
                ['name' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'ri-dashboard-line'],
                ['name' => 'Books', 'url' => route('books.index'), 'icon' => 'ri-book-2-line'],
                ['name' => 'Students', 'url' => route('students.index'), 'icon' => 'ri-user-line'],
                ['name' => 'Transactions', 'url' => route('transactions.index'), 'icon' => 'ri-exchange-line'],
                ['name' => 'Categories', 'url' => route('categories.index'), 'icon' => 'ri-folder-line'],
                ['name' => 'Profile Settings', 'url' => route('profile.edit'), 'icon' => 'ri-settings-3-line'],
            ];

            foreach ($pages as $page) {
                if (stripos($page['name'], $query) !== false) {
                    $results[] = [
                        'type' => 'Page',
                        'icon' => $page['icon'],
                        'title' => $page['name'],
                        'subtitle' => 'Navigate to ' . $page['name'],
                        'url' => $page['url'],
                    ];
                }
            }
        }

        return response()->json($results);
    }
}

