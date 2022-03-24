<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Routing\Route;

class CountryController extends Controller
{
    const VALIDATION_RULE = [
        'name' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['countries'] = Country::paginate(20);
        return view('countries.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('countries.create');
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
        $country = new Country();
        $country->name = $request->name;
        if ($request->file('flag') != null) {
            $country->flag = ($request->flag)->store("images/flags/$country->name");
        } else {
            $country->flag = "css/not_found_image.jpg";
        }
        $country->continent = $request->continent;
        $country->timestamps = false;
        $country->save();
        return redirect()->route('country.index')->with('successMsg', 'Country has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
        /*$data = DB::table('transports')->where('country_id', '=', $country->id)->paginate(20);
        $types = CarBodyType::all();
        $owners = Owner::all();
        $countries = Country::all();
        return view('transports.index', ['transports' => $data, 'carBodyTypes' => $types, 'owners' => $owners, 'countries' => $countries]);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(self::VALIDATION_RULE);
        $country = Country::find($id);
        if ($request->file('flag') != null) {
            $country->flag = ($request->flag)->store("images/flags/$country->name");
        }
        $country->name = $request->name;
        $country->continent = $request->continent;
        $country->timestamps = false;
        $country->save();
        return redirect()->route('country.index')->with('successMsg', 'Country has been edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        Storage::delete($country->flag);
        $country->delete();
        return redirect()->route('country.index')->with('successMsg', 'Country has been deleted successfully');
    }
}
