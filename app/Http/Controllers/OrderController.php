<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\DetailOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('authAdmin');
    }
    public function index(Request $request)
    {
        //
        if (!empty($request->search)) {
            return view('admin.orders.index')->with([
                'orders' => Order::where('id', 'like', "%{$request->search}%")
                    ->orWhere('total', 'like', "%{$request->search}%")
                    ->orWhere('paid', 'like', "%{$request->search}%")
                    ->paginate(6),
                'usersCount' => User::where('admin', 0)->count(),
                'sales' => Order::where('paid', 1)->count(),
                'ArchivedOrders' => Order::whereNotNull('deleted_at')->withTrashed()->count(),
                'Earning' => Order::sum('total'),
            ]);
        } else {
            return view('admin.orders.index')->with([
                'orders' => order::latest()->paginate(6),
                'usersCount' => User::where('admin', 0)->count(),
                'sales' => Order::where('paid', 1)->count(),
                'ArchivedOrders' => Order::whereNotNull('deleted_at')->withTrashed()->count(),
                'Earning' => Order::sum('total'),
            ]);
        }
    }
    public function getArchive()
    {
        return view('admin.orders.index')->with([
            'orders' => Order::whereNotNull('deleted_at')->withTrashed()->paginate(6),
            'usersCount' => User::where('admin', 0)->count(),
            'sales' => Order::where('paid', 1)->count(),
            'ArchivedOrders' => Order::whereNotNull('deleted_at')->withTrashed()->count(),
            'Earning' => Order::sum('total'),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, $id)
    {
        $request->validate([
            'input_courier' => 'required',
            'input_estimation' => 'required',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'delivery' => 1,
            'courier' => $request->input_courier,
            'estimation' => $request->input_estimation,
            'status' => 'delivery',
        ]);
        return redirect()->route('orders.index')->with(['success' => 'Delivery Status change Successfully']);
    }

    public function updateStatus($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'paid' => 1,
            'status' => 'success',
        ]);
        return redirect()->route('orders.index')->with(['success' => 'Delivery Status change Successfully']);
    }

    public function unarchive($id)
    {
        $order = Order::where('id', $id)->withTrashed()->first();
        $order->deleted_at = null;
        $order->save();
        return redirect()->route('orders.index')->with(['success' => 'Orderd Unarchived']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with(['success' => 'Orderd Deleted']);
    }
}
