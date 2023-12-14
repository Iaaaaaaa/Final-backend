<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'restaurants';

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
        'restaurant_name',
        'description',
        'cuisine',
        'address',
        'city',
        'zip_code',
        'owner_id'
    ];

}