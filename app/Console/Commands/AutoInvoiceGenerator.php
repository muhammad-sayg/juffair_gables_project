<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Invoice;
use Illuminate\Console\Command;

class AutoInvoiceGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto_generate_invoice:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to generate auto invoice.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $invoices = Invoice::where('auto_generate', 'Yes')->get();
        
        foreach($invoices as $invoice)
        {
            $invoices_issue_date = Carbon::parse($invoice->invoice_issue_date);
            $invoice_end_date = $invoices_issue_date->addDays(30);
            
            $today_date = Carbon::now();

            if($today_date->gt($invoice_end_date))
            {
                $store = new Invoice();

                $store->tenant_id = $invoice->tenant_id;
                $store->invoice_issue_date = $today_date;
                $store->invoice_due_date = Carbon::parse($today_date)->addDays(5);
                $store->invoice_amount = $invoice->invoice_amount;
                $store->invoice_status_code = 1; //pending
                $store->auto_generate = "Yes";

                if($store->save())
                {
                    $store->invoice_number = 'INV-' . str_pad($store->id,3,0, STR_PAD_LEFT);
                    $store->save();
                }

            }
        }

    }
}
