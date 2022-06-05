<?php

namespace App\Http\Controllers;

use App\Models\CarBodyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\upper;
use const http\Client\Curl\AUTH_ANY;

class CarBodyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['types'] = CarBodyType::all();
        return view('car_body_types.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        if (Auth::user() && Auth::user()->can('create', CarBodyType::class))
            return view('car_body_types.create');
        else
            return redirect()->route('carBodyType.index')->with('successMsg', 'Tenant has been edited successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user() && Auth::user()->can('create', CarBodyType::class)) {
            $request->validate([
                'name' => 'required',
            ]);
            $type = new CarBodyType();
            $type->name = strtoupper($request->name);
            $type->timestamps = false;
            $type->save();
            return redirect()->route('carBodyType.index')->with('successMsg', 'Type has been created successfully');
        } else {
            return redirect()->route('carBodyType.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CarBodyType $carBodyType
     * @return \Illuminate\Http\Response
     */
    public function show(CarBodyType $carBodyType)
    {
        $transports = $carBodyType->transports;
        $top5 = [];
        if (count($transports) < 6) {
            $top5 = $transports;
        } else {
            $numbers = array_rand(range(0, count($transports) - 1), 5);
            foreach ($numbers as $num) {
                array_push($top5, $transports[$num]);
            }
        }
        return view('car_body_types.show', compact('carBodyType'), compact('top5'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CarBodyType $carBodyType
     * @return \Illuminate\Http\Response
     */
    public function edit(CarBodyType $carBodyType)
    {
        if (Auth::user() && Auth::user()->can('edit', CarBodyType::class)) {
            return view('car_body_types.edit', compact('carBodyType'));
        } else {
            return redirect()->route('carBodyType.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CarBodyType $carBodyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user() && Auth::user()->can('edit', CarBodyType::class)) {
            $request->validate([
                'name' => 'required',
            ]);
            $type = CarBodyType::find($id);
            $type->name = strtoupper($request->name);
            $type->timestamps = false;
            $type->save();
            return redirect()->route('carBodyType.index')->with('successMsg', 'Type has been edited successfully');
        } else {
            return redirect()->route('carBodyType.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CarBodyType $carBodyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarBodyType $carBodyType)
    {
        if (Auth::user() && Auth::user()->can('delete', CarBodyType::class)) {
            $carBodyType->delete();
            return redirect()->route('carBodyType.index')->with('successMsg', 'Type has been deleted successfully');
        } else {
            return redirect()->route('carBodyType.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }
}
