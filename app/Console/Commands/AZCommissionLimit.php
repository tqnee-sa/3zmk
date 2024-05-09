<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Restaurant;
use App\Models\AzRestaurantCommission;

class AZCommissionLimit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'a_z_commission:limit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Azmak Restaurants Commission Limit';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info('check restaurant limit commissions');
        // get restaurant that have maximum_az_commission_limit
        $restaurants = Restaurant::whereNotNull('maximum_az_commission_limit')->get();
        foreach ($restaurants as $restaurant)
        {
            $required_commissions = $restaurant->az_orders->where('status' , '!=' , 'new')->sum('commission') - AzRestaurantCommission::whereRestaurantId($restaurant->id)->sum('commission_value');
            if ($required_commissions > $restaurant->maximum_az_commission_limit)
            {
                $restaurant->az_subscription->update([
                    'status' => 'commission_hold',
                ]);
            }
        }
    }
}
