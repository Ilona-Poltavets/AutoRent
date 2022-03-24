<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Owner;
use App\Models\Tenant;
use App\Models\Transport;
use Illuminate\Http\Request;

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
}
