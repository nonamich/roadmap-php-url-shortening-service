<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code')->unique();
            $table->string('link');
            $table->unsignedInteger('access_count')->default(0)->index();
            $table->string('session_id')->nullable()->index();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained(
                    table: 'users',
                    indexName: 'posts_user_id'
                )
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
