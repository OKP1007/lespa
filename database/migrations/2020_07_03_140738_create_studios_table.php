<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('スタジオ名称');
            $table->string('post_number')->comment('郵便番号');
            $table->string('address_1')->comment('都道府県');
            $table->string('address_2')->comment('市区町村');
            $table->string('address_3')->comment('番地');
            $table->string('tel')->comment('電話番号');
            $table->string('url')->comment('URL');
            $table->text('note')->comment('備考');
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
        Schema::dropIfExists('studios');
    }
}
