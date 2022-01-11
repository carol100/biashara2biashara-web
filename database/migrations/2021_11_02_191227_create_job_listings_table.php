<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->longText('description');
            $table->string('item_type')->nullable(); //product, service
            $table->string('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->longText('notes')->nullable();
            $table->string('attachment')->nullable();
            $table->boolean('is_negotiable')->default(false);
            $table->string('status')->default('pending'); // pending, submitted, interviewing, approved, ongoing, closed,
            $table->string('feedback')->nullable();
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
        Schema::dropIfExists('job_postings');
    }
}
