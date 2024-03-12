<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
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
}
