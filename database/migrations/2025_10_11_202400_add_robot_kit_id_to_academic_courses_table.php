<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('academic_courses', function (Blueprint $table) {
            $table->foreignId('robot_kit_id')
                  ->nullable()
                  ->constrained('robot_kits')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('academic_courses', function (Blueprint $table) {
            $table->dropForeign(['robot_kit_id']);
            $table->dropColumn('robot_kit_id');
        });
    }
};