<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAreaExamColumnLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('area')->comment('地域')->nullable()->after('instructor_id');
            $table->integer('least_count')->comment('最小決行人数')->nullable()->after('capacity');
            $table->boolean('is_online')->comment('オンラインレッスンフラグ')->nullable()->after('img_file_path_3');
            $table->string('url_token')->comment('URLトークン')->after('is_online');
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
            $table->dropColumn('area');
            $table->dropColumn('least_count');
            $table->dropColumn('is_online');
            $table->dropColumn('url_token');
        });
    }
}
