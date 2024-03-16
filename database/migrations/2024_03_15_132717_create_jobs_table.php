<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_type_id')->constrained('job_types')->onDelete('cascade');


            $table->integer('vacancy');
            $table->string('salary')->nullable();
            $table->integer('location');
            $table->text('description')->nullable();
            $table->string('benefits')->nullable();
            $table->string('responsibility')->nullable();
            $table->string('qualifications')->nullable();
            $table->string('keywords')->nullable();
            $table->string('experience')->nullable();
            $table->string('company_name')->nullable();
            $table->string('website')->nullable();
            $table->string('company_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
