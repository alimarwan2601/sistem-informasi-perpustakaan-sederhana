<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'member'])
            ->latest()
            ->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::orderBy('name')->get();
        $books = Book::where('stock', '>', 0)->orderBy('title')->get();

        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'books' => 'required|array|min:1',
            'books.*' => 'required|integer|min:0',
        ]);

        $selectedBooks = array_filter(
            $validated['books'],
            fn ($quantity) => (int) $quantity > 0
        );

        if (empty($selectedBooks)) {
            return back()->withInput()->withErrors([
                'books' => 'Pilih minimal satu buku untuk dipinjam.',
            ]);
        }

        $borrowing = DB::transaction(function () use ($validated, $selectedBooks) {
            $borrowing = Borrowing::create([
                'user_id' => auth()->id(),
                'member_id' => $validated['member_id'],
                'borrowed_at' => now()->toDateString(),
                'due_date' => now()->addDays(7)->toDateString(),
                'status' => 'borrowed',
            ]);

            $bookIds = array_keys($selectedBooks);
            sort($bookIds);

            foreach ($bookIds as $bookId) {
                $quantity = (int) $selectedBooks[$bookId];

                $book = Book::whereKey($bookId)
                    ->lockForUpdate()
                    ->first();

                if (!$book) {
                    throw ValidationException::withMessages([
                        'books' => 'Buku yang dipilih tidak ditemukan.',
                    ]);
                }

                if ($book->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'books' => "Stok buku {$book->title} tidak mencukupi. Stok tersedia: {$book->stock}.",
                    ]);
                }

                $borrowing->borrowingDetails()->create([
                    'book_id' => $book->id,
                    'quantity' => $quantity,
                ]);

                $book->decrement('stock', $quantity);
            }

            return $borrowing;
        });

        return redirect()->route('borrowings.show', $borrowing)
            ->with('success', 'Transaksi peminjaman berhasil disimpan.');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load([
            'user',
            'member',
            'borrowingDetails.book',
        ]);

        return view('borrowings.show', compact('borrowing'));
    }

    public function returnBook(Borrowing $borrowing)
    {
        DB::transaction(function () use ($borrowing) {
            $borrowing = Borrowing::whereKey($borrowing->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($borrowing->status !== 'borrowed') {
                throw ValidationException::withMessages([
                    'borrowing' => 'Pengembalian tidak dapat diproses karena status transaksi tidak valid.',
                ]);
            }

            $details = $borrowing->borrowingDetails()
                ->orderBy('book_id')
                ->get();

            foreach ($details as $detail) {
                $book = Book::whereKey($detail->book_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $book->increment('stock', $detail->quantity);
            }

            $borrowing->update([
                'returned_at' => now()->toDateString(),
                'status' => 'returned',
            ]);
        });

        return redirect()->route('borrowings.show', $borrowing)
            ->with('success', 'Buku berhasil dikembalikan dan stok telah diperbarui.');
    }
}