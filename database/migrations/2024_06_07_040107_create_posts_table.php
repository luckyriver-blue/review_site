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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->char('myself', 1)->nullable();
            $table->foreignId('hospital_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->foreignId('hospital_department_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('disease',30)->nullable();
            $table->smallInteger('smooth_examination')->nullable();
            $table->smallInteger('smooth_hospitalization')->nullable();
            $table->tinyInteger('star')->nullable(false);
            $table->string('body',500)->nullable();
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
        Schema::dropIfExists('posts');
    }
};
