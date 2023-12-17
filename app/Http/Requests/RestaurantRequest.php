<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
        if(request()->routeIs('restaurant.image')){
            return[
            'image'      => 'required|image|mimes:jpg,bmp,png|max:2048',
            ];
        }if(request()->routeIs('restaurant.image')) {
            return [
                'id' => 'required|exists:restaurants,id',
            ];
        }
        else
        return [
            'restaurant_name'      => 'required|string|max:255',
            'description'          => 'string|max:255',
            'cuisine'              => 'required|string|max:255',
            'address'              => 'required|string|max:255',
            'city'                 => 'required|string|max:255',
            'zip_code'             => 'required|string|max:255',
            'owner_id'             => 'required|exists:restaurant_owners,id|integer',
        ];
    }
}
