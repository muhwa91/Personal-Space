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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            // default : big_int, pk, auto_increment
            $table->string('password');
            // varchar 생성 / default : not null
            $table->string('email')->unique();
            // varchar 생성 / default : unique, not null
            $table->string('name', 50);
            // var_char(50) 생성 / default : not null
            $table->string('tel', 11)->unique();
            // var_char(11) 생성 / default : unique, not null
            $table->timestamp('email_verified_at')->nullable();
            // 이메일 인증 날짜, 시간 저장 / default : nullable
            $table->rememberToken();
            // 로그인 상태 유지 목적
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
        Schema::dropIfExists('user');
    }
};
