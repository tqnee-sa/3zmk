<style>
    .sidebar-title p,
    .sidebar-title a,
    .sidebar-title span {
        color: black !important;
        font-family: 'cairo' !important;
    }

    .sidebar-title * {
        color: black !important;
    }

    .brand-text {
        color: black;
        font-weight: 600;
        font-size: 1rem;
        font-family: 'cairo' !important;
    }

    .main-sidebar .nav-item {
        border-top: 1px solid #dfdfdf;
        padding: 3px 0;
        transition: all 0.3s linear;
    }

    .main-sidebar .nav-link:hover p {
        color: #960082;
    }

    .main-sidebar .nav-link:hover i {
        color: #960082;
    }

    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #960082;
        background-color: transparent !important;
    }

</style>
<!-- Main Sidebar Container -->
@php
    $employee = auth('employee')->user();
    $user = $employee->restaurant;
    $branch = $employee->branch;
@endphp
<aside class="main-sidebar  elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('employee.home') }}" class="brand-link">
        <img src="{{$user->az_logo ? asset('/uploads/restaurants/logo/' . $user->az_logo) : asset('/3azmkheader.jpg')}}" alt="AdminLTE Logo" class="brand-image"
             style="opacity: .8">

        <span class="brand-text font-weight-light"> @lang('messages.control_panel') </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- waiter --}}

                <li class="nav-item">
                    <a href="{{ route('employee.home') }}"
                       class="nav-link">
                        <i class="fas fa-home nav-icon"></i>
                        <p>
                            @lang('messages.home')
                        </p>
                    </a>
                </li>

                <li
                    class="nav-item has-treeview menu-open">
                    <a href="#"
                       class="nav-link {{ (isUrlActive('employee/azmak_orders/new') or
                            isUrlActive('employee/azmak_orders/active') or
                            isUrlActive('employee/azmak_orders/completed') or
                            isUrlActive('employee/azmak_orders/canceled') or
                            isUrlActive('employee/azmak_orders/finished'))
                                ? 'active'
                                : '' }}">
                        <i class="fas fa-shopping-cart"></i>
                        <p>
                            @lang('messages.az_orders')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('casher/azmak_orders/new') }}"
                               class="nav-link {{ Request::is('casher/azmak_orders/new') !== false ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <span class="badge badge-info right">
                                        {{ \App\Models\Restaurant\Azmak\AZOrder::whereStatus('new')->whereRestaurantId($user->type == 'employee' ? $user->restaurant_id : $user->id)->count() }}
                                    </span>
                                <p>
                                    @lang('messages.new_not_paid')
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('casher/azmak_orders/active') }}"
                               class="nav-link {{ strpos(URL::current(), '/casher/azmak_orders/active') !== false ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <span class="badge badge-info right">
                                        {{ \App\Models\Restaurant\Azmak\AZOrder::whereStatus('active')->whereRestaurantId($user->id)->whereBranchId($branch->id)->count() }}
                                    </span>
                                <p>
                                    @lang('messages.active')
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('casher/azmak_orders/completed') }}"
                               class="nav-link {{ Request::is('casher/azmak_orders/completed') !== false ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <span class="badge badge-info right">
                                        {{ \App\Models\Restaurant\Azmak\AZOrder::whereStatus('completed')->whereRestaurantId($user->id)->whereBranchId($branch->id)->count() }}
                                    </span>
                                <p>
                                    @lang('messages.completed')
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('casher/azmak_orders/canceled') }}"
                               class="nav-link {{ Request::is('casher/azmak_orders/canceled') !== false ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <span class="badge badge-info right">
                                        {{ \App\Models\Restaurant\Azmak\AZOrder::whereStatus('canceled')->whereRestaurantId($user->id)->whereBranchId($branch->id)->count() }}
                                    </span>
                                <p>
                                    @lang('messages.canceled')
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('casher/azmak_orders/finished') }}"
                               class="nav-link {{ Request::is('casher/azmak_orders/finished') !== false ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <span class="badge badge-info right">
                                        {{ \App\Models\Restaurant\Azmak\AZorder::whereStatus('finished')->whereRestaurantId($user->id)->whereBranchId($branch->id)->count() }}
                                    </span>
                                <p>
                                    @lang('messages.finished')
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('show_audios') }}"--}}
{{--                       class="nav-link {{ isUrlActive('show_audios') ? 'active' : '' }}">--}}
{{--                        <i class="fas fa-bell"></i>--}}
{{--                        <p>--}}
{{--                            @lang('messages.alarm_tones')--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
