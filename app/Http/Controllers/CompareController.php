<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Apartment;

class CompareController extends Controller
{
    public function index()
    {
        $compareIds = Session::get('compare', []);
        $apartments = Apartment::whereIn('id', $compareIds)->get();

        return view('compare', compact('apartments'));
    }

    public function add($apartmentId)
    {
        $apartment = Apartment::findOrFail($apartmentId);
        $compare = Session::get('compare', []);

        if (!in_array($apartmentId, $compare)) {
            $compare[] = $apartmentId;
            Session::put('compare', $compare);
        }

        return response()->json(['status' => 'added', 'compare' => $compare]);
    }

    public function remove($apartmentId)
    {
        $compare = Session::get('compare', []);
    
        if (($key = array_search($apartmentId, $compare)) !== false) {
            unset($compare[$key]);
        }
    
        $compare = array_values($compare);
        Session::put('compare', $compare);
    
        return response()->json(['status' => 'removed', 'compare' => $compare]);
    }
}
