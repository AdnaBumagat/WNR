<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to the user (author)
            $table->string('title');
            $table->text('description');
            $table->string('genre');
            $table->boolean('is_published')->default(false); // Indicates whether the book is published
            $table->boolean('is_approved')->default(false);  // Indicates whether the book is approved by admin
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('books');
    }
    
};
