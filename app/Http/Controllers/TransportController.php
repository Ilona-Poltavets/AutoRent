<?php

namespace App\Http\Controllers;

use Illuminate\Database\PDO\Connection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CarBodyType;
use App\Models\Country;
use App\Models\Owner;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $data = Transport::paginate(10);
        $types = CarBodyType::all();
        $owners = Owner::all();
        $countries = Country::all();
        return view('transports.index', ['transports' => $data, 'carBodyTypes' => $types, 'owners' => $owners, 'countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (Auth::user() && Auth::user()->can('create', Transport::class)) {
            $countries = Country::all();
            $owners = Owner::all();
            $carBodyTypes = CarBodyType::all();
            return view('transports.create', ['countries' => $countries, 'owners' => $owners, 'carBodyTypes' => $carBodyTypes]);
        } else {
            return redirect('transport');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (Auth::user() && Auth::user()->can('create', Transport::class)) {
            $request->validate(self::VALIDATION_RULE);

            $last = DB::table('transports')->latest('id')->first();
            $paths = "";
            if ($request->file('photos') != null) {
                foreach ($request->photos as $index => $photo) {
                    $filename = $photo->store("/images/cars/$last->id");
                    if ($index == 0)
                        $paths = $filename;
                    else
                        $paths = $paths . ";" . $filename;
                }
            }
            else{
                $paths='css/not_found_image.jpg';
            }

            DB::select("execute dbo.addTrasnportProc '" . $request->number . "', '" . $request->model . "', " . $request->mileage . ', ' . $request->owner_id . ', ' . $request->body_type_id . ', ' . $request->country_id . ", '" . $paths . "' ");

            return redirect()->route('transport.index')->with('successMsg', 'Transport has been created successfully');
        } else {
            return redirect('transport');
        }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Transport $transport)
    {
        if (Auth::user() && Auth::user()->can('edit', Transport::class)) {
            $countries = Country::all();
            $owners = Owner::all();
            $carBodyTypes = CarBodyType::all();
            return view('transports.edit', compact('transport'), ['countries' => $countries, 'owners' => $owners, 'carBodyTypes' => $carBodyTypes]);
        } else {
            return redirect('transport');
        }
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
        if (Auth::user() && Auth::user()->can('edit', Transport::class)) {
            $request->validate(self::VALIDATION_RULE);
            $transport = Transport::find($id);

            $paths = $transport->images;
            if ($request->file('photos') != null) {
                foreach ($request->photos as $index => $photo) {
                    $filename = $photo->store("/images/cars/$id");
                    $paths = $paths . ";" . $filename;
                }
            }

            $transport->images = $paths;
            $transport->model = $request->model;
            $transport->number = $request->number;
            $transport->mileage = $request->mileage;
            $transport->country_id = $request->country_id;
            $transport->body_type_id = $request->body_type_id;
            $transport->owner_id = $request->owner_id;
            $transport->timestamps = false;
            $transport->update();
            return view('transports.show', compact('transport'));
        } else {
            return redirect('transport');
        }
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
        if (Auth::user() && Auth::user()->can('delete', Transport::class)) {
            Storage::deleteDirectory("images/$transport->id");
            $transport->delete();
            return redirect()->route('transport.index')->with('successMsg', 'Transport has been deleted successfully');
        } else {
            return redirect('transport');
        }
    }

    public function editMainPhoto(Request $request)
    {
        $transport = Transport::find($request->id);
        $images = explode(';', $transport->images);

        $temp = $images[0];
        $images[0] = $images[$request->mainIndex];
        $images[$request->mainIndex] = $temp;

        $transport->images = implode(';', $images);
        $transport->timestamps = false;
        $transport->save();
    }

    public function deletePhoto(Request $request)
    {
        $transport = Transport::find($request->id);
        $images = explode(';', $transport->images);

        Storage::delete($images[$request->mainIndex]);
        unset($images[$request->mainIndex]);

        $transport->images = implode(';', $images);
        $transport->timestamps = false;
        $transport->save();
    }
}
