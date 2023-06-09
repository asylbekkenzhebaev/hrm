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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fio');
            $table->date('birthday');

            $table->unsignedInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->cascadeOnUpdate()->nullOnDelete();

            $table->unsignedInteger('position_id')->nullable();
            $table->foreign('position_id')->references('id')->on('positions')->cascadeOnUpdate()->nullOnDelete();

            $table->unsignedInteger('gender_id')->nullable();
            $table->foreign('gender_id')->references('id')->on('genders')->cascadeOnUpdate()->nullOnDelete();

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
        Schema::dropIfExists('employees');
    }
};
