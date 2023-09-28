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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('title_fr')->nullable();
            $table->string('title_de')->nullable();
            $table->string('short_description_en')->nullable();
            $table->string('short_description_ar')->nullable();
            $table->string('short_description_fr')->nullable();
            $table->string('short_description_de')->nullable();
            $table->text('body_en');
            $table->text('body_ar');
            $table->text('body_fr')->nullable();
            $table->text('body_de')->nullable();
            $table->string('author');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('video_title')->nullable();
            $table->string('video_path')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('set null')->onUpdate('set null');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('set null');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
