<?php

namespace App\Http\Controllers\RestaurantController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\AzRestaurantCommission;
use App\Models\Restaurant\Azmak\AZOrder;

class RestaurantAZCommissionController extends Controller
{
    public function commissions_history($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $histories = $restaurant->az_commissions()->paginate(100);
        return view('restaurant.commission.commission_history' , compact('restaurant' , 'histories'));
    }
    public function add_commissions_history($id){
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurant.commission.create_commission_history' , compact('restaurant'));
    }

    public function store_commissions_history(Request $request , $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $this->validate($request , [
            'commission_value' => 'required|numeric',
            'transfer_photo'   => 'required|mimes:jpg,jpeg,png,gif,tif,psd,webp,bmp|max:5000',
        ]);

        // add new commission
        AzRestaurantCommission::create([
            'restaurant_id'     => $restaurant->id,
            'commission_value'  => $request->commission_value,
            'transfer_photo'    => UploadImage($request->file('transfer_photo'), 'photo', '/uploads/commissions_transfers'),
        ]);
        $required_commissions = $restaurant->az_orders->where('status' , '!=' , 'new')->sum('commission') - $restaurant->az_commissions->sum('commission_value');
        if ($required_commissions < $restaurant->maximum_az_commission_limit)
        {
            $restaurant->az_subscription->update([
                'status' => 'active',
            ]);
        }
        flash(trans('messages.created'))->success();
        return redirect()->route('RestaurantAzCommissionsHistory' , $restaurant->id);
    }
    public function delete_commissions_history($id)
    {
        $history = AzRestaurantCommission::findOrFail($id);
        $restaurant = $history->restaurant;
        @unlink(public_path('/uploads/commissions_transfers/' . $history->transfer_photo));
        $history->delete();
        $required_commissions = $restaurant->az_orders->where('status' , '!=' , 'new')->sum('commission') - $restaurant->az_commissions->sum('commission_value');
        if ($required_commissions > $restaurant->maximum_az_commission_limit)
        {
            $restaurant->az_subscription->update([
                'status' => 'commission_hold',
            ]);
        }
        flash(trans('messages.deleted'))->success();
        return redirect()->back();
    }
}
