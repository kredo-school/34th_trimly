<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('salon_codes', function (Blueprint $table) {
            // 外部キーを一時的に削除
            $table->dropForeign(['salon_code']);

            // 既存の UNIQUE 制約を削除
            $table->dropUnique('salon_codes_salon_code_unique');

            // 複合 UNIQUE 制約を追加
            $table->unique(['petowner_id', 'salon_code']);

            // 外部キーを再作成
            $table->foreign('salon_code')->references('salon_code')->on('salons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salon_codes', function (Blueprint $table) {
            // 外部キーを一時的に削除
            $table->dropForeign(['salon_code']);

            // 複合 UNIQUE を削除
            $table->dropUnique(['petowner_id', 'salon_code']);

            // 元の UNIQUE 制約を復活
            $table->unique('salon_code');

            // 外部キーを再作成
            $table->foreign('salon_code')->references('salon_code')->on('salons')->onDelete('cascade');
        });
    }
};
