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
        Schema::create('unemployeds', function (Blueprint $table) {
            $table->id();
            $table->string('diploma');
            $table->string('current_job')->nullable();
            $table->mediumText('aptitudes')->nullable();
            $table->mediumText('qualifications')->nullable();
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
        Schema::dropIfExists('unemployeds');
    }
};
