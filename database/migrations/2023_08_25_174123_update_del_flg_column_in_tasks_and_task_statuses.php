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
        Schema::table('tasks_and_task_statuses', function (Blueprint $table) {
            Schema::table('tasks', function (Blueprint $table) {
                // del_flg カラムを論理削除用のカラムに変更
                $table->softDeletes();
                $table->dropColumn('del_flg');
            });
    
            Schema::table('task_statuses', function (Blueprint $table) {
                // del_flg カラムを論理削除用のカラムに変更
                $table->softDeletes();
                $table->dropColumn('del_flg');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // 論理削除用のカラムを元に戻す
            $table->dropSoftDeletes();
            $table->tinyInteger('del_flg')->default(0);
        });

        Schema::table('task_statuses', function (Blueprint $table) {
            // 論理削除用のカラムを元に戻す
            $table->dropSoftDeletes();
            $table->tinyInteger('del_flg')->default(0);
        });
    }
};
