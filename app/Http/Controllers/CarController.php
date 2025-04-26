<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    /**
 * Display a listing of all cars.
 */
public function index()
{
    $cars = Car::with('user')->latest()->get(); // eager load user

    return response()->json($cars);
}

/**
 * Display a single car.
 */
public function show($car_id)
{
    $car = Car::with('user')->find($car_id);

    if (!$car) {
        return response()->json(['message' => 'Car not found'], 404);
    }

    return response()->json($car);
}
    /**
 * Search for cars based on filters.
 */
public function search(Request $request)
{
    $query = Car::query();

    if ($request->filled('make')) {
        $query->where('make', 'LIKE', '%' . $request->make . '%');
    }

    if ($request->filled('model')) {
        $query->where('model', 'LIKE', '%' . $request->model . '%');
    }

    if ($request->filled('year')) {
        $query->where('year', $request->year);
    }

    if ($request->filled('price_min')) {
        $query->where('price', '>=', $request->price_min);
    }

    if ($request->filled('price_max')) {
        $query->where('price', '<=', $request->price_max);
    }

    $cars = $query->with('user')->latest()->get();

    return response()->json($cars);
}
    /**
 * Toggle favourite (add/remove) a car for the logged-in user.
 */
public function favourite($car_id)
{
    $user = auth()->user();

    $car = Car::find($car_id);

    if (!$car) {
        return response()->json(['message' => 'Car not found'], 404);
    }

    if ($user->favourites()->where('car_id', $car_id)->exists()) {
        // Already favourited — remove it (unfavourite)
        $user->favourites()->detach($car_id);
        return response()->json(['message' => 'Car removed from favourites']);
    } else {
        // Not favourited yet — add it
        $user->favourites()->attach($car_id);
        return response()->json(['message' => 'Car added to favourites']);
    }
}

    /**
 * Get all cars that a user has favourited.
 */
public function userFavourites($user_id)
{
    $user = \App\Models\User::find($user_id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $favourites = $user->favourites()->with('user')->get();

    return response()->json($favourites);
}

}
