<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('job_listing_id')->nullable();
            $table->foreign('job_listing_id')->references('id')->on('job_listings');
            $table->string('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->longText('cover_letter')->nullable(); //proposal
            $table->string('attachment')->nullable(); //quote
            $table->string('status')->default('pending'); // pending, submitted, awarded, ongoing, closed,
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
        Schema::dropIfExists('job_applications');
    }
}
