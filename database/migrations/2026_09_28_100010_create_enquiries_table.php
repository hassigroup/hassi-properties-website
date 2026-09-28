<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            $table->string('source')->default('contact-form');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('message')->nullable();
            $table->json('meta')->nullable();
            $table->string('zoho_lead_id')->nullable();
            $table->string('zoho_sync_status')->default('pending'); // pending | synced | failed
            $table->timestamp('zoho_synced_at')->nullable();
            $table->timestamps();

            $table->index('zoho_sync_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
