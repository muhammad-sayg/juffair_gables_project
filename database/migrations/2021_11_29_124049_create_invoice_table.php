<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();
            $table->integer('tenant_id');
            $table->dateTime('invoice_issue_date');
            $table->dateTime('invoice_due_date');
            $table->decimal('invoice_amount',15);
            $table->decimal('rent_amount',15);
            $table->decimal('security_deposit',15);
            $table->decimal('ewa_charges',15);
            $table->string('auto_generate')->default("No");
            // $table->decimal('paid_amount',15)->nullable();
            // $table->decimal('due_amount',15)->nullable();
            // $table->dateTime('rent_paid_date');
            $table->integer('invoice_status_code');
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
        Schema::dropIfExists('invoice');
    }
}
