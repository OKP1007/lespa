<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgFilePathLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('img_file_path_1')->comment('画像ファイルパス_1')->after('outline');
            $table->string('img_file_path_2')->comment('画像ファイルパス_2')->after('img_file_path_1');
            $table->string('img_file_path_3')->comment('画像ファイルパス_3')->after('img_file_path_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('img_file_path_1');
            $table->dropColumn('img_file_path_2');
            $table->dropColumn('img_file_path_3');
        });
    }
}
