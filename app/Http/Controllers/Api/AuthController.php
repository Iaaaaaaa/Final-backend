<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Customer;
use App\http\Requests\UserRequest;
use App\http\Requests\AdminRequest;
use App\http\Requests\CustomerRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Adminlogin(AdminRequest $request)
    {
        
        $admin = Admin::where('email', $request->email)->first();
     
        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        $response = [
            'admin' => $admin,
            'token' => $admin->createToken($request->email)->plainTextToken
        ];

        return $response;
    }
    public function Customerlogin(CustomerRequest $request)
    {
        
        $customer = Customer::where('email', $request->email)->first();
     
        if (! $customer || ! Hash::check($request->password, $customer->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        $response = [
            'customer' => $customer,
            'token' => $customer->createToken($request->email)->plainTextToken
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
