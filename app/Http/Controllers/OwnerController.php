<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            $data['owners'] = Owner::paginate(20);
            foreach ($data['owners'] as $elem) {
                $elem->avgMileage = DB::select("select dbo.getAverageMileage(?) as nb", [$elem->id])[0]->nb;
            }
            return view('owners.index', $data);
        } else {
            return redirect()->route(RouteServiceProvider::HOME);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user() && Auth::user()->can('create', Owner::class)) {
            return view('owners.create');
        } else {
            return redirect()->route('owner.index')->with('successMsg', 'Tenant has been edited successfully');
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
        if (Auth::user() && Auth::user()->can('create', Owner::class)) {
            $request->validate([
                'name' => 'required'
            ]);
            if ($request->file('logo') != null) {
                $path = ($request->logo)->store("images/$request->name");
            } else {
                $path = null;
            }
            $owner = new Owner();
            $owner->name = $request->name;
            $owner->legal_entity = $request->legal_entity;
            $owner->logo = $path;
            $owner->timestamps = false;
            $owner->save();
            return redirect()->route('owner.index')->with('successMsg', 'Country has been created successfully');
        } else {
            return redirect()->route('owner.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        if (Auth::user()) {
            $transports = DB::select("select * from dbo.getTransports('$owner->name')");
            //dd($transports);
            $top5 = [];
            if (count($transports) < 6) {
                $top5 = $transports;
            } else {
                $numbers = array_rand(range(0, count($transports) - 1), 5);
                foreach ($numbers as $num) {
                    array_push($top5, $transports[$num]);
                }
            }
            return view('owners.show', compact('owner'), compact('top5'));
        } else {
            return redirect()->route('owner.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        if (Auth::user() && Auth::user()->can('edit', Owner::class)) {
            return view('owners.edit', compact('owner'));
        } else {
            return redirect()->route('owner.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user() && Auth::user()->can('edit', Owner::class)) {
            $request->validate([
                'name' => 'required'
            ]);
            $owner = Owner::find($id);
            if ($request->file('logo') != null) {
                if ($owner->logo != null) {
                    Storage::delete($owner->logo);
                }
                $path = ($request->logo)->store("images/owners/$request->name");
            } else {
                $path = $owner->logo;
            }
            $owner->logo = $path;
            $owner->name = $request->name;
            $owner->legal_entity = $request->legal_entity;
            $owner->timestamps = false;
            $owner->save();
            return redirect()->route('owner.index')->with('successMsg', 'Country has been edited successfully');
        } else {
            return redirect()->route('owner.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Owner $owner)
    {
        if (Auth::user() && Auth::user()->can('edit', Owner::class)) {
            Storage::delete($owner->logo);
            $owner->delete();
            return redirect()->route('owner.index')->with('successMsg', 'Country has been deleted successfully');
        } else {
            return redirect()->route('owner.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }
}
