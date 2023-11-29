<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\http\Requests\UserRequest;
use App\http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Customer::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        //
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $customer = Customer::create($validated);

        return $customer;
    }
    public function update(UserRequest $request, string $id)
    {

        $Customer = Customer::findOrFail($id);

        $validated = $request->validated();

        $Customer->name = $validated['name'];

        $Customer->save();

        return $Customer;
    }
    public function email(CustomerRequest $request, string $id)
    {

        $Customer = Customer::findOrFail($id);

        $validated = $request->validated();

        $Customer->email = $validated['email'];

        $Customer->save();

        return $Customer;
    }
    public function password(CustomerRequest $request, string $id)
    {

        $Customer = Customer::findOrFail($id);

        $validated = $request->validated();

        $Customer->password = Hash::make($validated['password']);

        $Customer->save();

        return $Customer;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Customer::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $Customer = Customer::findOrFail($id);

        $Customer->delete();

        return $Customer;
    }

     /**
     * Update the image of the specified resource from storage.
     */

    public function image(CustomerRequest $request, string $id)
    {
        $Customer = Customer::findOrFail($id);

        if (!is_null($Customer->image)){
            Storage::disk('public')->delete($Customer->image);
        };

        $Customer->image = $request->file('image')->storePublicly('images', 'public');

        $Customer->save();

        return $Customer;
    }

/**
     * Display a selection of the resource.
     */
    public function selection()
    {
        return Customer::select('id', 'name')
                        ->get();
    }

}
