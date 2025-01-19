<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Shipment;
use App\Models\Street;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $cartContent = \Cart::session($user->id)->getContent();
        $kecamatan = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/1278.json');

        return view('checkout.index')->with([
            'user' => $user,
            'items' => $cartContent,
            'itemsCount' => $cartContent->count(), // qte
            'kecamatan' => json_decode($kecamatan, true),
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->paymentMethod == 'e-transfer') {
            if ($request->has('receipt')) {
                $file = $request->receipt;
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/receipt'), $imageName);
                $request->receipt = $imageName;
            }
            $order = Order::create([
                'user_id' => $request->user_id,
                'street_id' => $request->street_id,
                'total' => $request->total,
                'cod' => false,
                'paid' => true,
                'receipt' => $request->receipt,
                'address' => $request->address,
                'status' => 'process',
            ]);
            $this->storeShipment($order->id, $request->street_id, $request->address);
            $this->storeDetailOrder($request->user_id, $order->id);
        } else if ($request->paymentMethod == 'cod') {
            $order = Order::create([
                'user_id' => $request->user_id,
                'street_id' => $request->street_id,
                'total' => $request->total,
                'cod' => true,
                'address' => $request->address,
                'status' => 'process',
            ]);
            $this->storeShipment($order->id, $request->street_id, $request->address);
            $this->storeDetailOrder($request->user_id, $order->id);
        }
        // hapus data cart
        \Cart::session($request->user_id)->Clear();

        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function storeShipment($orderId, $streetId, $address)
    {
        Shipment::create([
            'order_id' => $orderId,
            'street_id' => $streetId,
            'address' => $address,
        ]);
    }

    private function storeDetailOrder($userId, $orderId)
    {
        $menuOrders = \Cart::session($userId)->getContent();
        foreach ($menuOrders as $menu) {
            DetailOrder::create([
                'order_id' => $orderId,
                'menu_id' => $menu['id'],
                'qty' => $menu['quantity'],
                'subtotal' => $menu['price'] * $menu['quantity']
            ]);
        }
    }

    public function getStreet($villageId)
    {
        return Street::where('village_id', $villageId)->get();
    }

    public function getCost($streetId)
    {
        $street = Street::where('id', $streetId)->first();
        return Cost::where('id', $street->cost_id)->first();
    }
}
