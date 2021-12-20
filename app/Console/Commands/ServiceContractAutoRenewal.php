<?php

namespace App\Console\Commands;

use App\Models\ServiceContract;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ServiceContractAutoRenewal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service_contract_auto_renewal:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to check auto renewal service contract validity and auto renew the contract if the contract is finished.';

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
        //check auto renewal contract
        $auto_renewal_service_contract_list = ServiceContract::where('auto_renewal', 1)->get();
        
        foreach($auto_renewal_service_contract_list as $item)
        {
            $current_date = Carbon::now(); 
            $contract_start_date = Carbon::parse($item->contract_start_date);
            $contract_end_date = Carbon::parse($item->contract_end_date);
            

            $difference_in_days = $contract_start_date->diffInDays($contract_end_date);
            if($current_date->gt($contract_end_date))
            {
                // Close the old contract and make a new one
                $item->service_contract_status_code = 2;
                $item->save();

                $store = new ServiceContract();
                $store->Title = $item->Title;
                $store->description = $item->description;
                $store->amount = $item->amount;
                $store->frequency_of_pay = $item->frequency_of_pay;
                $store->image = $item->image;
                $store->auto_renewal = $item->auto_renewal;
                $store->contract_start_date = $current_date->format('Y-m-d');
            

                $store->contract_end_date = $current_date->addDays($difference_in_days)->format('Y-m-d');
                $store->service_contract_status_code = 1;

                $store->save();

            }
            
        }

        //close the contract that is not auto renewal
        $service_contract_list = ServiceContract::where('auto_renewal', 0)->get();
        foreach($service_contract_list as $item)
        {
            $current_date = Carbon::now(); 
            $contract_start_date = Carbon::parse($item->contract_start_date);
            $contract_end_date = Carbon::parse($item->contract_end_date);

            if($current_date->gt($contract_end_date))
            {
                // Close the contract
                $item->service_contract_status_code = 2;
                $item->save();
            }

        }
    }

   
    
    

}
