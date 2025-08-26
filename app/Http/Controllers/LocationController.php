<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    
    public function showCityFilterPage()
    {
        // Получаем уникальные города из таблицы locations
        $cities = DB::table('locations')
                    ->select('city')
                    ->whereNotNull('city')
                    ->distinct()
                    ->orderBy('city')
                    ->pluck('city');

        return view('project', compact('cities'));
    }

    public function getCities()
    {
        $cities = DB::table('locations')
                    ->select('city')
                    ->whereNotNull('city')
                    ->distinct()
                    ->orderBy('city')
                    ->pluck('city');

        return response()->json(['cities' => $cities]);
    }
}
