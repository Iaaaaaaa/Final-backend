<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\http\Requests\RestaurantRequest;
use App\http\Requests\RestaurantOwnerRequest;
use App\Models\Restaurant;
use App\Models\RestaurantOwner;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index1(String $id)
    {
        $restaurantOwner = RestaurantOwner::findOrFail($id);
    
        $restaurants = Restaurant::select('restaurants.*')
            ->join('restaurant_owners', 'restaurant_owners.id', '=', 'restaurants.owner_id');
    
        if ($restaurantOwner) {
            $restaurants->where('restaurants.owner_id', $restaurantOwner->id);
            return $restaurants->get();
        }
    
        // Return all restaurants if the owner is not found or no ID provided
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

    public function image(RestaurantRequest $request, string $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        if (!is_null($restaurant->image)){
            Storage::disk('public')->delete($restaurant->image);
        };

        $restaurant->image = $request->file('image')->storePublicly('images', 'public');

        $restaurant->save();

        return $restaurant;
    }
}
