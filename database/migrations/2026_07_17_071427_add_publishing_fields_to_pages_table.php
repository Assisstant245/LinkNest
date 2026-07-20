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
    Schema::table('pages', function (Blueprint $table) {
        $table->string('slug')->nullable()->unique()->after('id');
        $table->string('custom_domain')->nullable()->unique()->after('slug');
        $table->timestamp('published_at')->nullable()->after('custom_domain');
    });
}

public function down(): void
{
    Schema::table('pages', function (Blueprint $table) {
        $table->dropColumn(['slug', 'custom_domain', 'published_at']);
    });
}
};
