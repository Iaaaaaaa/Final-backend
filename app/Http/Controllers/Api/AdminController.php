<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\http\Requests\AdminRequest;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Admin::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        //
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $admin = Admin::create($validated);

        return $admin;
    }
    public function update(AdminRequest $request, string $id)
    {

        $Admin = Admin::findOrFail($id);

        $validated = $request->validated();

        $Admin->name = $validated['name'];

        $Admin->save();

        return $Admin;
    }
    public function email(AdminRequest $request, string $id)
    {

        $Admin = Admin::findOrFail($id);

        $validated = $request->validated();

        $Admin->email = $validated['email'];

        $Admin->save();

        return $Admin;
    }
    public function password(AdminRequest $request, string $id)
    {

        $Admin = Admin::findOrFail($id);

        $validated = $request->validated();

        $Admin->password = Hash::make($validated['password']);

        $Admin->save();

        return $Admin;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Admin::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $Admin = Admin::findOrFail($id);

        $Admin->delete();

        return $Admin;
    }

     /**
     * Update the image of the specified resource from storage.
     */

    public function image(AdminRequest $request, string $id)
    {
        $Admin = Admin::findOrFail($id);

        if (!is_null($Admin->image)){
            Storage::disk('public')->delete($Admin->image);
        };

        $Admin->image = $request->file('image')->storePublicly('images', 'public');

        $Admin->save();

        return $Admin;
    }

/**
     * Display a selection of the resource.
     */
    public function selection()
    {
        return User::select('id', 'name')
                        ->get();
    }

}
