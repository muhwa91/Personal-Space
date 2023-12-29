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
        Schema::create('community_board', function (Blueprint $table) {
            $table->id('community_id');
            $table->integer('user_id');
            $table->string('community_content', 500);
            // var_char(2000) 생성 / default : not null
            $table->timestamps();
            // created_at, updated_at 라라벨 내부 설정 값으로 자동생성
            // default : null(라라벨 내부 설정 값)
            $table->softDeletes();
            // deleted_at / default : nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_board');
    }
};
