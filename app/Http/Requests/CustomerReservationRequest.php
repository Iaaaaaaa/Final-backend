<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerReservationRequest extends FormRequest
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
        if(request()->routeIs('reservation.status')){
            return[
            'status'      => 'required|string|max:255',
            ];
        }
        return [
            'num_tables'      => 'required|string|max:255',
            'num_guests'          => 'string|max:255',
            'status'      => 'string|max:255',
            'reserve_date'              => 'required|string|max:255',
            'reserve_time'              => 'required|string|max:255',
            'request_date'                 => 'string|max:255',
            'time_of_day'             => 'required|string|max:255',
            'special_request'             => 'nullable|string|max:255',
            'restaurant_id'         => 'required|exists:restaurants,id|integer',
            'customer_id'           => 'required|exists:customers,id|integer'
        ];
    }
}
