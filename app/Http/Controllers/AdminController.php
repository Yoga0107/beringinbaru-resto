<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Node\Query\OrExpr;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('authAdmin');
    }
    public function index()
    {
        $orders = Order::all();
        return view('admin.index')->with([
            'usersCount' => User::where('admin', 0)->count(),
            'sales' => Order::where('paid', 1)->count(),
            'reviews' => Comment::where('status', 1)->count(),
            'Earning' => Order::sum('total'),
            // sum total group by menu
            'SalesByMenus' => Order::join('detail_orders', 'orders.id', '=', 'detail_orders.order_id')
                ->join('menus', 'menus.id', '=', 'detail_orders.menu_id')
                ->select(DB::raw('sum(total) as total_quantity'), DB::raw('menus.title as menu_name'))
                ->groupBy('menu_name')
                ->get(),
            'OrdersCountByDate' => Order::select(
                DB::raw('count(id) as CountOrder'),
                DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as month_year")
            )
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))->get(),
        ]);
    }
}
