<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('job_listing_id')->nullable();
            $table->foreign('job_listing_id')->references('id')->on('job_listings');
            $table->string('job_application_id')->nullable();
            $table->foreign('job_application_id')->references('id')->on('job_applications');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('job_application_media');
    }
}
