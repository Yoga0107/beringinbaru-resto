<?php

namespace App\Exports;

use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class OrdersExportExcel implements FromView
{
    public function view(): View
    {
        // dd(Order::join('detail_orders', 'detail_orders.order_id', '=', 'orders.id')
        //     ->select('orders.*', 'detail_orders.qty', 'detail_orders.subtotal')
        //     ->get());
        return view('admin.export.excel.orders', [
            'orders' => Order::all(),
            'detailOrders' => DetailOrder::all(),
            'total' => Order::sum('total'),
        ]);
    }
}
