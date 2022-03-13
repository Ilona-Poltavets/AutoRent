<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\CarBodyType;
use App\Models\Country;
use App\Models\Owner;
use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    const VALIDATION_RULE = [
        'model' => 'required',
        'number' => 'required|alpha_num',
        'mileage' => 'required|integer|max:10000000|min:0',
        'owner_id' => 'required',
        'body_type_id' => 'required',
        'country_id' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data['transports'] = Transport::paginate(20);
        return view('transports.index',$data);//response()->view('transports.index')->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $countries = Country::all();
        $owners = Owner::all();
        $carBodyTypes = CarBodyType::all();
        return view('transports.create', ['countries' => $countries, 'owners' => $owners, 'carBodyTypes' => $carBodyTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(self::VALIDATION_RULE);

        $transport = new Transport();
        $transport->model = $request->model;
        $transport->number = $request->number;
        $transport->mileage = $request->mileage;
        $transport->country_id = $request->country_id;
        $transport->body_type_id = $request->body_type_id;
        $transport->owner_id = $request->owner_id;
        $transport->timestamps = false;
        $transport->save();
        //return response()->json($transport);
        return redirect()->route('transport.index')->with('successMsg', 'Transport has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Transport $transport)
    {
        return view('transports.show', compact('transport'));
        //return $this->edit($transport);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Transport $transport)
    {
        $countries = Country::all();
        $owners = Owner::all();
        $carBodyTypes = CarBodyType::all();
        return view('transports.edit', compact('transport'), ['countries' => $countries, 'owners' => $owners, 'carBodyTypes' => $carBodyTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate(self::VALIDATION_RULE);

        $transport = Transport::find($id);
        $transport->model = $request->model;
        $transport->number = $request->number;
        $transport->mileage = $request->mileage;
        $transport->country_id = $request->country_id;
        $transport->body_type_id = $request->body_type_id;
        $transport->owner_id = $request->owner_id;
        $transport->timestamps = false;
        $transport->update();
        //return response()->json($transport);
        return redirect('/transport')->with('success', 'Transport has been created successfully');
    }

    public function create_view()
    {
        DB::unprepared("create view car_owner_tenant as
        select transports.model, owners.name owner, tenants.name tenant, DATEADD(day,rents.rental_period,rents.date) end_date_rent
        from transports inner join owners on transports.owner_id=owners.id
        inner join rents on rents.id_transport=transports.id
        inner join tenants on tenants.id=rents.id_tenant
        where DATEADD(day,rents.rental_period,rents.date)>GETDATE()");
        $car_owner_tenant = DB::select("select * from car_owner_tenant");
        DB::unprepared("drop view car_owner_tenant");
        return view('query.view', ['table' => $car_owner_tenant]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport $transport)
    {
        $transport->delete();
        return redirect()->route('transport.index')->with('successMsg', 'Transport has been deleted successfully');
    }
}
