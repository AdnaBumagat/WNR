<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'genre', 'image', 'is_approved', 'featured'
    ];

    // Relationship with User (Author)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Chapters
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
