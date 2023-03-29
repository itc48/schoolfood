<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->foreignUuid('school_uuid');
            $table->foreign('school_uuid')->references('uuid')->on('schools')->onDelete('cascade');

            $table->text('text')->nullable();
            $table->string('file', 255)->nullable();

            $table->string('fingerprint', 255);
            $table->tinyInteger('score');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reviews');
    }
}
