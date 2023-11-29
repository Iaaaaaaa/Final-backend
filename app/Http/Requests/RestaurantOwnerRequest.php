<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantOwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->routeIs('restaurantowner.login')){
            return [
                'username'      => 'required|string|max:255',
                'password'      => 'required|min:8',
            ];
        }
        else if( request()->routeIs('restaurantowner.store') ) {
            return [
                'firstname'      => 'required|string|max:255',
                'lastname'      => 'required|string|max:255',
                'email'     => 'required|string|email|unique:App\Models\Customer,email|max:255',
                'username'      => 'required|string|max:255',
                'password'  => 'required|min:8',
            ];
        }
       else if (request()->routeIs('restaurantowner.update')){
        return [
            'firstname'      => 'required|string|max:255',
            'lastname'      => 'required|string|max:255'
        ];
       }
       else if (request()->routeIs('restaurantowner.email')){
        return [
            'email'      => 'required|string|email|max:255'
        ];
       }
       else if (request()->routeIs('restaurantowner.password')){
        return [
            'password'      => 'required|confirmed|min:8'
        ];
       }
       else if (request()->routeIs('restaurantowner.image') || request()->routeIs('profile.image'))    {
        return [
            'image'      => 'required|image|mimes:jpg,bmp,png|max:2048'
        ];
       }
    }
}
