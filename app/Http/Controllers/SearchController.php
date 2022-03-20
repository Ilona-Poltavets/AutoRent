<?php

namespace App\Http\Controllers;

use App\Models\Country;
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
}
