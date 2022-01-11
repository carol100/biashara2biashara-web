<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('job_listing_id')->nullable();
            $table->foreign('job_listing_id')->references('id')->on('job_listings');
            $table->boolean('save_job')->default(false);
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
        Schema::dropIfExists('saved_jobs');
    }
}
