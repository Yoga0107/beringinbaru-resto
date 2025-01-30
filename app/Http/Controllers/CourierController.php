<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Courier;
use App\Models\Street;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function __construct()
    {
        $this->middleware('authAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $couriers = Courier::latest()->paginate(10);
        $courierCount = Courier::count();

        if (!empty($request->search)) {
            $courierSearch = Courier::where('name', 'like', "%{$request->search}%")->paginate(10);

            return view('admin.courier.index')->with([
                'couriers' => $courierSearch,
                'costCount' => $courierCount,
            ]);
        } else {
            return view('admin.courier.index')->with([
                'couriers' => $couriers,
                'courierCount' => $courierCount,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:couriers,name',
        ]);

        Courier::create([
            'name' => $request->name,
        ]);
        return redirect()->route('couriers.index')->with(['success' => 'Courier Added']);
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
        $courier = Courier::where('id', $id)->first();
        return view('admin.courier.edit')->with(['courier' => $courier]);
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
        $request->validate([
            'name' => 'required|unique:couriers,name',
        ]);
        $courier = Courier::where('id', $id)->first();
        $courier->update([
            'name' => $request->name,
        ]);
        return redirect()->route('couriers.index')->with(['success' => 'Courier Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courier = Courier::where('id', $id)->first();
        $courier->delete();
        return redirect()->route('couriers.index')->with(['success' => 'Courier Deleted']);
    }
}
