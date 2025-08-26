<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Apartment;

class FavoriteController extends Controller
{
    public function add(Request $request)
    {
        logger('FavoriteController@add', $request->all());
        
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Не авторизован'], 401);
        }

        $apartmentId = $request->input('apartment_id');

        $exists = Favorite::where('user_id', $user->id)
                          ->where('apartment_id', $apartmentId)
                          ->exists();

        if ($exists) {
            return response()->json(['message' => 'Уже в избранном'], 409);
        }

        Favorite::create([
            'user_id' => $user->id,
            'apartment_id' => $apartmentId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Квартира успешно добавлена в избранное!'
        ]);
    }

    public function destroy(Apartment $apartment)
    {
        Auth::user()->favorites()->detach($apartment->id);
        return response()->json(['message' => 'Квартира удалена из избранного']);
    }

}
