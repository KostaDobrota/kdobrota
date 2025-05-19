<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Kategorija masline
            $table->string('name'); // Naziv proizvoda
            $table->string('slug')->unique(); // URL-friendly naziv
            $table->text('description'); // Opis proizvoda
            $table->decimal('price', 10, 2); // Cena
            $table->string('image_path')->nullable(); // Putanja do slike
            $table->boolean('is_featured')->default(false); // Da li je proizvod istaknut
            $table->integer('stock')->default(0); // Stanje na zalihama
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
