<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Tenant;
use App\Models\Transport;
use Carbon\Carbon;
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

    public function ownerFilter(Request $request)
    {
        $owners = DB::table('owners')->where(function ($data) use ($request) {
            if ($request->legal_entity != '') {
                $data->whereRaw('legal_entity=' . $request->legal_entity);
            }
        })->paginate(20);
        return response()->json($owners);
    }

    public function tenantFilter(Request $request)
    {
        $tenants = DB::table('tenants')->where(function ($data) use ($request) {
            if ($request->legal_entity != '') {
                $data->whereRaw('legal_entity=' . $request->legal_entity);
            }
        })->paginate(20);
        return response()->json($tenants);
    }

    public function rentFilter(Request $request)
    {
        $owners = str_replace('"', "'", trim($request->owners, '[]'));
        $rents = DB::table('rents')->where(function ($data) use ($owners, $request) {
            if ($owners != '') {
                $data->whereRaw('id_owner IN (' . $owners . ')');
            }
            if ($request->minDate != '') {
                $data->whereDate('date', '>=', Carbon::parse($request->minDate)->format('Y-m-d H:i'));
            }
            if ($request->maxDate != '') {
                $data->whereDate('date', '<=', Carbon::parse($request->maxDate)->format('Y-m-d H:i'));
            }
            if ($request->minPeriod != '') {
                $data->whereRaw('rental_period>' . $request->minPeriod);
            }
            if ($request->maxPeriod != '') {
                $data->whereRaw('rental_period<' . $request->maxPeriod);
            }
        })->paginate(20);
        foreach ($rents as $rent) {
            $rent->model = Transport::where('id', 'like', $rent->id_transport)->value('model');
            $rent->tenant = Tenant::where('id', 'like', $rent->id_tenant)->value('name');
            $rent->owner = Owner::where('id', 'like', $rent->id_owner)->value('name');
        }
        return response()->json($rents);
    }
}
