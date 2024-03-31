<?php

namespace App\Http\Controllers\EmployeeController\Order;

use App\Http\Controllers\Controller;
use App\Models\Restaurant\Azmak\AZOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request, $status = 'new')
    {
        $casher = auth('employee')->user();
        $restaurant = $casher->restaurant;
        $branch  = $casher->branch;
        $orders = AZorder::whereStatus($status)
            ->whereRestaurantId($restaurant->id)
            ->whereBranchId($branch->id)
            ->paginate(100);
        return view('employee.orders.index', compact('casher',  'restaurant', 'branch', 'orders', 'status'));
    }

    public function show($id)
    {
        $order = AZOrder::findOrFail($id);
        return view('employee.orders.show'  , compact('order'));
    }
    public function cancel(Request $request , $id)
    {
        $order = AZOrder::findOrFail($id);
        $this->validate($request , [
            'cancel_reason' => 'required',
        ]);
        $order->update([
            'status' => 'canceled',
            'cancel_reason' => $request->cancel_reason,
        ]);
        flash(trans('messages.orderCanceledSuccessfully'))->success();
        return redirect()->back();
    }
    public function complete_order(Request $request , $id)
    {
        $order = AZOrder::findOrFail($id);
        $this->validate($request , [
            'order_code' => 'required',
        ]);
        if ($order->order_code == $request->order_code)
        {
            $order->update([
                'status' => 'completed',
            ]);
            flash(trans('messages.orderCompletedSuccessfully'))->success();
            return redirect()->back();
        }else{
            flash(trans('messages.wrongOrderCode'))->error();
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        $order = AZOrder::findOrFail($id);
        $order->delete();
        flash(trans('messages.deleted'))->success();
        return redirect()->back();
    }

    public function show_audios()
    {
        return view('employee.audios');
    }
    public function store_audios(Request $request)
    {
        $this->validate($request, [
            'audio' => 'sometimes',
        ]);
        $employee = Auth::guard('employee')->user();
        $employee->update([
            'audio_name' => $request->audio,
        ]);
        flash(trans('messages.updated'))->success();
        return redirect()->back();
    }

    public function printOrder($id)
    {
        $employee = Auth::guard('employee')->user();
        $restaurant = $employee->restaurant;
        $order = Order::where('restaurant_id', $employee->restaurant_id)->findOrFail($id);
        // return view('employee.orders.print', compact('order', 'restaurant'));
        $pdf = \PDF::loadView('employee.orders.print', compact('order', 'restaurant'), [
            'title' => 'Order ' . $order->id,
            'mode' => 'utf-8',
            'format' => [190, 236],
            'orientation' => 'L'
        ]);

        return $pdf->stream('document.pdf');
    }

    public function report(Request $request){
        $request->validate([
            'year' => 'nullable|digits:4' ,
            'month' => 'nullable|digits:2' ,
        ]);
        $restaurant = auth('employee')->user()->restaurant;
        $branch =auth('employee')->user()->branch;
        if(!isset($restaurant->id)) return abort(501);
        $data = [
            'order_count' => [
                'today' => Order::where('restaurant_id' , $restaurant->id)->when(isset($branch->id) , function($query)use($branch){
                    $query->where('branch_id' , $branch->id);
                })->whereDate('created_at' , date('Y-m-d'))->count() ,
                'month' => Order::where('restaurant_id' , $restaurant->id)->when(isset($branch->id) , function($query)use($branch){
                    $query->where('branch_id' , $branch->id);
                })->whereDate('created_at' ,'>=' , date('Y-m') . '-01')->count() ,
                'total' => Order::where('restaurant_id' , $restaurant->id)->when(isset($branch->id) , function($query)use($branch){
                    $query->where('branch_id' , $branch->id);
                })->when(!empty($request->year ), function($query)use($request){
                    $query->where('created_at' , 'like' , '%'.$request->year.'%');
                    if(!empty($request->month)):
                        $query->where('created_at' , 'like' , '%'.$request->year.'-'.$request->month.'%');
                    endif;
                })->count() ,
            ],
            'income' => [
                'today' => Order::where('restaurant_id' , $restaurant->id)->when(isset($branch->id) , function($query)use($branch){
                    $query->where('branch_id' , $branch->id);
                })->whereDate('created_at' , date('Y-m-d'))->sum(DB::raw('total_price')) ,
                'month' => Order::where('restaurant_id' , $restaurant->id)->when(isset($branch->id) , function($query)use($branch){
                    $query->where('branch_id' , $branch->id);
                })->whereDate('created_at' ,'>=' , date('Y-m') . '-01')->sum(DB::raw('total_price')) ,
                'total' => Order::where('restaurant_id' , $restaurant->id)->when(isset($branch->id) , function($query)use($branch){
                    $query->where('branch_id' , $branch->id);
                })->when(!empty($request->year ), function($query)use($request){
                    $query->where('created_at' , 'like' , '%'.$request->year.'%');
                    if(!empty($request->month)):
                        $query->where('created_at' , 'like' , '%'.$request->year.'-'.$request->month.'%');
                    endif;
                })->sum(DB::raw('total_price')) ,
            ],
        ];

        return view('employee.orders.report' ,compact( 'data'));
    }
}
