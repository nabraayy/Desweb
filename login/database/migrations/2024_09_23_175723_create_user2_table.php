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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('book',function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('tittle');
            $table->string('author');
            $table->string('type');
            $table->string('category');
            $table->boolean('available');
            $table-> integer('quantity');
            $table->integer('pages');
            $table->string('format_id')->foreingkey();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
