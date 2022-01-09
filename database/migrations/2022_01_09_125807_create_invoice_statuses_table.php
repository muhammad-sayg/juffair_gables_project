<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_statuses', function (Blueprint $table) {
            $table->integer('invoice_status_id');
            $table->string('invoice_status_name');
            $table->integer('invoice_status_code');
        });

         // Insert Pre-populated Table Values
         DB::table('invoice_statuses')->insert(array('invoice_status_id' => '1',
         'invoice_status_name' => 'Pending',
         'invoice_status_code' => '1'));

         DB::table('invoice_statuses')->insert(array('invoice_status_id' => '2',
                    'invoice_status_name' => 'Closed',
                    'invoice_status_code' => '2'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_statuses');
    }
}
