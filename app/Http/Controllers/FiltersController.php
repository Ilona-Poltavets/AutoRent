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
        $transport = DB::table('transports')->where(function ($data) use ($types, $owners, $countries) {
            if ($types != '') {
                $data->whereRaw('body_type_id IN (' . $types . ')');
            }
            if ($owners != '') {
                $data->whereRaw('owner_id IN (' . $owners . ')');
            }
            if ($countries != '') {
                $data->whereRaw('country_id IN (' . $countries . ')');
            }
        })->paginate(20);

        return response()->json($transport);
    }
}
