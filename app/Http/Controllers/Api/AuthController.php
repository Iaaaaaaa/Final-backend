<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RestaurantOwner;
use App\Models\Customer;
use App\http\Requests\UserRequest;
use App\http\Requests\RestaurantOwnerRequest;
use App\http\Requests\CustomerRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function RestaurantOwnerlogin(RestaurantOwnerRequest $request)
    {
        
        $restaurantowner = RestaurantOwner::where('username', $request->username)->first();
     
        if (! $restaurantowner || ! Hash::check($request->password, $restaurantowner->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        $response = [
            'restaurantowner' => $restaurantowner,
            'token' => $restaurantowner->createToken($request->username)->plainTextToken
        ];

        return $response;
    }
    public function Customerlogin(CustomerRequest $request)
    {
        
        $customer = Customer::where('username', $request->username)->first();
     
        if (! $customer || ! Hash::check($request->password, $customer->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        $response = [
            'customer' => $customer,
            'token' => $customer->createToken($request->username)->plainTextToken
        ];

        return $response;
    }
    

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $response = [
            'message' => 'Logout.'
        ];

        return $response;
    }

}
