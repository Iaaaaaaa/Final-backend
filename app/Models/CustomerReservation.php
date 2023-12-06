<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReservation extends Model
{
    use HasFactory;
 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_reservations';

     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';   

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
        'num_tables',
        'num_guests',
        'status',
        'reserve_date',
        'reserve_time',
        'time_of_day',
        'request_date',
        'special_request',
        'customer_id',
        'restaurant_id',
        
    ];
}
