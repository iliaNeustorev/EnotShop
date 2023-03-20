<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',256);
            $table->string('slug',128)->unique();
            $table->text('description')->nullable();
            $table->float('price', 8, 4);
            $table
                ->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->integer('count_store')->default(0);
            $table->integer('count_sold')->default(0);
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
