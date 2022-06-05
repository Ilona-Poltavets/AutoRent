<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Rent;
use App\Models\Tenant;
use App\Models\Transport;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentController extends Controller
{
    const VALIDATION_RULE = [
        'date' => 'required',
        'id_transport' => 'required',
        'tenant' => 'required',
        'rental_period' => 'required',
        'id_owner' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user() && Auth::user()->can('view', Rent::class)) {
            $owners = Owner::all();
            $rents = Rent::paginate(20);
            return view('rents.index', ['owners' => $owners, 'rents' => $rents]);
        } else {
            return redirect()->route(RouteServiceProvider::HOME)->with('fail', "You dont have permission");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($transportId)
    {
        if (Auth::user() && Auth::user()->can('create', Rent::class)) {
            $owners = DB::select(DB::raw('select owners.id, owners.name
                                                from owners inner join transports on transports.owner_id=owners.id
                                                where transports.id=' . $transportId));
            $tenants = Tenant::all();
            $transports = DB::table('transports')->where('id', '=', $transportId)->get();
            return view('rents.create', [
                'owners' => $owners,
                'tenants' => $tenants,
                'transports' => $transports,
                'transportId' => $transportId]);
        } else {
            return redirect()->route('rent.index')->with('fail', "You dont have permission");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user() && Auth::user()->can('create', Rent::class)) {
            $request->validate(self::VALIDATION_RULE);
            $tenant = DB::select("select top 1 * from tenants where name='$request->tenant'");
            $transport = Transport::find($request->id_transport);
            $rent = new Rent();
            $rent->date = $request->date;
            $rent->id_transport = $request->id_transport;
            $rent->id_tenant = $tenant[0]->id;
            $rent->rental_period = $request->rental_period;
            $rent->id_owner = $request->id_owner;
            $rent->timestamps = false;
            $rent->save();
            $transport->rental_times += 1;
            $transport->timestamps = false;
            $transport->save();
            return redirect()->route('rent.index')->with('successMsg', 'Rent has been created successfully');
        } else {
            return redirect()->route('rent.index')->with('fail', "You dont have permission");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Rent $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        if (Auth::user() && Auth::user()->can('view', Rent::class))
            return view('rents.show', compact('rent'));
        else
            return redirect()->route('rent.index')->with('fail', "You dont have permission");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Rent $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        if (Auth::user() && Auth::user()->can('create', Rent::class)) {
            $owners = DB::select(DB::raw('select owners.id, owners.name
                                                from owners inner join transports on transports.owner_id=owners.id
                                                where transports.id=' . $rent->id_transport));
            $tenants = Tenant::all();
            $transports = DB::table('transports')->where('id', '=', $rent->id_transport)->get();
            return view('rents.edit', compact('rent'), [
                'owners' => $owners,
                'tenants' => $tenants,
                'transports' => $transports]);
        } else {
            return redirect()->route('rent.index')->with('fail', "You dont have permission");
        }
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
        if (Auth::user() && Auth::user()->can('create', Rent::class)) {
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
        } else {
            return redirect()->route('rent.index')->with('fail', "You dont have permission");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Rent $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        if (Auth::user() && Auth::user()->can('create', Rent::class)) {
            $rent->delete();
            return redirect()->route('rent.index')->with('successMsg', 'Rent has been deleted successfully');
        } else {
            return redirect()->route('rent.index')->with('fail', "You dont have permission");
        }
    }

    public function getModel($id)
    {
        return \App\Models\Transport::find($id)->model;
    }
}
