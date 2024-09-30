<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    // Allow mass assignment of these fields
    protected $fillable = ['book_id', 'title', 'content'];

    // Define relationship with Book model
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}


