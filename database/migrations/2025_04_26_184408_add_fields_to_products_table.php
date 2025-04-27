<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('reference')->nullable();
            $table->string('group')->nullable();
            $table->string('brand')->nullable();
            $table->boolean('public')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('reference');
            $table->dropColumn('group');
            $table->dropColumn('brand');
            $table->dropColumn('public');
        });
    }
};
