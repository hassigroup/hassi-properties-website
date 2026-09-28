<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('community_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('developer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('agent_id')->nullable()->constrained()->nullOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();

            $table->string('listing_type')->default('sale');   // sale | rent
            $table->string('category')->default('ready');      // off-plan | ready | international
            $table->string('status')->default('draft');        // draft | published | under-offer | sold | let

            $table->decimal('price', 15, 2)->default(0);
            $table->string('currency', 3)->default('AED');

            $table->unsignedSmallInteger('bedrooms')->nullable(); // 0 = studio
            $table->unsignedSmallInteger('bathrooms')->nullable();
            $table->decimal('size_sqft', 10, 2)->nullable();
            $table->string('floor')->nullable();
            $table->string('furnishing')->nullable();

            $table->string('reference_number')->nullable();
            $table->string('permit_number')->nullable(); // RERA advertising permit (Trakheesi)

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_description', 320)->nullable();

            $table->timestamps();

            $table->index(['status', 'category', 'listing_type']);
            $table->index('price');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
