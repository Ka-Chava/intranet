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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->text('description')->nullable()->default(null);
            $table->longText('content')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);

            $table->foreignIdFor(\App\Models\User::class)
                ->constrained()
                ->nullOnDelete()
                ->nullOnUpdate();

            $table->foreignIdFor(\App\Models\Author::class)
                ->constrained()
                ->nullOnDelete()
                ->nullOnUpdate();

            $table->foreignIdFor(\App\Models\Blog::class)
                ->constrained()
                ->nullOnDelete()
                ->nullOnUpdate();

            $table->timestamp('published_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
