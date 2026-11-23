<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_links', function (Blueprint $table) {
            $table->id();
            $table->string('type', 16);
            $table->string('label');
            $table->string('destination');
            $table->string('icon')->nullable();
            $table->timestamps();

            $table->unique(['type', 'destination']);
        });
    }

};
