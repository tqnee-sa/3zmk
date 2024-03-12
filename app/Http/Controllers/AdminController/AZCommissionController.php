<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\AzRestaurantCommission;
use App\Models\Restaurant\Azmak\AZOrder;

class AZCommissionController extends Controller
{
    public function restaurant_commissions($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $orders_commissions = $restaurant->az_orders->where('status' , '!=' , 'new')->sum('commission');
        $restaurant_commissions = $restaurant->az_commissions->sum('commission_value');
        return view('admin.commission.index' , compact('restaurant' , 'orders_commissions' , 'restaurant_commissions'));
    }

    public function restaurant_az_orders($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $orders = $restaurant->az_orders()->where('status' , '!=' , 'new')->paginate(500);
        return view('admin.commission.orders' , compact('restaurant' , 'orders'));
    }

    public function show_order($id)
    {
        $order = AZOrder::findOrFail($id);
        return view('admin.commission.show_order'  , compact('order'));
    }

    public function commissions_history($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $histories = $restaurant->az_commissions()->paginate(100);
        return view('admin.commission.commission_history' , compact('restaurant' , 'histories'));
    }
    public function add_commissions_history($id){
        $restaurant = Restaurant::findOrFail($id);
        return view('admin.commission.create_commission_history' , compact('restaurant'));
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
            'admin_id'          => auth('admin')->user()->id,
            'commission_value'  => $request->commission_value,
            'transfer_photo'    => UploadImage($request->file('transfer_photo'), 'photo', '/uploads/commissions_transfers'),
        ]);
        flash(trans('messages.created'))->success();
        return redirect()->route('AzRestaurantCommissionsHistory' , $restaurant->id);
    }
    public function delete_commissions_history($id)
    {
        $history = AzRestaurantCommission::findOrFail($id);
        @unlink(public_path('/uploads/commissions_transfers/' . $history->transfer_photo));
        $history->delete();
        flash(trans('messages.deleted'))->success();
        return redirect()->back();
    }
}
