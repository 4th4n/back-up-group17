<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// class CreateItemsTable extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('items', function (Blueprint $table) {
//             $table->id();
//             $table->string('name'); // Para sa pangalan ng item
//             $table->decimal('price', 8, 2); // Para sa presyo ng item
//             $table->text('description')->nullable(); // Para sa paglalarawan (pwedeng walang laman)
//             $table->string('image')->nullable(); // Daan patungo sa imahe (pwedeng walang laman)
//             $table->integer('quantity')->default(1); // Quantity ng item
//             $table->timestamps();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('items');
//     }
// }



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Para sa pangalan ng item
            $table->decimal('price', 8, 2); // Para sa presyo ng item
            $table->text('description')->nullable(); // Para sa paglalarawan (pwedeng walang laman)
            $table->string('image')->nullable(); // Daan patungo sa imahe (pwedeng walang laman)
            $table->integer('quantity')->default(1); // Quantity ng item
            $table->string('category'); // Add category column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
}
