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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            // Source identity / dedup key (e.g. LinkedIn job posting id).
            $table->string('external_id')->unique();
            $table->string('source')->default('linkedin');
            $table->string('search_label')->nullable();

            $table->string('title');
            $table->string('company_name');
            $table->string('location')->nullable();
            $table->string('url', 1024);
            $table->text('description')->nullable();
            $table->date('posted_date')->nullable();

            // Curation workflow, mirroring companies: pending | approved | rejected.
            $table->string('status')->default('pending');
            $table->text('admin_notes')->nullable();

            // Optional link to a curated company in the listing.
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamp('approved_at')->nullable();
            $table->timestamp('posted_to_slack_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
