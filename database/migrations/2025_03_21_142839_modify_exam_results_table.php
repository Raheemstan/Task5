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
        Schema::table('exam_results', function (Blueprint $table) {
            $table->dropColumn('is_remedial');
            $table->float('passing_score')->default(50);
            $table->string('grade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_results', function (Blueprint $table) {
            $table->boolean('is_remedial')->default(false);
            $table->dropColumn('passing_score');
            $table->dropColumn('grade');
        });
    }
};
