<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowFactory> */
    use HasFactory;

    protected $fillable = [
        'book_id',
        'borrower_id',
        'borrowed_at',
        'returned_at',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    protected function casts(): array
    {
        return [
            'borrowed_at' => 'datetime',
            'returned_at' => 'datetime',
        ];
    }
}
