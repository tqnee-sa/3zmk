<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AzmakSetting;
use App\Models\AzHistory;
use App\Models\AzSubscription;
use App\Models\AzCommissionHistory;
use App\Models\AzRestaurantCommission;
use App\Models\Restaurant\Azmak\AZUser;

class SettingController extends Controller
{
    public function setting()
    {
        $settings = AzmakSetting::first();
        return view('admin.settings.index' , compact('settings'));
    }
    public function setting_update(Request $request)
    {
        $settings = AzmakSetting::first();
        $this->validate($request , [
            'type'  => 'required',
            'subscription_amount'  => 'required',
            'online_payment_type'  => 'required',
            'online_token'  => 'required',
            'order_finished_days' => 'required',
        ]);
        $settings->update([
            'subscription_type'  => $request->type,
            'subscription_amount'  => $request->subscription_amount,
            'tax'  => $request->tax,
            'online_payment_type' => $request->online_payment_type,
            'online_token'  => $request->online_token,
            'order_finished_days'  => $request->order_finished_days,
        ]);
        flash(trans('messages.updated'))->success();
        return redirect()->back();
    }
    public function histories(Request $request)
    {
        $year = $request->year == null ? Carbon::now()->format('Y') : $request->year;
        $month = $request->month == null ? Carbon::now()->format('m') : $request->month;
        $histories = AzHistory::orderBy('id' , 'desc')
            ->whereyear('created_at','=',$year)
            ->whereMonth('created_at','=',$month)
            ->paginate(500);
        $month_total_amount = AzHistory::whereyear('created_at','=',$year)
            ->whereMonth('created_at','=',$month)
            ->sum('paid_amount');
        $tax_values = AzHistory::whereyear('created_at','=',$year)
            ->whereMonth('created_at','=',$month)
            ->sum('tax');
        $subscribed_restaurants = AzHistory::where('subscription_type' , 'new')
            ->whereyear('created_at','=',$year)
            ->whereMonth('created_at','=',$month)
            ->count();
        $renewed_restaurants = AzHistory::where('subscription_type' , 'renew')
            ->whereyear('created_at','=',$year)
            ->whereMonth('created_at','=',$month)
            ->count();
        return view('admin.settings.histories' , compact('histories','renewed_restaurants','subscribed_restaurants','tax_values','month_total_amount' , 'year' , 'month'));
    }
    public function delete_histories($id)
    {
        $AzHistory = AzHistory::findOrFail($id);
        $AzHistory->delete();
        flash(trans('messages.deleted'))->success();
        return redirect()->back();
    }
    public function commission_histories(Request $request)
    {
        $year = $request->year == null ? Carbon::now()->format('Y') : $request->year;
        $month = $request->month == null ? Carbon::now()->format('m') : $request->month;
        $histories = AzCommissionHistory::orderBy('id' , 'desc')
            ->whereyear('created_at','=',$year)
            ->whereMonth('created_at','=',$month)
            ->paginate(500);
        $month_total_amount = AzCommissionHistory::whereyear('created_at','=',$year)
            ->whereMonth('created_at','=',$month)
            ->sum('paid_amount');
        return view('admin.settings.commission_histories' , compact('histories','month_total_amount' , 'year' , 'month'));
    }
    public function delete_commission_history($id)
    {
        $AzHistory = AzCommissionHistory::findOrFail($id);
        // delete commission from restaurant
        AzRestaurantCommission::whereInvoiceId($AzHistory->invoice_id)
            ->orWhere('transfer_photo', $AzHistory->transfer_photo)
            ->delete();
        $AzHistory->delete();
        flash(trans('messages.deleted'))->success();
        return redirect()->back();
    }
    public function az_users()
    {
        $users = AZUser::paginate(500);
        return view('admin.users.index' , compact('users'));
    }
}
