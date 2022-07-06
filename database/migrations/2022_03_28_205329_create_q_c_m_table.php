<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQCMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qcm', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->integer("validatedcount")->nullable();
            $table->dateTime("end_at")->nullable();
            $table->boolean("successfully")->default(false);
            $table->timestamps();
        });


        Schema::create('qcm_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('cqm_id');
            $table->boolean("successfully")->default(false);
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
        Schema::dropIfExists('qcm');
        Schema::dropIfExists('qcm_questions');
    }
}
