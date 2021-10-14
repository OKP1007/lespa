<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('instructor_id')->index()->comment('インストラクターID');
            $table->integer('studio_id')->index()->comment('スタジオID');
            $table->integer('genre_id')->index()->comment('ジャンルID');
            $table->integer('level_id')->index()->comment('難易度ID');
            $table->integer('price')->index()->comment('金額');
            $table->timestamp('lesson_start_dt')->comment('レッスン開始日時');
            $table->timestamp('lesson_end_dt')->comment('レッスン終了日時');
            $table->timestamp('deadline_dt')->comment('申込み締め切り日時');
            $table->integer('capacity')->comment('人数制限');
            $table->text('outline')->comment('概要');
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
        Schema::dropIfExists('lessons');
    }
}
