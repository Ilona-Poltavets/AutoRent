<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchTransporByModel(Request $request){
        $text_input = $request->input('text_input');
        $transport = Transport::where('model','like' ,"%{$text_input}%")->get();
        return response()->json($transport);
    }
}
