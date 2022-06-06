<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Auth::user() && Auth::user()->can('view', Tenant::class)) {
            $data['tenants'] = Tenant::paginate(20);
            return view('tenants.index', $data);
        } else {
            return view(RouteServiceProvider::HOME)->with('fail', "You dont have permission");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user() && Auth::user()->can('create', Tenant::class)) {
            $data['users'] = User::all();
            return view('tenants.create', $data);
        } else {
            return redirect()->route('tenant.index')->with('fail', "You dont have permission");
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
        if (Auth::user() && Auth::user()->can('create', Tenant::class)) {
            $request->validate([
                'name' => 'required',
                'legal_entity' => 'integer'
            ]);
            $tenant = new Tenant();
            $tenant->name = $request->name;
            $tenant->legal_entity = $request->legal_entity;
            //$tenant->user_id = $request->user;
            $tenant->timestamps = false;
            $tenant->save();
            return redirect()->route('tenant.index')->with('successMsg', 'Tenant has been created successfully');
        } else {
            return redirect()->route('tenant.index')->with('fail', "You dont have permission");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        if (Auth::user() && Auth::user()->can('create', Tenant::class)) {
            $rents = $tenant->rents;
            return view('tenants.show', compact('tenant'), compact('rents'));
        } else {
            return redirect()->route('tenant.index')->with('fail', "You dont have permission");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        if (Auth::user() && Auth::user()->can('edit', Tenant::class)) {
            $users = User::all();
            return view('tenants.edit', compact('tenant'), compact('users'));
        } else {
            return redirect()->route('tenant.index')->with('fail', "You dont have permission");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tenant $tenant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if (Auth::user() && Auth::user()->can('edit', Tenant::class)) {
            $request->validate([
                'name' => 'required',
                'legal_entity' => 'integer'
            ]);
            $tenant = Tenant::find($id);
            $tenant->name = $request->name;
            $tenant->legal_entity = $request->legal_entity;
            //$tenant->user_id = $request->user;
            $tenant->timestamps = false;
            $tenant->save();
            return redirect()->route('tenant.index')->with('successMsg', 'Tenant has been edited successfully');
        } else {
            return redirect()->route('tenant.index')->with('fail', "You dont have permission");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tenant $tenant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tenant $tenant)
    {
        if (Auth::user() && Auth::user()->can('edit', Tenant::class)) {
            $tenant->delete();
            return redirect()->route('tenant.index')->with('successMsg', 'Tenant has been deleted successfully');
        } else {
            return redirect()->route('tenant.index')->with('fail', "You dont have permission");
        }
    }
}
