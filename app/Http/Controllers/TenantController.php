<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tenants'] = Tenant::paginate(20);
        return view('tenants.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'legal_entity' => 'integer'
        ]);
        $tenant = new Tenant();
        $tenant->name = $request->name;
        $tenant->legal_entity = $request->legal_entity;
        $tenant->timestamps = false;
        $tenant->save();
        return redirect()->route('tenant.index')->with('successMsg', 'Tenant has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        return view('tenants.show',compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'legal_entity' => 'integer'
        ]);
        $tenant = Tenant::find($id);
        $tenant->name = $request->name;
        $tenant->legal_entity = $request->legal_entity;
        $tenant->timestamps = false;
        $tenant->save();
        return redirect()->route('tenant.index')->with('successMsg', 'Tenant has been edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('tenant.index');
    }
}
