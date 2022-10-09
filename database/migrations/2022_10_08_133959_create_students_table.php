<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('no_bp')->unique();
            $table->unsignedBigInteger('id_majors');
            $table->string('name', 50);
            $table->enum('gender', ['male', 'female']);
            $table->text('address');
            $table->enum('status', ['graduated', 'collage leave', 'active', 'inactive/drop out']);
            $table->timestamps();

            $table->foreign('id_majors')->references('id')->on('majors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
