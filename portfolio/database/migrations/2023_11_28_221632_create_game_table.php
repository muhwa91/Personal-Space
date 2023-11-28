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
        Schema::create('game', function (Blueprint $table) {
            $table->id('game_id');
            // default : big_int, pk, auto_increment
            $table->string('game_name', 30);
            // var_char(50) 생성 / default : not null
            $table->string('game_content', 50);
            // var_char(360) 생성 / default : not null
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
        Schema::dropIfExists('game');
    }
};
