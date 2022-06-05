<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user() && Auth::user()->can('create', Country::class))
            return view('countries.create');
        else
            return redirect()->route('country.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user() && Auth::user()->can('create', Country::class)) {
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
        } else {
            return redirect()->route('country.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        $transports = $country->transports;
        $top5 = [];
        if (count($transports) < 6) {
            $top5 = $transports;
        } else {
            $numbers = array_rand(range(0, count($transports) - 1), 5);
            foreach ($numbers as $num) {
                array_push($top5, $transports[$num]);
            }
        }
        return view('countries.show', compact('country'), compact('top5'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        if (Auth::user() && Auth::user()->can('edit', Country::class)) {
            return view('countries.edit', compact('country'));
        } else {
            return redirect()->route('country.index')->with('successMsg', 'Tenant has been edited successfully');
        }
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
        if (Auth::user() && Auth::user()->can('edit', Country::class)) {
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
        } else {
            return redirect()->route('country.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        if (Auth::user() && Auth::user()->can('edit', Country::class)) {
            Storage::delete($country->flag);
            $country->delete();
            return redirect()->route('country.index')->with('successMsg', 'Country has been deleted successfully');
        } else {
            return redirect()->route('country.index')->with('successMsg', 'Tenant has been edited successfully');
        }
    }
}
