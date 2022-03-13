<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class FiltersController extends Controller
{
    public function transportFilter($id){
        $transport = DB::table('transports')->whereRaw('body_type_id IN ('.$id.')')->get();;
        return response()->json($transport);
    }
}
