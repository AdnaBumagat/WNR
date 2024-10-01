<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = ['book_id', 'title', 'content'];

    // Relationship: A chapter belongs to a book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
