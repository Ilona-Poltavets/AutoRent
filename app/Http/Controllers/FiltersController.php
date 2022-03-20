<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiltersController extends Controller
{
    public function transportFilter(Request $request)
    {
        $types = str_replace('"', '', trim($request->types, '[]'));
        $owners = str_replace('"', '', trim($request->owners, '[]'));
        $countries = str_replace('"', '', trim($request->countries, '[]'));
        $min = $request->min;
        $max = $request->max;
        $transport = DB::table('transports')->where(function ($data) use ($types, $owners, $countries, $min, $max) {
            if ($types != '') {
                $data->whereRaw('body_type_id IN (' . $types . ')');
            }
            if ($owners != '') {
                $data->whereRaw('owner_id IN (' . $owners . ')');
            }
            if ($countries != '') {
                $data->whereRaw('country_id IN (' . $countries . ')');
            }
            if ($min != null) {
                $data->whereRaw('mileage>' . $min);
            }
            if ($max != null) {
                $data->whereRaw('mileage<' . $max);
            }
        })->paginate(20);

        return response()->json($transport);
    }

    public function countryFilter(Request $request)
    {
        $continents = str_replace('"', "'", trim($request->continents, '[]'));
        $countries = DB::table('countries')->where(function ($data) use ($continents) {
            if ($continents != '') {
                $data->whereRaw('continent IN (' . $continents . ')');
            }
        })->paginate(20);
        return response()->json($countries);
    }
}
