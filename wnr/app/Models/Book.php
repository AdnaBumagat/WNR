<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = ['user_id', 'title', 'description', 'genre', 'is_published', 'is_approved'];

    // Relationship: A book belongs to a user (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Add this to the existing Book model
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

}

