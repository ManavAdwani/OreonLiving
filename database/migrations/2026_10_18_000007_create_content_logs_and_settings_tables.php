<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('status')->default('new')->index(); // new, contacted, resolved
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('homepage_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('button_text')->default('Explore Collection');
            $table->string('button_url')->default('/shop');
            $table->string('image_path');
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('category')->default('General');
            $table->string('question');
            $table->text('answer');
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('user_name')->nullable();
            $table->string('user_role')->nullable();
            $table->string('action'); // price_updated, stock_updated, product_created, order_status_updated, etc.
            $table->string('entity_type')->nullable(); // Product, Order, Category, etc.
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->string('entity_name')->nullable();
            $table->text('description');
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });

        Schema::create('pincodes', function (Blueprint $table) {
            $table->id();
            $table->string('pincode')->unique()->index();
            $table->string('city');
            $table->string('state');
            $table->boolean('is_serviceable')->default(true);
            $table->integer('estimated_days')->default(4);
            $table->boolean('cod_available')->default(true);
            $table->decimal('shipping_charge', 10, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_settings');
        Schema::dropIfExists('pincodes');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('homepage_banners');
        Schema::dropIfExists('contact_submissions');
    }
};
