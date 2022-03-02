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
            $table->boolean('is_blocked');
            $table->string('name',50);
            $table->string('lastname',50);
            $table->string('document',8);
            $table->string('code',9);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['document', 'deleted_at']);
            $table->unique(['code', 'deleted_at']);
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
