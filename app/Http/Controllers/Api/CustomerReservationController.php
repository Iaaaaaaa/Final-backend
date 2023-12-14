<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerReservation;
use App\Models\Restaurant;
use App\Models\Customer;
use App\http\Requests\CustomerReservationRequest;

class CustomerReservationController extends Controller
{
    
    public function indexrestaurant(String $id)
    {
        $restaurant = Restaurant::findOrFail($id);
    
        $reservation = CustomerReservation::select('customer_reservations.*')
            ->join('restaurants', 'restaurants.id', '=', 'customer_reservations.restaurant_id');
    
        if ($restaurant) {
            $reservation->where('customer_reservations.restaurant_id', $restaurant->id);
            return $reservation->get();
        }
    
        // Return all restaurants if the owner is not found or no ID provided
        return CustomerReservation::all();
    }
    public function indexcustomer(String $id)

    {
        $customer = Customer::findOrFail($id);
    
        $reservation = CustomerReservation::select('customer_reservations.*')
            ->join('customers', 'customers.id', '=', 'customer_reservations.customer_id');
    
        if ($customer) {
            $reservation->where('customer_reservations.customer_id', $customer->id);
            return $reservation->get();
        }
    
        // Return all restaurants if the owner is not found or no ID provided
        return CustomerReservation::all();
    }


    public function index()
    {
        return CustomerReservation::all();
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
    public function store(CustomerReservationRequest $request)
    {   

        $validated = $request->validated();

        $reservation = CustomerReservation::create($validated);

        return $reservation;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CustomerReservation::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerReservationRequest $request, string $id)
    {
        $validated = $request->validated();

        $reservation = CustomerReservation::findOrFail($id);

        $reservation->update($validated);

        return $reservation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation
        
        = CustomerReservation::findOrFail($id);

        $reservation->delete();

        return $reservation;
    }
}
