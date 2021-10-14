<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyImgFilePathLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('img_file_path_1')->nullable()->comment('画像ファイルパス_1')->after('outline')->change();
            $table->string('img_file_path_2')->nullable()->comment('画像ファイルパス_2')->after('img_file_path_1')->change();
            $table->string('img_file_path_3')->nullable()->comment('画像ファイルパス_3')->after('img_file_path_2')->change();
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
            $table->string('img_file_path_1')->comment('画像ファイルパス_1')->after('outline')->change();
            $table->string('img_file_path_2')->comment('画像ファイルパス_2')->after('img_file_path_1')->change();
            $table->string('img_file_path_3')->comment('画像ファイルパス_3')->after('img_file_path_2')->change();
        });
    }
}
