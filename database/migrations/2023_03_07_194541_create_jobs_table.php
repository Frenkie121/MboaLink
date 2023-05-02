<?php

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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->constrained();
            $table->string('title');
            $table->string('slug');
            // $table->string('location');
            $table->text('description');
            $table->string('salary');
            $table->string('type');
            $table->date('dateline');
            $table->string('file')->nullable();
            $table->date('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
