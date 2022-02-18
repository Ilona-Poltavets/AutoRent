<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Rent;
use App\Models\Tenant;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentController extends Controller
{
    const VALIDATION_RULE = [
        'date' => 'required',
        'id_transport' => 'required',
        'id_tenant' => 'required',
        'rental_period' => 'required|min:5|max:100',
        'id_owner' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rents'] = Rent::paginate(20);
        return view('rents.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owners = Owner::all();
        $tenants = Tenant::all();
        $transports = DB::select(DB::raw('select transports.id, transports.model, transports.owner_id
                                                from transports inner join owners on transports.owner_id=owners.id
                                                inner join rents on rents.id_transport=transports.id
                                                where DATEADD(day,rents.rental_period,rents.date)<GETDATE()'));
        return view('rents.create', [
            'owners' => $owners,
            'tenants' => $tenants,
            'transports' => $transports]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(self::VALIDATION_RULE);
        $rent = new Rent();
        $rent->date = $request->date;
        $rent->id_transport = $request->id_transport;
        $rent->id_tenant = $request->id_tenant;
        $rent->rental_period = $request->rental_period;
        $rent->id_owner = $request->id_owner;
        $rent->timestamps = false;
        $rent->save();
        return redirect()->route('rent.index')->with('successMsg', 'Rent has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Rent $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        return view('rents.show', compact('rent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Rent $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        $owners = Owner::all();
        $tenants = Tenant::all();
        $transports = Transport::all();
        return view('rents.create', compact('rent'), [
            'owners' => $owners,
            'tenants' => $tenants,
            'transport' => $transports]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rent $rent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(self::VALIDATION_RULE);
        $rent = Rent::find($id);
        $rent->date = $request->date;
        $rent->id_transport = $request->id_transport;
        $rent->id_tenant = $request->id_tenant;
        $rent->rental_period = $request->rental_period;
        $rent->id_owner = $request->id_owner;
        $rent->timestamps = false;
        $rent->save();
        return redirect()->route('rent.index')->with('successMsg', 'Rent has been edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Rent $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        $rent->delete();
        return redirect()->route('rent.index')->with('successMsg', 'Rent has been deleted successfully');
    }
}
