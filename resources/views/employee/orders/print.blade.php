<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{  'Order ' . $order->id }}</title>
    <style>
        h1.title {
            font-size: 2.2rem;
            font-weight: bold;
            text-align: center;
        }

        table {
            width: 100%;
        }

        .table-header td {
            border: 1px solid #000;
            border-radius: 5px;
            padding: 10px;
            font-size: 2.2rem;
            font-weight: bold;
        }

        .table-header td:nth-child(event) {
            font-weight: normal;
        }

        .table-header td.header {
            width: 50%;
        }

        .table-product {
            margin-top: 80px;

        }

        .table-product th {
            border-bottom: 2px solid #000;
            text-align: right;
            padding: 10px;
            font-size: 1.5rem;
        }

        .table-product td {
            border-bottom: 1px solid #999999;
            padding: 5px;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .table-product .option td {
            font-size: 1.2rem !important;
            font-weight: normal;
            padding: 3px;

            border: 0px;
        }
        .table-product .option td:nth-child(1){
            padding-right: 20px;
        }

        .table-product .option.last-option td {
            border-bottom: 1px solid #999999;
        }

        .table-product .option-title {
            text-align: center;
            font-weight: bold;
        }

        .table-product .total td {
            font-size: 1.5rem;
            font-weight: bold;
            padding: 12px 5px;
            border-bottom: 2px solid #000 !important;
            border-top: 2px solid #000;
        }
        .rest .title{
            font-size:3rem;
            margin:0;

        }
        .rest .des{
            text-align: center;
            font-size:2rem;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="rest">
        <h1 class="title">{{$restaurant->name}}</h1>
        <p class="des">{{$restaurant->phone_number}}</p>
    </div>
    <h1 class="title"> {{ trans('dashboard.order_no') }} {{ $order->id }}</h1>
    <table class="table-header">
        <tbody>
            <tr>
                <td class="header">{{ trans('dashboard.entry.phone') }}</td>
                <td>{{ isset($order->user->id) ? $order->user->phone_number : '--' }}</td>
            </tr>
            <tr>
                <td class="header">{{ trans('dashboard.order_type') }}</td>
                <td>
                    @if ($order->type == 'previous')
                        {{ trans('dashboard._order_type.' . $order->type) }}
                        -
                        @if ($order->previous_type == 'delivery')
                            {{ app()->getLocale() == 'ar' ? 'ديلفري' : 'Delivery' }}
                        @else
                            {{ app()->getLocale() == 'ar' ? 'استلام من الفرع' : 'Takeaway' }}
                        @endif
                    @elseif ($order->type == 'delivery')
                        {{ app()->getLocale() == 'ar' ? 'ديلفري' : 'Delivery' }}
                    @elseif($order->type == 'takeaway')
                        {{ app()->getLocale() == 'ar' ? 'أستلام  من الفرع' : 'Takeaway' }}
                    @else
                        {{ $order->type }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="header">{{ trans('dashboard.order_status') }}</td>
                <td>
                    @if ($order->status == 'new')
                        {{ app()->getLocale() == 'ar' ? 'جديد' : 'New' }}
                    @elseif($order->status == 'active')
                        {{ app()->getLocale() == 'ar' ? 'جاري العمل علية' : 'Active' }}
                    @elseif($order->status == 'completed')
                        {{ app()->getLocale() == 'ar' ? 'مكتمل' : 'Completed' }}
                    @elseif($order->status == 'canceled')
                        {{ app()->getLocale() == 'ar' ? 'ملغي' : 'Canceled' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="header">@lang('messages.payment_type')</td>
                <td>
                    @if ($order->payment_method == 'receipt_payment')
                        {{ app()->getLocale() == 'ar' ? 'الدفع عند الأستلام' : 'Cash' }}
                    @elseif($order->payment_method == 'online_payment')
                        {{ app()->getLocale() == 'ar' ? 'دفع أونلاين' : 'Online Payment' }}
                        -
                        @if ($order->invoice_id == null)
                            {{ trans('dashboard.unpaid') }}
                        @else
                            {{ trans('dashboard.paid') }}
                        @endif
                    @elseif($order->payment_method == 'loyalty_point')
                        {{ trans('messages.' . $order->payment_method) }}
                    @else
                        {{ trans('dashboard.' . $order->payment_method) }}
                    @endif
                </td>
            </tr>

            @if ($order->tax != null)
                <tr>
                    <td>@lang('messages.tax')</td>
                    <td>
                        {{ $order->tax }}
                        {{ app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en }}
                    </td>
                </tr>
            @endif
            @if ($order->discount_value != null)
                <tr>
                    <td>@lang('messages.discount')</td>
                    <td>
                        {{ $order->discount_value }}
                        {{ app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en }}
                    </td>
                </tr>
            @endif
            @if ($order->delivery_value != null)
                <tr>
                    <td>@lang('messages.delivery_value')</td>
                    <td>
                        {{ $order->delivery_value }}
                        {{ app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en }}
                    </td>
                </tr>
            @endif
            <tr>
                <td>@lang('messages.order_value')</td>
                <td>
                    {{ $order->order_price }}
                    {{ app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en }}
                </td>
            </tr>
            <tr>
                <td>@lang('dashboard.entry.total_price')</td>
                <td>
                    @if ($order->delivery_value != null)
                        {{ $order->total_price + $order->delivery_value }}
                        {{ app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en }}
                    @else
                        {{ $order->total_price }}
                        {{ app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en }}
                    @endif
                </td>
            </tr>
            @if ($order->notes)
                <tr>
                    <td> @lang('messages.notes')</td>
                    <td>
                        {{ $order->notes }}
                    </td>
                </tr>
            @endif
            <tr>
                <td> {{ trans('dashboard.entry.created_at') }}</td>
                <td dir="ltr" style="text-align:right">
                    {{ date('Y-m-d h:i A' , strtotime($order->created_at)) }}
                </td>
            </tr>
            <tr>
                <td>الكاشير</td>
                <td  style="text-align:right">
                    {{auth('employee')->check() ? auth('employee')->user()->name : '--'}}
                </td>
            </tr>
        </tbody>
    </table>


    <table class="table-product">
        <thead>

        </thead>

        <tbody>
            <tr>
                <th >{{ trans('dashboard.entry.name') }}</th>
                <th >{{ trans('dashboard.product_count') }}</th>
                {{-- <th >{{ trans('dashboard.unit_price') }}</th> --}}
                <th >{{ trans('dashboard.entry.price') }}</th>
            </tr>
            @if ($order->order_items->count() > 0)
                @foreach ($order->order_items as $index => $item)
                    <tr class="product">

                        <td>{{ isset($item->product->name) ? $item->product->name : '' }}</td>
                        <td>{{ $item->product_count }}</td>
                        {{-- <td>{{ $item->product_count }}</td> --}}
                        <td> {{ $item->price }}
                            {{ app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en }}
                        </td>
                    </tr>
                    @if ($item->order_item_options->count() > 0)
                        <tr>
                            <td colspan="3" class="option-title">

                                @lang('messages.options')

                            </td>
                        </tr>
                        @foreach ($item->order_item_options as $k => $option)
                            <tr class="option {{ $k + 1 == count($item->order_item_options) ? 'last-option' : '' }}">

                                <td>{{ isset($option->option->id) ? $option->option->name : '--' }}
                                </td>
                                <td>{{ $option->option_count }}</td>
                                <td> {{ $option->option->price }}
                                    {{ app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach


                <tr class="total" style="background-color:#f0f0f0;">

                    <td colspan="2">{{ trans('dashboard.entry.total_price') }}</td>

                    {{-- <td>{{ $item->product_count }}</td> --}}
                    <td>
                        @if ($order->delivery_value != null)
                            {{ $order->total_price + $order->delivery_value }}
                            {{ app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en }}
                        @else
                            {{ $order->total_price }}
                            {{ app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en }}
                        @endif
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
