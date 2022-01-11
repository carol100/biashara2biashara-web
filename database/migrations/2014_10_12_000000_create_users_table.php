<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('is_company')->default(false);
            $table->string('company_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number')->unique();
            $table->string('email')->unique();
            $table->string('physical_address')->nullable();
            $table->string('website')->nullable();
            $table->boolean('social_media_handles')->default(false);
            $table->string('facebook')->nullable(); //facebook, instagram, twitter //separate migration
            $table->string('instagram')->nullable(); //facebook, instagram, twitter //separate migration
            $table->string('twitter')->nullable(); //facebook, instagram, twitter //separate migration
            $table->string('other')->nullable(); //facebook, instagram, twitter //separate migration
            $table->string('business_type')->nullable(); //company, agency, individual,
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_registered')->nullable();
            $table->string('registration_date')->nullable();
            $table->string('registration_file')->nullable();
            $table->string('item_type')->nullable(); //1. Product 2. Service
            $table->string('item_description')->nullable();
            $table->string('rating')->nullable();
            $table->longText('notes')->nullable();
            $table->string('password');
            $table->boolean('account_verified')->default(false);
            $table->string('verification_token')->nullable();
            $table->boolean('enabled')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
