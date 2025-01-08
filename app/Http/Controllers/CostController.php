<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCostRequest;
use App\Models\Cost;
use App\Models\Street;
use Illuminate\Http\Request;

class CostController extends Controller
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
        $cost = Cost::latest()->paginate(10);
        $costCount = Cost::count();
        $streetCount = Street::count();

        if (!empty($request->search)) {
            $costSearch = Cost::where('cost', 'like', "%{$request->search}%")->paginate(10);

            return view('admin.costs.index')->with([
                'costs' => $costSearch,
                'costCount' => $costCount,
                'streetCount' => $streetCount,
            ]);
        } else {
            return view('admin.costs.index')->with([
                'costs' => $cost,
                'costCount' => $costCount,
                'streetCount' => $streetCount,
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
        return view('admin.costs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCostRequest $request)
    {
        $request->validate([
            'cost' => 'required|numeric|unique:costs,cost',
        ]);

        Cost::create([
            'cost' => $request->cost,
        ]);
        return redirect()->route('cost.index')->with(['success' => 'Cost Added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function show(Cost $cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cost = Cost::where('id', $id)->first();
        return view('admin.costs.edit')->with(['cost' => $cost]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cost' => 'required|numeric|unique:costs,cost',
        ]);
        $cost = Cost::where('id', $id)->first();
        $cost->update([
            'cost' => $request->cost,
        ]);
        return redirect()->route('cost.index')->with(['success' => 'Cost Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cost = Cost::where('id', $id)->first();
        $cost->delete();
        return redirect()->route('cost.index')->with(['success' => 'Cost Deleted']);
    }
}
