<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();

        $totalStock = Book::sum('stock');

        $totalMembers = Member::count();

        $activeBorrowings = Borrowing::where(
            'status',
            'borrowed'
        )->count();

        return view('dashboard', compact(
            'totalBooks',
            'totalStock',
            'totalMembers',
            'activeBorrowings'
        ));
    }
}
