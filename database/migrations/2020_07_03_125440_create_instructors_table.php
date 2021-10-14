<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('インストラクター名');
            $table->string('line_id')->comment('LINEID')->index();
            $table->string('gender')->comment('性別');
            $table->string('age')->comment('年齢');
            $table->text('introduction')->comment('自己紹介');
            $table->text('career')->comment('経歴');
            $table->string('twitter_id')->comment('ツイッターID');
            $table->string('instagram_id')->comment('インスタグラムID');
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
        Schema::dropIfExists('instructors');
    }
}
