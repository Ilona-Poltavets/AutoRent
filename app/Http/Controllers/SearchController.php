<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Owner;
use App\Models\Rent;
use App\Models\Tenant;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchTransporByModel(Request $request)
    {
        $text_input = $request->input('text_input');
        if ($text_input != '')
            $transport = Transport::where('model', 'like', "%{$text_input}%")->get();
        else
            $transport = Transport::all();
        return response()->json($transport);
    }

    public function searchCountryByName(Request $request)
    {
        $text_input = $request->input('text_input');
        if ($text_input != '')
            $countries = Country::where('name', 'like', "%{$text_input}%")->get();
        else
            $countries = Country::all();
        return response()->json($countries);
    }

    public function searchOwnerByName(Request $request)
    {
        $text_input = $request->input('text_input');
        if ($text_input != '')
            $owners = Owner::where('name', 'like', "%{$text_input}%")->get();
        else
            $owners = Owner::all();
        return response()->json($owners);
    }

    public function searchTenantByName(Request $request)
    {
        $text_input = $request->input('text_input');
        if ($text_input != '')
            $tenants = Tenant::where('name', 'like', "%{$text_input}%")->get();
        else
            $tenants = Tenant::all();
        return response()->json($tenants);
    }

    public function searchRent(Request $request)
    {
        $text_input = $request->input('text_input');
        if ($text_input != '') {
            $rents = DB::table('rents')
                ->where('id_transport', '=', Transport::where('model', 'like', "%{$text_input}%")->value('id'))
                ->orWhere('id_tenant', '=', Tenant::where('name', 'like', "%{$text_input}%")->value('id'))
                ->orWhere('id_owner', '=', Owner::where('name', 'like', "%{$text_input}%")->value('id'))
                ->get();
        } else {
            $rents = Rent::all();
        }
        foreach ($rents as $rent) {
            $rent->model = Transport::where('id', 'like', $rent->id_transport)->value('model');
            $rent->tenant = Tenant::where('id', 'like', $rent->id_tenant)->value('name');
            $rent->owner = Owner::where('id', 'like', $rent->id_owner)->value('name');
        }
        return response()->json($rents);
    }
}
