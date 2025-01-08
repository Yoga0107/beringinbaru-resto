<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Street;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $streetsCount = Street::count();
        $costs = Cost::all();
        $costsCount = Cost::count();

        if (!empty($request->search)) {
            $streetsSearch = Street::leftjoin('costs', 'streets.cost_id', '=', 'costs.id')
                ->where('street', 'like', "%{$request->search}%")
                ->orWhere('id', 'like', "%{$request->search}%")
                ->orWhere('cost', 'like', "%{$request->search}%")
                ->select('streets.*', 'costs.cost')
                ->paginate(6);

            return view('admin.Street.index')->with([
                'streets' => $streetsSearch,
                'costs' => $costs,
                'streetsCount' => $streetsCount,
                'costsCount' => $costsCount,
            ]);
        } else {
            $streets = Street::leftjoin('costs', 'streets.cost_id', '=', 'costs.id')
                ->latest()
                ->select('streets.*', 'costs.cost')
                ->paginate(6);

            return view('admin.Street.index')->with([
                'streets' => $streets,
                'costs' => $costs,
                'streetsCount' => $streetsCount,
                'costsCount' => $costsCount,
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
        $costs = Cost::all();
        $districts = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/1278.json');

        return view('admin.Street.create')->with([
            'districts' => json_decode($districts, true),
            'costs' => $costs,
        ]);
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
            'district_id' => 'required|numeric',
            'village_id' => 'required|numeric',
            'street' => 'required|min:3|max:20|unique:streets,street',
            'cost_id' => 'required|numeric',
        ]);

        Street::create([
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'street' => $request->street,
            'cost_id' => $request->cost_id,
        ]);

        return redirect()->route('street.index')->with(['success' => 'Street Added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function show(Street $street)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $street = Street::where('id', $id)->first();
        $costs = Cost::all();
        $districts = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/1278.json');
        $villages = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/villages/' . $street->district_id .  '.json');

        return view('admin.Street.edit')->with([
            'street' => $street,
            'districts' => json_decode($districts, true),
            'villages' => json_decode($villages, true),
            'costs' => $costs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'district_id' => 'required|numeric',
            'village_id' => 'required|numeric',
            'street' => 'required|min:3|max:20|unique:streets,street',
            'cost_id' => 'required|numeric',
        ]);

        $street = Street::where('id', $id)->first();
        $street->update([
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'street' => $request->street,
            'cost_id' => $request->cost_id,
        ]);

        return redirect()->route('street.index')->with(['success' => 'Street Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function destroy(Street $street)
    {
        //
    }
}
