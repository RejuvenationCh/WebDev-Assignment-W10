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
        if (! Schema::hasTable('table_posts')) {
            Schema::create('table_posts', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('subtitle');
                $table->text('content');
                $table->string('image_path')->nullable();
                $table->boolean('is_published')->default(false)->index();
                $table->boolean('is_featured')->default(false);
                $table->timestamps();
            });
            return;
        }

        Schema::table('table_posts', function (Blueprint $table) {
            if (! Schema::hasColumn('table_posts', 'image_path')) {
                $table->string('image_path')->nullable();
            }
            if (! Schema::hasColumn('table_posts', 'is_published')) {
                $table->boolean('is_published')->default(false)->index();
            }
            if (! Schema::hasColumn('table_posts', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_posts');
    }
};
