<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class FavouriteController extends Controller
{
    public function favourite(Request $request, $carId)
    {
        $user = auth()->user();

        // Check if the car exists
        $car = Car::find($carId);
        if (!$car) {
            return response()->json(['message' => 'Car not found.'], 404);
        }

        // Check if already favourited
        if ($user->favourites()->where('car_id', $carId)->exists()) {
            // If already favourited, detach (unfavourite)
            $user->favourites()->detach($carId);
            return response()->json(['message' => 'Car removed from favourites.', 'favourited' => false]);
        } else {
            // Otherwise, attach (favourite)
            $user->favourites()->attach($carId);
            return response()->json(['message' => 'Car added to favourites.', 'favourited' => true]);
        }
    }
}
