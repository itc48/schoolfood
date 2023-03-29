<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_logs', function (Blueprint $table) {
            $table->id();

            $table->string('fingerprint', 255);

            $table->timestamp('date_time')->useCurrent();

            $table->float('longitude', 8, 6)->nullable();
            $table->float('latitude', 8, 6)->nullable();

            $table->uuid('review_uuid')->nullable();
            $table->foreign('review_uuid')->references('uuid')->on('reviews')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_logs', function (Blueprint $table) {
            //
        });
    }
}
