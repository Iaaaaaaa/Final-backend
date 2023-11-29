<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RestaurantOwner;
use App\http\Requests\RestaurantOwnerRequest;
use Illuminate\Support\Facades\Storage;

class RestaurantOwnerController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return RestaurantOwner::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantOwnerRequest $request)
    {
        //
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $restaurantowner = RestaurantOwner::create($validated);

        return $restaurantowner;
    }
    public function update(RestaurantOwnerRequest $request, string $id)
    {

        $RestaurantOwner = RestaurantOwner::findOrFail($id);

        $validated = $request->validated();

        $RestaurantOwner->name = $validated['name'];

        $RestaurantOwner->save();

        return $RestaurantOwner;
    }
    public function email(RestaurantOwnerRequest $request, string $id)
    {

        $RestaurantOwner = RestaurantOwner::findOrFail($id);

        $validated = $request->validated();

        $RestaurantOwner->email = $validated['email'];

        $RestaurantOwner->save();

        return $RestaurantOwner;
    }
    public function password(RestaurantOwnerRequest $request, string $id)
    {

        $RestaurantOwner = RestaurantOwner::findOrFail($id);

        $validated = $request->validated();

        $RestaurantOwner->password = Hash::make($validated['password']);

        $RestaurantOwner->save();

        return $RestaurantOwner;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return RestaurantOwner::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $RestaurantOwner = RestaurantOwner::findOrFail($id);

        $RestaurantOwner->delete();

        return $RestaurantOwner;
    }

     /**
     * Update the image of the specified resource from storage.
     */

    public function image(RestaurantOwner $request, string $id)
    {
        $RestaurantOwner = RestaurantOwner::findOrFail($id);

        if (!is_null($RestaurantOwner->image)){
            Storage::disk('public')->delete($RestaurantOwner->image);
        };

        $RestaurantOwner->image = $request->file('image')->storePublicly('images', 'public');

        $RestaurantOwner->save();

        return $RestaurantOwner;
    }

/**
     * Display a selection of the resource.
     */
    public function selection()
    {
        return RestaurantOwner::select('id', 'name')
                        ->get();
    }

}
