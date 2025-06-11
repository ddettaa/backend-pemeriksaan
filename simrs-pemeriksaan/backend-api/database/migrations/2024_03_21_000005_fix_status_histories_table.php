<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('status_histories', function (Blueprint $table) {
            // Drop existing foreign key and index
            $table->dropForeign(['no_reg']);
            $table->dropIndex(['no_reg', 'created_at']);
            
            // Drop and recreate column with correct type
            $table->dropColumn('no_reg');
            $table->smallInteger('no_registrasi');
            
            // Add back foreign key and index
            $table->foreign('no_registrasi')
                  ->references('no_reg')
                  ->on('pasien')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->index(['no_registrasi', 'created_at']);
        });
    }

    public function down()
    {
        Schema::table('status_histories', function (Blueprint $table) {
            // Drop foreign key and index
            $table->dropForeign(['no_registrasi']);
            $table->dropIndex(['no_registrasi', 'created_at']);
            
            // Drop and recreate column with original type
            $table->dropColumn('no_registrasi');
            $table->string('no_reg');
            
            // Add back original foreign key and index
            $table->foreign('no_reg')
                  ->references('no_reg')
                  ->on('pasien')
                  ->onDelete('cascade');
                  
            $table->index(['no_reg', 'created_at']);
        });
    }
}; 