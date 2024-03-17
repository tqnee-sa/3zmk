<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AzSubscription;
use App\Models\AzHistory;

class BankTransferController extends Controller
{
    public function transfers()
    {
        $transfers = AzSubscription::whereNotNull('transfer_photo')
            ->wherePayment('false')
            ->get();
        return view('admin.settings.bank_transfers', compact('transfers'));
    }

    public function transfer_status($id, $status)
    {
        $subscription = AzSubscription::findOrFail($id);
        if ($status == 'confirm'):
            // store operation at history
            AzHistory::create([
                'restaurant_id' => $subscription->restaurant_id,
                'bank_id' => $subscription->bank_id,
                'seller_code_id' => $subscription->seller_code_id,
                'paid_amount' => $subscription->price,
                'discount' => $subscription->discount_value,
                'tax' => $subscription->tax_value,
                'transfer_photo' => $subscription->transfer_photo,
                'payment_type' => 'bank',
                'admin_id' => auth('admin')->user()->id,
                'subscription_type' => $subscription->status == 'finished' ? 'renew' : 'new',
                'details' => $subscription->status == 'finished' ? trans('messages.renew_subscription') : trans('messages.new_subscription'),
            ]);
            $subscription->update([
                'payment' => 'true',
                'status' => 'active',
                'end_at' => Carbon::now()->addYear(),
                'subscription_type' => $subscription->status == 'finished' ? 'renew' : 'new',
                'transfer_photo' => null,
            ]);
            flash(trans('messages.operationConfirmedSuccessfully'))->success();
        elseif ($status == 'cancel'):
            $subscription->update([
                'transfer_photo' => null,
            ]);
            flash(trans('messages.operationCanceledSuccessfully'))->success();
        endif;
        return redirect()->back();
    }
}
