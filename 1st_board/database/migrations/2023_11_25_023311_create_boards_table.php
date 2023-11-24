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
        Schema::create('boards', function (Blueprint $table) { // 컬럼 세팅
            $table->id('d_id');
            // default : big_int, pk, auto_increment / id('컬럼명') 변경 가능
            $table->string('d_title', 30);
            // var_char(30) 생성 / default : not null 
            // cf)null 허용하고 싶을 때 ->nullable();
            $table->string('d_content', 2000);
            // var_char(2000) 생성 / default : not null
            $table->integer('d_hits')->default(0);
            // 조회수, int default 0으로 세팅
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
        Schema::dropIfExists('boards');
    }
};
