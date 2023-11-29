<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        if (request()->routeIs('admin.login')){
            return [
                'email'      => 'required|string|email|max:255',
                'password'      => 'required|min:8',
            ];
        }
        else if( request()->routeIs('admin.store') ) {
            return [
                'name'      => 'required|string|max:255',
                'email'     => 'required|string|email|unique:App\Models\Admin,email|max:255',
                'password'  => 'required|min:8',
            ];
        }
       else if (request()->routeIs('admin.update')){
        return [
            'name'      => 'required|string|max:255'
        ];
       }
       else if (request()->routeIs('admin.email')){
        return [
            'email'      => 'required|string|email|max:255'
        ];
       }
       else if (request()->routeIs('admin.password')){
        return [
            'password'      => 'required|confirmed|min:8'
        ];
       }
       else if (request()->routeIs('admin.image') || request()->routeIs('profile.image'))    {
        return [
            'image'      => 'required|image|mimes:jpg,bmp,png|max:2048'
        ];
       }
    }
}
