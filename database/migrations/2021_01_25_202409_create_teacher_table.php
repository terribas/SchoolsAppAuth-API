<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('school_id')->unsigned();
            
            $table->foreign('school_id')->references('id')
                    ->on('school')
                    ->onDelete('cascade');
                    
            $table->string('DNI', 15)->unique();
            $table->string('name', 35);
            $table->string('surname', 70);
            $table->string('phone', 15)->nullable();
            $table->float('wage', 8, 2)->nullable();
            $table->string('picture_url')->default('https://cdn.iconscout.com/icon/free/png-256/teaching-7-156277.png');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher');
    }
}
