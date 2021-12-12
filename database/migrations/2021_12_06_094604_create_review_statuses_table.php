<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_statuses', function (Blueprint $table) {
            $table->integer('review_status_id');
            $table->string('review_status_name');
            $table->integer('review_status_code');
        });
         // Insert Pre-populated Table Values
         DB::table('review_statuses')->insert(array('review_status_id' => '1',
         'review_status_name' => 'Public',
         'review_status_code' => '1'));

         DB::table('review_statuses')->insert(array('review_status_id' => '2',
             'review_status_name' => 'Private',
             'review_status_code' => '2'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_statuses');
    }
}
