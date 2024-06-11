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
        Schema::create('livestocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publisher_id')->constrained('users');
            $table->string('title');
            $table->string('description');
            $table->string('category');
            $table->string('breed_type');
            $table->integer('price');
            $table->integer('age');
            $table->integer('weight');
            $table->integer('quantity');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('livestocks', function (Blueprint $table) {
        $table->dropColumn('quantity');
    });
}
};
