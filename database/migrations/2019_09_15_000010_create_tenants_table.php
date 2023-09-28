<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('bundle_id')->nullable();
            $table->foreign('bundle_id')->references('id')->on('bundles')->onDelete('set null')->onUpdate('set null');
            $table->boolean('active')->default(1);
            // your custom columns may go here

            $table->timestamps();
            $table->json('data')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
