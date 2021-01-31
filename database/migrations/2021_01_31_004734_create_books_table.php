<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('author')->nullable();
            $table->string('genre')->nullable();
            $table->float('price')->nullable();
            $table->mediumText('summary')->nullable();
            $table->string('condition')->nullable();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->float('rating_sum')->default(0);
            $table->float('amount_sold')->default(0);
            $table->integer('amount_rates')->default(0);
            $table->integer('avg_rating')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
