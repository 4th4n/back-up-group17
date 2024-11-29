
<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('orders', function (Blueprint $table) {
//             $table->id(); // Primary key for the order
//             $table->decimal('total_price', 8, 2)->default(0); // Total price of the order
//             $table->timestamps(); // created_at and updated_at timestamps
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('orders'); // Drops the orders table
//     }
// };


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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key for the order
            $table->decimal('total_price', 8, 2)->default(0); // Total price of the order
            $table->boolean('completed')->default(false); // Add 'completed' column
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders'); // Drops the orders table
    }
};
