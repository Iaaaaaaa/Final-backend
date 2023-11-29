<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\http\Requests\RestaurantRequest;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index1(Request $request)
    {
        {
            $restaurant = Restaurant::select('*')
                                    ->join('restaurant_owners', 'restaurant_owners.id', '=', 'restaurants.id');
    
    
            return $restaurant->get();
        }

        return Restaurant::all();
    }

    public function index2()
    {
        return Restaurant::all();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantRequest $request)
    {
        $validated = $request->validated();

        $restaurant = Restaurant::create($validated);

        return $restaurant;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Restaurant::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantRequest $request, string $id)
    {
        $validated = $request->validated();

        $restaurant = Restaurant::findOrFail($id);

        $restaurant->update($validated);

        return $restaurant;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $restaurant->delete();

        return $restaurant;
    }
}
